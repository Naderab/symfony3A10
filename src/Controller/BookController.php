<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
   
    #[Route("/book/get/all",name:'app_book_getall')]
    public function getAllbooks(BookRepository $repo) {
        $books= $repo->findAll();
        return $this->render('book/listbooks.html.twig',['books'=>$books]);
    }

    #[Route('/book/add',name:'app_book_add')]
    public function addbook(Request $req,EntityManagerInterface $em,AuthorRepository $repo){
        $book = new Book();
        $form=$this->createForm(BookType::class,$book);

        $form->handleRequest($req);
        if($form->isSubmitted())
        {
            $em->persist($book);

        $em->flush();
        return $this->redirectToRoute('app_book_getall');
        }
        // $book->setTitle('book 1');
        // $book->setPublicationDate(new \DateTime());
        // $book->setEnabled(true);
        // $author = $repo->find(6);
        // $book->setAuthor($author);

        // $book2 = new Book();
        // $book2->setTitle('book 2');
        // $book2->setPublicationDate(new \DateTime());
        // $book2->setEnabled(false);

        // $book3 = new Book();
        // $book3->setTitle('book 3');
        // $book3->setPublicationDate(new \DateTime());
        // $book3->setEnabled(false);

       return $this->render('book/formBook.html.twig',[
        'f'=>$form->createView()
       ]);
       
        
    }

    #[Route('/book/update/{id}',name:'app_book_update')]
    public function updatebook(EntityManagerInterface $em,$id
    ,bookRepository $repo){
        $book = $repo->find($id);
        $book->setTitle('book updated');
        $em->flush();
        return $this->redirectToRoute('app_book_getall');
    }

     #[Route('/book/delete/{id}',name:'app_book_delete')]
    public function deletebook(ManagerRegistry $manager,$id
    ,bookRepository $repo){
        $book = $repo->find($id);
        $em=$manager->getManager();
        $em->remove($book);
        $em->flush();
        return $this->redirectToRoute('app_book_getall');
    }
}
