<?php

namespace App\Controller;

use App\Entity\SponsoredRestaurant;
use App\Form\SponsoredRestaurantType;
use App\Repository\SponsoredRestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sponsored/restaurant")
 */
class SponsoredRestaurantController extends AbstractController
{
    /**
     * @Route("/", name="sponsored_restaurant_index", methods={"GET"})
     */
    public function index(SponsoredRestaurantRepository $sponsoredRestaurantRepository): Response
    {
        return $this->render('sponsored_restaurant/index.html.twig', [
            'sponsored_restaurants' => $sponsoredRestaurantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sponsored_restaurant_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sponsoredRestaurant = new SponsoredRestaurant();
        $form = $this->createForm(SponsoredRestaurantType::class, $sponsoredRestaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sponsoredRestaurant);
            $entityManager->flush();

            return $this->redirectToRoute('sponsored_restaurant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sponsored_restaurant/new.html.twig', [
            'sponsored_restaurant' => $sponsoredRestaurant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sponsored_restaurant_show", methods={"GET"})
     */
    public function show(SponsoredRestaurant $sponsoredRestaurant): Response
    {
        return $this->render('sponsored_restaurant/show.html.twig', [
            'sponsored_restaurant' => $sponsoredRestaurant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sponsored_restaurant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SponsoredRestaurant $sponsoredRestaurant): Response
    {
        $form = $this->createForm(SponsoredRestaurantType::class, $sponsoredRestaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sponsored_restaurant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sponsored_restaurant/edit.html.twig', [
            'sponsored_restaurant' => $sponsoredRestaurant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sponsored_restaurant_delete", methods={"POST"})
     */
    public function delete(Request $request, SponsoredRestaurant $sponsoredRestaurant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sponsoredRestaurant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sponsoredRestaurant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sponsored_restaurant_index', [], Response::HTTP_SEE_OTHER);
    }
}
