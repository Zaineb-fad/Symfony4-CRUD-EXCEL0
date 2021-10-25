<?php

namespace App\Controller;

use App\Entity\DeliveryOption;
use App\Form\DeliveryOptionType;
use App\Repository\DeliveryOptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/delivery/option")
 */
class DeliveryOptionController extends AbstractController
{
    /**
     * @Route("/", name="delivery_option_index", methods={"GET"})
     */
    public function index(DeliveryOptionRepository $deliveryOptionRepository): Response
    {
        return $this->render('delivery_option/index.html.twig', [
            'delivery_options' => $deliveryOptionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="delivery_option_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $deliveryOption = new DeliveryOption();
        $form = $this->createForm(DeliveryOptionType::class, $deliveryOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($deliveryOption);
            $entityManager->flush();

            return $this->redirectToRoute('delivery_option_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('delivery_option/new.html.twig', [
            'delivery_option' => $deliveryOption,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delivery_option_show", methods={"GET"})
     */
    public function show(DeliveryOption $deliveryOption): Response
    {
        return $this->render('delivery_option/show.html.twig', [
            'delivery_option' => $deliveryOption,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="delivery_option_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DeliveryOption $deliveryOption): Response
    {
        $form = $this->createForm(DeliveryOptionType::class, $deliveryOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('delivery_option_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('delivery_option/edit.html.twig', [
            'delivery_option' => $deliveryOption,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delivery_option_delete", methods={"POST"})
     */
    public function delete(Request $request, DeliveryOption $deliveryOption): Response
    {
        if ($this->isCsrfTokenValid('delete'.$deliveryOption->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($deliveryOption);
            $entityManager->flush();
        }

        return $this->redirectToRoute('delivery_option_index', [], Response::HTTP_SEE_OTHER);
    }
}
