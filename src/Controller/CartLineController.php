<?php

namespace App\Controller;

use App\Entity\CartLine;
use App\Form\CartLineType;
use App\Repository\CartLineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cart/line")
 */
class CartLineController extends AbstractController
{
    /**
     * @Route("/", name="cart_line_index", methods={"GET"})
     */
    public function index(CartLineRepository $cartLineRepository): Response
    {
        return $this->render('cart_line/index.html.twig', [
            'cart_lines' => $cartLineRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cart_line_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cartLine = new CartLine();
        $form = $this->createForm(CartLineType::class, $cartLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cartLine);
            $entityManager->flush();

            return $this->redirectToRoute('cart_line_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cart_line/new.html.twig', [
            'cart_line' => $cartLine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cart_line_show", methods={"GET"})
     */
    public function show(CartLine $cartLine): Response
    {
        return $this->render('cart_line/show.html.twig', [
            'cart_line' => $cartLine,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cart_line_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CartLine $cartLine): Response
    {
        $form = $this->createForm(CartLineType::class, $cartLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cart_line_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cart_line/edit.html.twig', [
            'cart_line' => $cartLine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cart_line_delete", methods={"POST"})
     */
    public function delete(Request $request, CartLine $cartLine): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cartLine->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cartLine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cart_line_index', [], Response::HTTP_SEE_OTHER);
    }
}
