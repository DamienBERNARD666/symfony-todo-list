<?php

namespace App\Controller;

use App\Entity\ToDo;
use App\Form\ToDoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/to/do")
 */
class ToDoController extends AbstractController
{
    /**
     * @Route("/", name="to_do_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(ToDo::class)->findBy([]);
        //Mise en place de Knp Paginator
        $toDos = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('to_do/index.html.twig', [
            'to_dos' => $toDos,
        ]);
    }

    /**
     * @Route("/new", name="to_do_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $toDo = new ToDo();
        $form = $this->createForm(ToDoType::class, $toDo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($toDo);
            $entityManager->flush();

            return $this->redirectToRoute('to_do_index');
        }

        return $this->render('to_do/new.html.twig', [
            'to_do' => $toDo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="to_do_show", methods={"GET"})
     */
    public function show(ToDo $toDo): Response
    {
        return $this->render('to_do/show.html.twig', [
            'to_do' => $toDo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="to_do_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ToDo $toDo): Response
    {
        $form = $this->createForm(ToDoType::class, $toDo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('to_do_index');
        }

        return $this->render('to_do/edit.html.twig', [
            'to_do' => $toDo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="to_do_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ToDo $toDo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$toDo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($toDo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('to_do_index');
    }
}
