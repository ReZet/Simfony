<?php
declare(strict_types=1);

namespace App\Service;

use App\ServiceProvider\UnkownApiServiceProvider;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;


class OrderService
{
    private $unkownApi;
	private $em;
	private $lastSyncDate;

    public function __construct(UnkownApiServiceProvider $unkownApi, EntityManagerInterface $em)
    {
        $this->unkownApi = $unkownApi;
		$this->em = $em;
        $this->unkownApi->setApiUrl('http://symfony.if-else.ru/uploads/');
    }
	
	private function getLastSyncDate()
	{
		if (empty($this->lastSyncDate)) {
			$this->lastSyncDate = new \DateTime(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../var/cache/lastSyncDate.txt'));
		}
		
		return $this->lastSyncDate;
	}
	
	private function setLastSyncDate(\DateTime $date): void
	{
		file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/../var/cache/lastSyncDate.txt', $date->format('Ymd'), LOCK_EX);
	}

    public function doGetOrders(): array
    {
        $orders = $this->getOrders();

        array_walk($orders, function(&$order) {
            $order = $this->unkownApi->orderRequest($order['orderId']);
			
			if (is_array($order['orderItems'])) {
				$sum = 0;
				$count = count($order['orderItems']);
				array_walk($order['orderItems'], function($orderItem) use (&$sum) {
					$sum += $orderItem['cost'];
				});
				
				$order['order_amount'] = $sum;
			}
			
			$newOrder = new Order();
			$newOrder->setOrderId($order['orderId']);
			$newOrder->setPhone($order['phone']);
			$newOrder->setShippingStatus($order['shipping_status']);
			$newOrder->setShippingPrice($order['shipping_price']);
			$newOrder->setShippingPaymentStatus($order['shipping_payment_status']);
			$newOrder->setPaymentStatus($order['payment_status']);
			$newOrder->setCurrency($order['currency']);
			
			$newOrder->setDate(new \DateTime($order['date']));
			$newOrder->setOrderAmount(floatval($order['order_amount']));
			$newOrder->setOrderItems($order['orderItems']);
			
			$order = $newOrder;
        });
		
		//var_dump($this->em->getRepository(Order::class)->findAll());
		
		array_walk($orders, function(&$order) {
			//if ($order->getOrderId())
			$foundOrder = false;
		
			//if ($this->getLastSyncDate()->format('Y-m-d') == $order->getDate()->format('Y-m-d')) {
				$foundOrder = $this->em->getRepository(Order::class)->findOneBy(['orderId' => $order->getOrderId()]);
				if (!empty($foundOrder)) {
					$foundOrder->setOrderId($order->getOrderId());
					$foundOrder->setPhone($order->getPhone());
					$foundOrder->setShippingStatus($order->getShippingStatus());
					$foundOrder->setShippingPrice($order->getShippingPrice());
					$foundOrder->setShippingPaymentStatus($order->getShippingPaymentStatus());
					$foundOrder->setPaymentStatus($order->getPaymentStatus());
					$foundOrder->setCurrency($order->getCurrency());
					
					$foundOrder->setDate($order->getDate());
					$foundOrder->setOrderAmount($order->getOrderAmount());
					$foundOrder->setOrderItems($order->getOrderItems());					
					$this->em->merge($foundOrder);
				}
			//}
			
			if (!$foundOrder) {
				$this->em->persist($order);
			}
			
			$this->em->flush();
			$this->setLastSyncDate($order->getDate());
		});
		
        return $orders;
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
