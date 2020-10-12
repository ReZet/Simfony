<?php
namespace App\Service;

use App\Entity\Order;
use App\Service\OrderService;

class UnknownApiOrderEntityAdapter
{	
	private $orderService;
	
	public function __construct(OrderService $orderService)
	{
		$this->orderService = $orderService;
	}
	
	public function createOrderEntity(array $params): Order
	{
		$order = $this->orderService->getOrderInstance();
		$order->setOrderUid($params['orderId']);
		$order->setPhone($params['phone']);
		$order->setShippingStatus($params['shipping_status']);
		$order->setShippingPrice($params['shipping_price']);
		$order->setShippingPaymentStatus($params['shipping_payment_status']);
		$order->setPaymentStatus($params['payment_status']);
		$order->setCurrency($params['currency']);			
		$order->setDate(new \DateTime($params['date']));			
		
		$paramsAmount = 0;
		if (is_array($params['orderItems'])) {
			$count = count($params['orderItems']);
			array_walk($params['orderItems'], function($paramsItem) use (&$paramsAmount) {
				$paramsAmount += $paramsItem['cost'];
			});
			
			$params['order_amount'] = $paramsAmount;				
			//$order->setOrderItems($params['orderItems']);
		}
		$order->setOrderAmount(floatval($paramsAmount));
		
		return $order;
	}
}