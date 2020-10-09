<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\syncOrderFromUnkownApiService;


class TestController extends AbstractController
{
    private $syncOrdersService;

    public function __construct(syncOrderFromUnkownApiService $syncOrdersService)
    {
        $this->syncOrdersService = $syncOrdersService;
    }
	
    /**
     * @Route("/test", name="test")
     */
    public function index()
    {		
		var_dump($this->syncOrdersService->doSyncOrders());

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
