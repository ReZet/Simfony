<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\GetOrdersService;


class TestController extends AbstractController
{
    private $getOrders;

    public function __construct(GetOrdersService $getOrders)
    {
        $this->getOrders = $getOrders;
    }
	
    /**
     * @Route("/test", name="test")
     */
    public function index()
    {		
		$this->getOrders->run();

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
