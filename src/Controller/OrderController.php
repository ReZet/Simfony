<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Service\OrderService;
use App\Service\SyncOrderFromUnkownApiService;


class OrderController extends AbstractController
{
    private $orderService;
    private $syncOrdersService;

    public function __construct(OrderService $orderService, SyncOrderFromUnkownApiService $syncOrdersService)
    {
        $this->orderService = $orderService;
        $this->syncOrdersService = $syncOrdersService;
    }
	
    /**
     * @Route("/order", name="orders")
     */
    public function index()
    {
		$orders = $this->orderService->findAll();
		
		//var_dump($orders);

        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
            'orders' => $orders,
        ]);
    }
	
    /**
     * @Route("/order/{id}", name="show_order")
     */
    public function show(Request $request, $id)
    {		
		$order = $this->orderService->find($id);

        return $this->render('order/show.html.twig', [
            'controller_name' => 'OrderController',
			'order' => $order
        ]);
    }
	
    /**
     * @Route("/syncOrders", name="sync_orders")
     */
    public function sync()
    {		
		$gottenOrders = $this->syncOrdersService->doSyncOrders();

        return $this->render('order/sync.html.twig', [
            'controller_name' => 'OrderController',
            'orders' => $gottenOrders,
        ]);
    }
}
