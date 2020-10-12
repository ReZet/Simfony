<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    // /**
    //  * @return Order[] Returns an array of Order objects
    //  */
  
    public function findAllJoinedToOrderItems()
	{
		//need pagination
		$entityManager = $this->getEntityManager();

		$query = $entityManager->createQuery(
			'SELECT o
			FROM App\Entity\Order o'
		);
		$query->setFetchMode("App\Entity\OrderItem", "order_items", \Doctrine\ORM\Mapping\ClassMetadata::FETCH_EAGER);

		return $query->getResult();
	}
	
	public function findOneByIdJoinedToOrderItems($orderId)
	{
		$entityManager = $this->getEntityManager();

		$query = $entityManager->createQuery(
			'SELECT o, oi
			FROM App\Entity\Order o
			INNER JOIN o.order_items oi
			WHERE o.id = :id'
		)->setParameter('id', $orderId);

		return $query->getOneOrNullResult();
	}
}
