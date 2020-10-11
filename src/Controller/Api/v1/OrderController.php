<?php

namespace App\Controller\Api\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @Route("/api/v1/orders", name="api_orders")
     */
    public function index(): Response
    {
		$orders = $this->orderService->findAll();

        return $this->json($orders);
    }
	
    /**
     * @Route("/api/v1/order/{id}", name="api_show_order")
     */
    public function show(Request $request, $id): Response
    {		
		$order = $this->orderService->find($id);

        return $this->json($order);
    }
	
    /**
     * @Route("/api/v1/sync_orders", name="api_sync_orders")
     */
    public function sync(): Response
    {		
		$gottenOrders = $this->syncOrdersService->doSyncOrders();

        return $this->json($gottenOrders);
    }
}
