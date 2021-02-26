<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

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
        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series'
        ]);
    }

    /**
     * @Route("/{id<\d+>}", methods={"GET"})
     */
    public function show(int $id): Response
    {
        return $this->render('program/show.html.twig', [
            'id' => $id
        ]);
    }
}
