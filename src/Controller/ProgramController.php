<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DoctrineParamConverter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * @Route("/{program<\d+>}", methods={"GET"}, name="show")
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
     * Return the needed program season vue
     *
     * @Route("/{program<\d+>}/seasons/{season<\d+>}", methods={"GET"}, name="show_season")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function seasonShow(Program $program, Season $season): Response
    {
        $doctrine = $this->getDoctrine();

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

    /**
     * Return the program season episode vue
     *
     * @Route("/{program<\d+>}/seasons/{season<\d+>}/episodes/{episode<\d+>}", methods={"GET"}, name="episode_show")
     *
     * @param \App\Entity\Program $program
     * @param \App\Entity\Season $season
     * @param \App\Entity\Episode $episode
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function episodeShow(Program $program, Season $season, Episode $episode): Response
    {
        return $this->render('episode/show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode
        ]);
    }
}
