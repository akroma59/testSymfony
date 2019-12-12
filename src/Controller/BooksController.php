<?php

namespace App\Controller;

use App\Entity\Books;
use App\Form\BooksType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/book", name="books")
 */
class BooksController extends AbstractController
{
    /**
     * @Route("s", name=":index", methods={"HEAD","GET"})
     */
    public function index()
    {
        

        return $this->render('books/index.html.twig', [
            'controller_name' => 'BooksController',
        ]);
    }

    /**
     * @Route("/create", name=":create", methods={"HEAD","GET","POST"})
     */
    public function create(Request $request)
    {
        $book = new Books;

        // Define $errors array
        $errors = [];

        // Create the new form
        $form = $this->createForm(BooksType::class, $book);

        // Handle the request
        $form->handleRequest($request);

        // On form submit
        if ($form->isSubmitted()) {
            
            // Handle form errors
            // ...

            // If the form is valid
            if ($form->isValid()) {
                
                // Save in database

                // Redirect the user
                return $this->redirectToRoute('books:read', [
                    'id' => $book->getId(),
                ]);
            }
        }

        // Create the form view
        $form = $form->createView();

        return $this->render('books/create.html.twig', [
            'form' => $form,
            'errors' => $errors,
        ]);
    }

    /**
     * @Route("/{id}", name=":read", methods={"HEAD","GET"})
     */
    public function read()
    {
        return $this->render('books/read.html.twig', [
            'controller_name' => 'BooksController',
        ]);
    }

    /**
     * @Route("/{id}/update", name=":update", methods={"HEAD","GET","POST"})
     */
    public function update()
    {
        return $this->render('books/update.html.twig', [
            'controller_name' => 'BooksController',
        ]);
    }

    /**
     * @Route("/{id}/delete", name=":delete", methods={"HEAD","GET","DELETE"})
     */
    public function delete()
    {
        return $this->render('books/delete.html.twig', [
            'controller_name' => 'BooksController',
        ]);
    }
}
