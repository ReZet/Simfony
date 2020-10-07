<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

Class GetOrders
{
	private $httpClient;
	private $limit = 2;
	private $arOrders = [];
	
	public function __construct(HttpClientInterface $httpClient)
	{
		$this->httpClient = $httpClient;
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
			$arOrdersPart = $this->ordersSearchRequest($offset++);
			$arOrders = array_merge($arOrders, $arOrdersPart);
		} while (count($arOrdersPart) == $this->limit);
		
		return $arOrders;
	}
	
	private function getOrder(String $orderId): Array
	{
		return $this->orderRequest($orderId);
	}
	
	private function request($url, $params)
	{
		$response = $this->httpClient->request('GET', $url, ['query' => $params]);
		
		if ($response->getStatusCode() == 200) {
			return $response->toArray(false);
		} else {
			return [];
		}
		
	}
	private function ordersSearchRequest(Int $offset): Array
	{
		return $this->request(
			'http://symfony.if-else.ru/uploads/orders_search' . $offset,
			[
				'currency_code' => 'RUB',
				'limit' => $this->limit,
				'offset' => $offset,
				'date_from' => '',
				'date_to' => ''
			]
		);
	}
	
	private function orderRequest(String $orderId): Array
	{
		return $this->request(
			'http://symfony.if-else.ru/uploads/orders/' . $orderId,
			[
				'order_id' => $orderId
			]
		);
	}
}