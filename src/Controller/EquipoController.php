<?php

namespace App\Controller;

use App\Entity\Equipo;
use App\Form\EquipoType;
use App\Repository\EquipoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/equipo")
 */
class EquipoController extends AbstractController
{
    /**
     * @Route("/", name="app_equipo_index", methods={"GET"})
     */
    public function index(EquipoRepository $equipoRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('equipo/index.html.twig', [
            'equipos' => $equipoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_equipo_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EquipoRepository $equipoRepository): Response
    {
        $equipo = new Equipo();
        $form = $this->createForm(EquipoType::class, $equipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipoRepository->add($equipo);
            return $this->redirectToRoute('app_equipo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equipo/new.html.twig', [
            'equipo' => $equipo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_equipo_show", methods={"GET"})
     */
    public function show(Equipo $equipo): Response
    {
        return $this->render('equipo/show.html.twig', [
            'equipo' => $equipo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_equipo_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Equipo $equipo, EquipoRepository $equipoRepository): Response
    {
        $form = $this->createForm(EquipoType::class, $equipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipoRepository->add($equipo);
            return $this->redirectToRoute('app_equipo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equipo/edit.html.twig', [
            'equipo' => $equipo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_equipo_delete", methods={"POST"})
     */
    public function delete(Request $request, Equipo $equipo, EquipoRepository $equipoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipo->getId(), $request->request->get('_token'))) {
            $equipoRepository->remove($equipo);
        }

        return $this->redirectToRoute('app_equipo_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/jugadores", methods={"GET", "POST"}, name="app_equipo_jugadores")
     */
    public function listajugadores($id)
    {
        $em = $this->getDoctrine()->getManager();
        $equipo = $em->getRepository(Equipo::class)->find($id);

        return $this->render('equipo/jugadores.html.twig', ['equipo' => $equipo]);
    }
}
