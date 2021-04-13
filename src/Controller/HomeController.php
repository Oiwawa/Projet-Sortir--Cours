<?php


namespace App\Controller;


use App\Filters\Filters;
use App\Form\FiltersType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 * @Route(path="", name="home_")
 */
class HomeController extends AbstractController
{
    /**
     * @Route(path="", name="index", methods={"GET"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param EventRepository $filtersRepository
     * @return Response
     */
    public function index(Request $request, EntityManagerInterface $entityManager, EventRepository $filtersRepository): Response
    {
        //Si l'user n'est pas connecté, renvoi vers la page de connexion
        if (is_null($this->getUser())) {
        return $this->redirectToRoute('app_login');
        }
        $filters = new Filters();

        $eventList = $entityManager->getRepository('App:Event')->findAll();
        $filtersForm = $this->createForm(FiltersType::class, $filters);
        $filtersForm->handleRequest($request);
        $filtersResults = $filtersRepository->findSearch($filters);


        return $this->render('home/index.html.twig',
            ['eventList'=>$eventList,
                'filtersForm'=>$filtersForm->createView(),
                'filtersResults'=>$filtersResults
            ]);
    }


}