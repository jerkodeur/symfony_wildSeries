<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\EpisodeType;
use App\Form\ProgramType;
use App\Form\SeasonType;
use App\Service\Slugify;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

//TODO Prefix a route for the entire class
/**
 * @Route("/", name="program_")
 * */

class ProgramController extends AbstractController
{
    //TODO Create a route with Annotations
    /**
     * @Route("/programs", methods={"GET"}, name="index")
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
     * @Route("program/{program_slug}", methods={"GET"}, name="show")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program_slug": "slug"} })
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
     * @Route("program/new", methods={"GET","POST"}, name="new")
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request, Slugify $slugify): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugify->generate($program->getTitle());
            $program->setSlug($slug);
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
     * @Route("program/{program_slug}/season/{season<\d+>}", methods={"GET"}, name="show_season")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program_slug": "slug"} })
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

        return $this->render('season/show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $episodes
        ]);
    }

    /**
     * Return the program season episode vue
     *
     * @Route("program/{program_slug}/season/{season<\d+>}/episode/{ep_slug}", methods={"GET"}, name="episode_show")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program_slug": "slug"} })
     * @ParamConverter("episode", class="App\Entity\Episode", options={"mapping": {"ep_slug": "slug"} })
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
     * @Route("program/{program_slug}/new", methods={"GET","POST"}, name="season_new")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program_slug": "slug"} })
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
            $season->setProgram($program);
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

    /**
     * Create a new episode
     *
     * @Route("program/{program_slug}/season/{season<\d+>}/new", methods={"GET", "POST"}, name="episode_new")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program_slug": "slug"} })
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \App\Entity\Program $program
     * @param \App\Entity\Season $season
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function EpisodeNew(Request $request, Program $program, Season $season): Response
    {
        $episode = new Episode;
        $form = $this->createForm(EpisodeType::class, $episode);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $episode->setSeason($season);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($episode);
            $entityManager->flush();
            return $this->redirectToRoute('program_episode_new', [
                'program' => $program->getId(),
                'season' => $season->getId()
            ]);
        }
        return $this->render('episode/new.html.twig', [
            'program' => $program,
            'season' => $season,
            'form' => $form->createView()
        ]);
    }

    /**
     * Show the current actor informations
     *
     * @Route("program/{program_slug<[a-z-]*>}/actor/{actor_slug<[a-z-]*>}", name="actor_show")
     *
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program_slug": "slug"} })
     * @ParamConverter("actor", class="App\Entity\Actor", options={"mapping": {"actor_slug": "slug"} })
     *
     * @param \App\Entity\Program $program
     * @param \App\Entity\Actor $actor
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ActorShow(Program $program, Actor $actor): Response
    {
        return $this->render('actor/show.html.twig', [
            'program' => $program,
            'actor' => $actor,
        ]);
    }
}
