<?php
namespace App\Service;

use App\Service\UnkownApiService;

Class GetOrdersService
{
	private $apiService;
	private $arOrders = [];
	
	public function __construct(UnkownApiService $apiService)
	{
		$this->apiService = $apiService;
	}
	
	public function run() 
	{
		$this->arOrders = $this->getOrders();
		
		array_walk($this->arOrders, function(&$order) {
			$order = $this->getOrder($order['orderId']);
		});
		
		var_dump($this->arOrders);
	}
	
	private function getOrders(): Array
	{
		$arOrders = [];
		$offset = 1;
		do {
			$arOrdersPart = $this->apiService->ordersSearchRequest($offset++);
			$arOrders = array_merge($arOrders, $arOrdersPart);
		} while (count($arOrdersPart) == $this->apiService::ORDER_SEARCH_LIMIT);
		
		return $arOrders;
	}
	
	private function getOrder(String $orderId): Array
	{
		return $this->apiService->orderRequest($orderId);
	}
}