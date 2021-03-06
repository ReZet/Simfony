<?php

namespace App\Service;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;


class OrderService
{
	private $em;
	private $rep;
	
	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
		$this->setRep($this->em->getRepository(Order::class));
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
	
	public function getOrderInstance(): Order
	{
		return new Order;
	}
	
	public function findAll(): ?array
	{
		return $this->getRep()->findAll();
	}
	
	public function findAllWithOrderItems(): ?array
	{
		return $this->getRep()->findAllJoinedToOrderItems();
	}
	
	public function findOneWithOrderItems(int $id): ?Order
	{
		return $this->getRep()->findOneByIdJoinedToOrderItems($id);
	}
	
	public function find(int $id): ?Order
	{
		return $this->getRep()->find($id);
	}
	
	public function findOneBy(array $params): ?Order
	{
		return $this->getRep()->findOneBy($params);
	}
	
	public function saveOrder(Order $order): Order
	{
		$this->em->persist($order); 	
		$this->em->flush();
		
		return $order;
	}
}