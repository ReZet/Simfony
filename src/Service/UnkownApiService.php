<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

Class UnkownApiService
{
	private const API_URL = 'http://symfony.if-else.ru/uploads/';
	const ORDER_SEARCH_LIMIT = 2;
	
	private $httpClient;
	
	public function __construct(HttpClientInterface $httpClient)
	{
		$this->httpClient = $httpClient;
	}
	
	private function request(String $path, Array $params): Array
	{
		$response = $this->httpClient->request('GET', self::API_URL . $path, ['query' => $params]);
		
		if ($response->getStatusCode() == 200) {
			return $response->toArray(false);
		} else {
			return [];
		}
		
	}
	
	public function ordersSearchRequest(Int $offset): Array
	{
		return $this->request(
			'orders_search' . $offset,
			[
				'currency_code' => 'RUB',
				'limit' => self::ORDER_SEARCH_LIMIT,
				'offset' => $offset,
				'date_from' => '',
				'date_to' => ''
			]
		);
	}
	
	public function orderRequest(String $orderId): Array
	{
		return $this->request(
			'orders/' . $orderId,
			[
				'order_id' => $orderId
			]
		);
	}
	
}