<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\OrderService;


class TestController extends AbstractController
{
    private $getOrders;

    public function __construct(OrderService $getOrders)
    {
        $this->getOrders = $getOrders;
    }
	
    /**
     * @Route("/test", name="test")
     */
    public function index()
    {		
		echo '<pre>';var_dump($this->getOrders->doGetOrders());echo '</pre>';

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
