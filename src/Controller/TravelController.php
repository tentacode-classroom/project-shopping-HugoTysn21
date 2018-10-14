<?php

namespace App\Controller;

use App\Entity\Travel;
use App\Form\TravelType;
use App\Repository\TravelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/travel")
 */
class TravelController extends AbstractController
{
    /**
     * @Route("/", name="travel_index", methods="GET")
     */
    public function index(TravelRepository $travelRepository): Response
    {
        return $this->render('travel/index.html.twig', ['travels' => $travelRepository->findAll()]);
    }

    /**
     * @Route("/new", name="travel_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $travel = new Travel();
        $form = $this->createForm(TravelType::class, $travel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($travel);
            $em->flush();

            return $this->redirectToRoute('travel_index');
        }

        return $this->render('travel/new.html.twig', [
            'travel' => $travel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="travel_show", methods="GET")
     */
    public function show(Travel $travel): Response
    {
        return $this->render('travel/show.html.twig', ['travel' => $travel]);
    }

    /**
     * @Route("/{id}/edit", name="travel_edit", methods="GET|POST")
     */
    public function edit(Request $request, Travel $travel): Response
    {
        $form = $this->createForm(TravelType::class, $travel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('travel_edit', ['id' => $travel->getId()]);
        }

        return $this->render('travel/edit.html.twig', [
            'travel' => $travel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="travel_delete", methods="DELETE")
     */
    public function delete(Request $request, Travel $travel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$travel->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($travel);
            $em->flush();
        }

        return $this->redirectToRoute('travel_index');
    }
}
