<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(name="category_")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/categories", methods={"GET"}, name="index")
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
     * Create a new category program
     *
     * @Route("category/new", methods={"GET","POST"}, name="new")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    //TODO Create a new form view
    public function new(Request $request): Response
    {
        // Create a new Category Object
        $category = new Category;
        // Create the associated Form
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Deal with the submitted data
            // Get the Entity Manager
            $entityManager = $this->getDoctrine()->getManager();
            // Persist Category Object
            $entityManager->persist($category);
            // Flush the persisted object
            $entityManager->flush();
            // Finally redirect to categories list
            return $this->redirectToRoute('category_index');
        }
        // Render the form
        return $this->render('category/new.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("category/{category<[a-z-]*>}", methods={"GET"}, name="show")
     * @ParamConverter("category", class="App\Entity\Category", options={"mapping": {"category": "slug"} })
     *
     * @param string $categoryName
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Category $category): Response
    {
        $doctrine = $this->getDoctrine();

        //TODO findOneBy()
        $category = $doctrine
            ->getRepository(Category::class)
            ->findOneBy(['id' => $category]);

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
