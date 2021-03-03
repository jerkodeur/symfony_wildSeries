<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories", name="categories_")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"}, name="index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(): Response
    {
        //TODO findAll()
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/{categoryName}", methods={"GET"}, name="show")
     *
     * @param string $categoryName
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(string $categoryName): Response
    {
        $doctrine = $this->getDoctrine();

        //TODO findOneBy()
        $category = $doctrine
            ->getRepository(Category::class)
            ->findOneBy([
                'name' => $categoryName
            ]);

        //TODO Throw an 404 exception
        if (!$category) {
            throw $this->createNotFoundException('This category does not exist !');
        }

        //TODO findBy foreign key
        //TODO OrderBy request
        //TODO limit request
        $programs = $doctrine
            ->getRepository(Program::class)
            //TODO findBy()
            ->findBy(
                ['category' => $category],
                ['id' => 'DESC'],
                3
            );

        return $this->render('category/show.html.twig', [
            'category' => $category,
            'programs' => $programs
        ]);
    }
}
