<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Contracts\HttpClient\HttpClientInterface;

use App\Entity\Beer;
use App\Entity\Category;

class BarController extends AbstractController
{

    private $client;
    private $categories = ['Brune', 'Ambrée', 'Blanche', 'Sans alcool'];

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @Route("/bar", name="bar")
     */
    public function index(): Response
    {
        return $this->render('bar/index.html.twig', [
            'title' => 'The babar',
            'info' => 'Hello World'
        ]);
    }

    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentions()
    {
        return $this->render('mentions/index.html.twig', [
            'title' => 'Mentions légales',
        ]);
    }

    /**
     * @Route("/beers", name="beers")
     */
    public function beers()
    {
        $beerRepo = $this->getDoctrine()->getRepository(Beer::class);

        return $this->render('beers/index.html.twig', [
            'title' => 'Page beers',
            'beers' => $beerRepo->findAll()
        ]);
    }

    /**
     * @Route("/home", name="home")
     */
    public function home()
    {
        $beerRepo = $this->getDoctrine()->getRepository(Beer::class);

        return $this->render('home/index.html.twig', [
            'title' => 'Home page',
            'beers' => $beerRepo->findLast()
        ]);
    }

    /**
    * @Route("/beer/{id}", name="beer")
    */
    public function show(int $id): Response
    {
        $repoBeer = $this->getDoctrine()->getRepository(Beer::class);
        $beer = $repoBeer->find($id);
        // $beer = $repoBeer->findByTerm($id, 'special');

        return $this->render('beer/index.html.twig', [
            'beer' => $beer
        ]);
    }

    /**
    * @Route("/menu", name="menu")
    */
    public function mainMenu(string $category_id, string $routeName): Response
    {
        $categoryRepo = $this
            ->getDoctrine()
            ->getRepository(Category::class);

        $categories = $categoryRepo->findByTerm('normal');

        return $this->render('partials/main_menu.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/category/{id}", name="category")
     * @param int $id
     * @return Response
     */
    public function category(int $id): Response
    {
        $beerRepo = $this->getDoctrine()->getRepository(Beer::class);
        $categoryRepo = $this->getDoctrine()->getRepository(Category::class);

        $beersInCategory = $beerRepo->findByCategoryId($id);
        $category = $categoryRepo->find($id)->getName();

        // dump($category);
        return $this->render('category/index.html.twig', [
            'beers' => $beersInCategory,
            'title' => $category
        ]);
    }
}
