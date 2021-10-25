<?php

namespace App\Controller;

use App\Entity\StatusHistory;
use App\Form\StatusHistoryType;
use App\Repository\StatusHistoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/status/history")
 */
class StatusHistoryController extends AbstractController
{
    /**
     * @Route("/", name="status_history_index", methods={"GET"})
     */
    public function index(StatusHistoryRepository $statusHistoryRepository): Response
    {
        return $this->render('status_history/index.html.twig', [
            'status_histories' => $statusHistoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="status_history_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $statusHistory = new StatusHistory();
        $form = $this->createForm(StatusHistoryType::class, $statusHistory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($statusHistory);
            $entityManager->flush();

            return $this->redirectToRoute('status_history_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('status_history/new.html.twig', [
            'status_history' => $statusHistory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="status_history_show", methods={"GET"})
     */
    public function show(StatusHistory $statusHistory): Response
    {
        return $this->render('status_history/show.html.twig', [
            'status_history' => $statusHistory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="status_history_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, StatusHistory $statusHistory): Response
    {
        $form = $this->createForm(StatusHistoryType::class, $statusHistory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('status_history_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('status_history/edit.html.twig', [
            'status_history' => $statusHistory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="status_history_delete", methods={"POST"})
     */
    public function delete(Request $request, StatusHistory $statusHistory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statusHistory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($statusHistory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('status_history_index', [], Response::HTTP_SEE_OTHER);
    }
}
