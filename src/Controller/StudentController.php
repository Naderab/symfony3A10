<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StudentController extends AbstractController{

    public function helloAction(){
        //pageweb //msg //json //xml
        return new Response("hello from controller");
    }

    #[Route(path: "/test",name:"test")]
    public function testAction(){
        return new Response("hello 2");
    }
}

?>