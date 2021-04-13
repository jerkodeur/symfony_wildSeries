<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Comment;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\CommentType;
use App\Form\EpisodeType;
use App\Form\ProgramType;
use App\Form\SeasonType;
use App\Service\Slugify;
use Doctrine\ORM\Query\Expr\From;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\Security;

//TODO Prefix a route for the entire class
/**
 * @Route("/", name="program_")
 * */

class ProgramController extends AbstractController
{
    /**
     * @var Security $security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

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
     * Create a new program
     *
     * @Route("program/new", methods={"GET","POST"}, name="new")
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request, Slugify $slugify, MailerInterface $mailer): Response
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

            //TODO Send an Email with mailer
            $email = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to($this->getParameter('mailer_from'))
                ->subject('Une nouvelle série a été créé !')
                ->html($this->renderView('program/newProgramMail.html.twig', [
                    'program' => $program,
                    'url' => $this->getParameter('base_dev_url') . 'program/' . $program->getSlug()
                ]));
            $mailer->send($email);

            return $this->redirectToRoute(
                'program_show',
                ['program' => $program->getSlug()]
            );
        }

        return $this->render('program/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("program/{program<[a-z-]*>}", methods={"GET"}, name="show")
     *
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program": "slug"} })
     */
    //TODO find by entity object
    public function show(Program $program): Response
    {
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $program->id . ' found in program\'s table.'
            );
        }

        return $this->render('program/show.html.twig', [
            'program' => $program,
        ]);
    }

    /**
     * List of the seasons for a program
     *
     * @Route("/{program<[a-z-]*>}/seasons", methods={"GET"}, name="seasons")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program": "slug"} })
     */
    public function seasons(Program $program): Response
    {
        return $this->render('season/index.html.twig', [
            'program' => $program
        ]);
    }

    /**
     * Return the needed program season vue
     *
     * @Route("program/{program<[a-z-]*>}/season/{number<\d+>?1}", methods={"GET"}, name="season_show")
     *
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program": "slug"} })
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function seasonShow(Program $program, Season $season): Response
    {
        $doctrine = $this->getDoctrine();

        return $this->render('season/index.html.twig', [
            'program' => $program,
            'season' => $season
        ]);
    }

    /**
     * Return the program season episode vue
     *
     * @Route("program/{program<[a-z-]*>}/season/{season<\d+>}/episode/{episode<[a-z-]*>}", methods={"GET", "POST"}, name="episode_show")
     *
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program": "slug"} })
     * @ParamConverter("episode", class="App\Entity\Episode", options={"mapping": {"episode": "slug"} })
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function episodeShow(Request $request, Program $program, Season $season, Episode $episode): Response
    {
        $comment = new Comment;
        $form = $this->createForm(CommentType::class, $comment)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $comment->setEpisode($episode);
            $comment->setAuthor($this->security->getUser());
            $entityManager->persist($comment);
            $entityManager->flush();
            return $this->redirectToRoute('program_episode_show', [
                'program' => $program->getSlug(),
                'season' => $season->getId(),
                'episode' => $episode->getSlug()
            ]);
        }

        return $this->render('episode/show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode,
            'form' => $form->createView()
        ]);
    }
    /**
     * Create a new season for the program
     *
     * @Route("program/{program<[a-z-]*>}/new", methods={"GET","POST"}, name="season_new")
     *
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program": "slug"} })
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
            return $this->redirectToRoute(
                'program_season_show',
                [
                    'program' => $program->getSlug(),
                    'season' => $season->getNumber()
                ]
            );
        }

        return $this->render('season/new.html.twig', [
            'program' => $program,
            'form' => $form->createView()
        ]);
    }

    /**
     * Create a new episode
     *
     * @Route("program/{program<[a-z-]*>}/season/{season<\d+>}/new", methods={"GET", "POST"}, name="episode_new")
     *
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program": "slug"} })
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \App\Entity\Program $program
     * @param \App\Entity\Season $season
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function EpisodeNew(Request $request, Program $program, Season $season, MailerInterface $mailer, Slugify $slugify): Response
    {
        $episode = new Episode;
        $form = $this->createForm(EpisodeType::class, $episode);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $episode->setSeason($season);
            $episode->setSlug($slugify->generate($episode->getTitle()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($episode);
            $entityManager->flush();

            $email = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to($this->getParameter('mailer_from'))
                ->subject('Un nouvel épisode a été ajouté à la série ' . $program->getTitle() . ' (saison ' . $season->getNumber()  . ')')
                ->html($this->renderView('episode/newEpisodeMail.html.twig', [
                    'program' => $program,
                    'season' => $season,
                    'episode' => $episode,
                    'url' => $this->getParameter('base_dev_url') . 'program/' . $program->getSlug() . '/season/' . $season->getNumber() . '/episode/' . $episode->getSlug()
                ]));

            $mailer->send($email);

            return $this->redirectToRoute('program_episode_new', [
                'program' => $program->getSlug(),
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
     * @Route("program/{slug<[a-z-]*>}/actors", methods={"GET"}, name="actors")
     *
     */
    //TODO find by entity object
    public function actors(Program $program): Response
    {
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $program->id . ' found in program\'s table.'
            );
        }

        return $this->render('actor/index.html.twig', [
            'program' => $program,
        ]);
    }

    /**
     * Show the current actor information
     *
     * @Route("program/{program<[a-z-]*>}/actor/{actor<[a-z-]*>}", name="actor_show")
     *
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program": "slug"} })
     * @ParamConverter("actor", class="App\Entity\Actor", options={"mapping": {"actor": "slug"} })
     *
     */
    public function ActorShow(Program $program, Actor $actor): Response
    {
        return $this->render('actor/show.html.twig', [
            'program' => $program,
            'actor' => $actor,
        ]);
    }

    /**
     * Create a new actor for one program
     *
     * @route("/{slug<a-z>*}/actor_new}", methods={"GET","POST"}, name="actor_new")
     */
    public function ActorNew(Program $program): Response
    {
        //
    }
}
