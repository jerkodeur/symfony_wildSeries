<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

//TODO Prefix a route for the entire class
/**
 * @Route("/programs", name="programs_")
 * */

class ProgramController extends AbstractController
{
    //TODO Create a route with Annotations
    /**
     * @Route("/", methods={"GET"}, name="index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();
        return $this->render('program/index.html.twig', [
            'programs' => $programs
        ]);
    }

    /**
     * @Route("/{id<\d+>}", methods={"GET"}, name="show")
     */
    //TODO find by entity object
    public function show(Program $program): Response
    {
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $program->id . ' found in program\'s table.'
            );
        }
        $season = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findBy(['program' => $program]);

        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $season
        ]);
    }

    /**
     * Undocumented function
     *
     * @Route("/{programId<\d+>}/seasons/{seasonId<\d+>}", methods={"GET"}, name="showSeason")
     *
     * @param int $programId
     * @param int $SeasonId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showSeason(int $programId, int $seasonId): Response
    {
        $doctrine = $this->getDoctrine();

        $program = $doctrine
            ->getRepository(Program::class)
            ->find($programId);

        $season = $doctrine
            ->getRepository(Season::class)
            ->find($seasonId);

        // dd($season);

        $episodes = $doctrine
            ->getRepository(Episode::class)
            ->findBy([
                'season' => $season
            ]);

        return $this->render('season/index.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $episodes
        ]);
    }
}
