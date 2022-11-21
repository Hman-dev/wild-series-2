<?php

namespace App\Controller;

use App\Repository\ProgramRepository;
use phpDocumentor\Reflection\Location;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    
    #[Route('/', name:'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        // return $this->render('program/index.html.twig', [

        //     'website' => 'Wild Series',
     
        //  ]);
        $programs = $programRepository->findAll();

         return $this->render('program/index.html.twig', [

            'programs' => $programs,
     
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
