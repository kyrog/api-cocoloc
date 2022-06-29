<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestConnexionController extends AbstractController
{
    /**
     * @Route("api/test/connexion", name="app_test_connexion")
     */
    public function index(): Response
    {
        return $this->render('test_connexion/index.html.twig', [
            'controller_name' => 'TestConnexionController',
        ]);
    }
}
