<?php

namespace App\Controller;

use App\Entity\Follower;
use App\Form\FollowerType;
use App\Repository\FollowerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/follower")
 */
class FollowerController extends AbstractController
{
    /**
     * @Route("/", name="follower_index", methods={"GET"})
     */
    public function index(FollowerRepository $followerRepository): Response
    {
        return $this->render('follower/index.html.twig', [
            'followers' => $followerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="follower_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $follower = new Follower();
        $form = $this->createForm(FollowerType::class, $follower);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($follower);
            $entityManager->flush();

            return $this->redirectToRoute('follower_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('follower/new.html.twig', [
            'follower' => $follower,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="follower_show", methods={"GET"})
     */
    public function show(Follower $follower): Response
    {
        return $this->render('follower/show.html.twig', [
            'follower' => $follower,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="follower_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Follower $follower): Response
    {
        $form = $this->createForm(FollowerType::class, $follower);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('follower_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('follower/edit.html.twig', [
            'follower' => $follower,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="follower_delete", methods={"POST"})
     */
    public function delete(Request $request, Follower $follower): Response
    {
        if ($this->isCsrfTokenValid('delete'.$follower->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($follower);
            $entityManager->flush();
        }

        return $this->redirectToRoute('follower_index', [], Response::HTTP_SEE_OTHER);
    }
}
