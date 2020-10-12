<?php

namespace App\Service;

use App\Entity\OrderItem;
use Doctrine\ORM\EntityManagerInterface;


class OrderItemService
{
	private $em;
	private $rep;
	
	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
		$this->setRep($this->em->getRepository(OrderItem::class));
	}
	
	// send to an Abstract Class
	private function setRep($rep): self
	{
		$this->rep = $rep;
		
		return $this;
	}
	
	private function getRep()
	{
		return $this->rep;
	}
	
	public function getOrderItemInstance(): OrderItem
	{
		return new OrderItem;
	}
	
	public function findAll(): ?array
	{
		return $this->getRep()->findAll();
	}
	
	public function find(int $id): ?OrderItem
	{
		return $this->getRep()->find($id);
	}
	
	public function findOneBy(array $params): ?OrderItem
	{
		return $this->getRep()->findOneBy($params);
	}
	
	public function saveOrderItem(OrderItem $orderItem): OrderItem
	{
		$this->em->persist($orderItem); 	
		$this->em->flush();
		
		return $orderItem;
	}
}