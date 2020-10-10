<?php
declare(strict_types=1);

namespace App\Service;

use App\Http\Client;

class UnkownApiDataProvider extends Client
{
	public const ORDER_SEARCH_LIMIT = 2;
	
	public function ordersSearchRequest(array $params): array
	{
		return $this->request(
			'orders_search' . $params['offset'],
			[
				'currency_code' => $params['currency_code'] ?? '',
				'limit' => $params['limit'] ?? self::ORDER_SEARCH_LIMIT,
				'offset' => $params['offset'] ?? '',
				'date_from' => $params['offset'] ?? '',
				'date_to' => $params['offset'] ?? ''
			]
		);
	}
	
	public function orderRequest(string $orderId): array
	{
		return $this->request(
			'orders/' . $orderId,
			[
				'order_id' => $orderId
			]
		);
	}
	
}