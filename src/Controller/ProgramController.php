<?php

namespace App\Controller;

use phpDocumentor\Reflection\Location;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    
    #[Route('/', name:'index')]
    public function index(): Response
    {
        return $this->render('program/index.html.twig', [

            'website' => 'Wild Series',
     
         ]);
    }

    #[Route('/{id<\d+>}', methods: ['GET'], name: 'id')]
    public function show(int $id): Response
    {
        if ($id != (int)$id) 
        {
           
            return $this->redirectToRoute("HTTP/1.1 404 Not Found");
        }
        
    return $this->render('program/show.html.twig', [
        
            'list' => $id,
     
         ]);
    }

}
