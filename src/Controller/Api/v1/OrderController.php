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
        return $this->json($this->orderService->findAllWithOrderItems());
    }
	
    /**
     * @Route("/api/v1/order/{id}", name="api_show_order")
     */
    public function show(Request $request, $id): Response
    {
        return $this->json($this->orderService->find($id));
    }
	
    /**
     * @Route("/api/v1/sync_orders", name="api_sync_orders")
     */
    public function sync(): Response
    {
        return $this->json($this->syncOrdersService->doSyncOrders());
    }
}
