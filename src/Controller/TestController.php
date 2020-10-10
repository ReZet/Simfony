<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class TestController extends AbstractController
{	
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
	
    /**
     * @Route("/spa*", name="spa")
     */
    public function spa()
    {
        return $this->render('test/spa.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
