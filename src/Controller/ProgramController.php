<?php

namespace App\Controller;

use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use phpDocumentor\Reflection\Location;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{

    #[Route('/', name: 'index')]
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

    #[Route('/{id<\d+>}', methods: ['GET'], name: 'show')]
    public function show(int $id, ProgramRepository $programRepository): Response
    {
        $programm = $programRepository->findOneBy(['id'=>$id]);
        
        if (!$programm) {

            // return $this->redirectToRoute("HTTP/1.1 404 Not Found");
            throw $this->createNotFoundException(
                'No prgram with id : '.$id.' found in program\'s table.'
            );
        }
        $seasons = $programm->getSeasons();
        return $this->render('program/show.html.twig', [

            'program' => $programm,
            'seasons'=>$seasons

        ]);
    }

    #[Route('/{programId<\d+>}/season/{seasonId<\d+>}', methods:['GET'], name: 'season_show')]
    public function showSeason(int $programId,int $seasonId, ProgramRepository $programRepository,SeasonRepository $seasonRepository): Response
    {
        $program = $programRepository->findOneBy(['id'=>$programId ]);
        if (!$program) {
            throw $this->createNotFoundException(
                'Pas de série avec l\'id : ' . $programId
            );
        }
        
        $season = $seasonRepository->findOneBy(['id' => $seasonId]);
        $episodes = $season->getEpisodes();
             

        return $this->render('program/season_show.html.twig', [
            'program' => $program, 
            'season' => $season,
            'episodes'=> $episodes,
        ]);
    }
}
