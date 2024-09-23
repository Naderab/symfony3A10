<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ServiceController extends AbstractController
{

    #[Route('/service', name: 'app_service')]
    public function index(): Response
    {
        return $this->render('service/index.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }

    #[Route('/service/test/{name}', name: 'app_service_show')]
    public function showService(string $name)
    {
        $person = array(array('id' => '1', 'name' => 'test'));
        $autors = array(
            array('id' => 1, 'picture' => '/images/download.jpg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/download.jpg', 'username' => ' William Shakespeare', 'email' =>  ' william.shakespeare@gmail.com', 'nb_books' => 200),
            array('id' => 3, 'picture' => '/images/download.jpg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
        );
        $hour = 9;
        return $this->render("service/index.html.twig", [
            "n" => $name,
            "p" => $person,
            "authors"=>$autors,
            "h"=>$hour
        ]);
    }

    #[Route("/service/go", name: "app_service_go", priority: 1)]
    public function goToIndex()
    {

        return $this->redirectToRoute("app_service");
    }
}
