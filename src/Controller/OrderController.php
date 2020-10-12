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
        return $this->render('order/index.html.twig', [
            'orders' => $this->orderService->findAll(),
        ]);
    }
	
    /**
     * @Route("/order/{id}", name="show_order")
     */
    public function show(Request $request, $id)
    {
        return $this->render('order/show.html.twig', [
			'order' => $this->orderService->findOneWithOrderItems($id)
        ]);
    }
	
    /**
     * @Route("/sync_orders", name="sync_orders")
     */
    public function sync()
    {
        return $this->render('order/sync.html.twig', [
            'orders' => $this->syncOrdersService->doSyncOrders(),
        ]);
    }
}
