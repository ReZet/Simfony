<?php
namespace App\Service;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Service\OrderItemService;

class UnknownApiOrderItemEntityAdapter
{	
	private $orderItemService;
	
	public function __construct(OrderItemService $orderItemService)
	{
		$this->orderItemService = $orderItemService;
	}
	
	public function createOrderItemEntity(Order $order, array $params): OrderItem
	{
		$orderItem = $this->orderItemService->getOrderItemInstance()
			->setOrder($order)
			->setOrderUid($order->getOrderUid())
			->setBarcode($params['barcode'])
			->setPrice(floatval($params['price']))
			->setQuantity(intval($params['quantity']))
			->setTaxPerc(floatval($params['tax_perc']))
			->setTaxAmt(floatval($params['tax_amt']))
			->setTrackingNumber($params['tracking_number'])
			->setCanceled(($params['canceled'] == 'Y'))
			->setShippedStatusSku($params['shipped_status_sku']);
		
		return $orderItem;
	}
}