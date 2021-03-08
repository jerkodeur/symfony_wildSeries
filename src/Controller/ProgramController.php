<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\ProgramType;
use App\Form\SeasonType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

//TODO Prefix a route for the entire class
/**
 * @Route("/programs", name="program_")
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
     * Create a new program
     *
     * @Route("/new", methods={"GET","POST"}, name="new")
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($program);
            $entityManager->flush();

            return $this->redirectToRoute('program_index');
        }

        return $this->render('program/new.html.twig', [
            'form' => $form->createView()
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
    /**
     * Create a new season for the program
     *
     * @Route("/{program<\d+>}/new", methods={"GET","POST"}, name="season_new")
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \App\Entity\Program $program
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function seasonNew(Request $request, Program $program): Response
    {
        $season = new Season();
        $form = $this->createForm(SeasonType::class, $season);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($season);
            $entityManager->flush();
            return $this->redirectToRoute('program_show', ['program' => $program->getId()]);
        }

        return $this->render('season/new.html.twig', [
            'program' => $program,
            'form' => $form->createView()
        ]);
    }
}
