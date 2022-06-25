<?php

namespace App\Controller;

use App\Entity\Ship;
use App\Form\ShipType;
use App\Repository\ShipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ship")
 */
class ShipController extends AbstractController
{
    /**
     * @Route("/", name="app_ship_index", methods={"GET"})
     */
    public function index(ShipRepository $shipRepository): Response
    {
        return $this->render('ship/index.html.twig', [
            'ships' => $shipRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_ship_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ShipRepository $shipRepository): Response
    {
        $ship = new Ship();
        $form = $this->createForm(ShipType::class, $ship);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $shipRepository->add($ship, true);

            return $this->redirectToRoute('app_ship_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ship/new.html.twig', [
            'ship' => $ship,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ship_show", methods={"GET"})
     */
    public function show(Ship $ship): Response
    {
        return $this->render('ship/show.html.twig', [
            'ship' => $ship,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_ship_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Ship $ship, ShipRepository $shipRepository): Response
    {
        $form = $this->createForm(ShipType::class, $ship);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $shipRepository->add($ship, true);

            return $this->redirectToRoute('app_ship_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ship/edit.html.twig', [
            'ship' => $ship,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ship_delete", methods={"POST"})
     */
    public function delete(Request $request, Ship $ship, ShipRepository $shipRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ship->getId(), $request->request->get('_token'))) {
            $shipRepository->remove($ship, true);
        }

        return $this->redirectToRoute('app_ship_index', [], Response::HTTP_SEE_OTHER);
    }
}
