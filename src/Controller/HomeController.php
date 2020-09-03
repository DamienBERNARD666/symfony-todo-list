<?php


namespace App\Controller;

use App\Repository\ToDoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/",
     *     name="_accueil",
     *     options={"expose": true},
     *     methods={"GET"})
     * @return Response
     */
    public function index(ToDoRepository $toDoRepository):Response{
        return $this->render('accueil.html.twig', [
            'to_dos' => $toDoRepository->findAll(),
        ]);
    }
}