<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Order;
use App\Service\OrderService;
use App\Service\UnknownApiOrderEntityAdapter;
use App\Service\UnkownApiDataProvider;

class SyncOrderFromUnkownApiService
{
    private $unkownApi;
	private $orderService;
	private $orderAdapter;
	private $lastSyncDate;

    public function __construct(
		OrderService $orderService,
		UnkownApiDataProvider $unkownApi,
		UnknownApiOrderEntityAdapter $orderAdapter
	)
    {
        $this->unkownApi = $unkownApi;
        $this->orderService = $orderService;
        $this->orderAdapter = $orderAdapter;
		
        $this->unkownApi->setApiUrl('http://symfony.if-else.ru/uploads/');
    }
	
	private function getLastSyncDate()
	{
		if (empty($this->lastSyncDate)) {
			$this->lastSyncDate = new \DateTime(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../var/unkownApiSync/lastSyncDate.txt'));
		}
		
		return $this->lastSyncDate;
	}
	
	private function setLastSyncDate(\DateTime $date): void
	{
		file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/../var/unkownApiSync/lastSyncDate.txt', $date->format('Ymd'), LOCK_EX);
	}

    public function doSyncOrders(): array
    {
        return array_map(function ($order) {
			return $this->saveOrder($this->getOrder($order['orderId']));
		}, $this->getOrders());
	}
	
	private function saveOrder(array $order): Order
	{
		//first condition for checking the date. If the same date then check order existing. For the next days no need to check
		if (
			//$this->getLastSyncDate()->format('Y-m-d') == (new \DateTime($order['date']))->format('Y-m-d') &&
			$foundOrder = $this->orderService->findOneBy(['orderId' => $order['orderId']])
		) {
			return $foundOrder;
		}
		
		$savedOrder = $this->orderService->saveOrder($this->orderAdapter->createOrderEntity($order));		
		
		$this->setLastSyncDate($savedOrder->getDate());
		return $savedOrder;
    }
	
	private function getOrder(string $id): array
	{
		return $this->unkownApi->orderRequest($id);
	}

    private function getOrders(): array
    {
        $orders = [];
        $offset = 1;

        do {
            $ordersPart = $this->unkownApi->ordersSearchRequest(['offset' => $offset++, 'date_from' => $this->getLastSyncDate()->format('Ymd')]);
            $orders = array_merge($orders, $ordersPart);
        } while (count($ordersPart) === $this->unkownApi::ORDER_SEARCH_LIMIT);

        return $orders;
    }
}
