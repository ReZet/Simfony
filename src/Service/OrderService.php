<?php

namespace App\Service;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;


class OrderService
{
	private $em;
	
	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
	}
	
	public function createOrder(): Order
	{
		return new Order;
	}
	
	public function findOneBy(array $params): ?Order
	{
		return $this->em->getRepository(Order::class)->findOneBy($params);
	}
	
	public function saveOrder(Order $order): Order
	{
		$this->em->merge($order); 	
		$this->em->flush();
		
		return $order;
	}
}