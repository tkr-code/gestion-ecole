<?php

namespace App\Controller\Admin;

use App\Entity\Departement;
use App\Form\DepartementType;
use App\Repository\DepartementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/departement")
 */
class DepartementController extends AbstractController
{
    /**
     * @Route("/", name="admin_departement_index", methods={"GET"})
     */
    public function index(DepartementRepository $departementRepository): Response
    {
        return $this->render('admin/departement/index.html.twig', [
            'departements' => $departementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_departement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $departement = new Departement();
        $form = $this->createForm(DepartementType::class, $departement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($departement);
            $entityManager->flush();
            $this->addFlash('success', 'Nouveau Departement enregistré');
            return $this->redirectToRoute('admin_departement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/departement/new.html.twig', [
            'departement' => $departement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_departement_show", methods={"GET"})
     */
    public function show(Departement $departement): Response
    {
        return $this->render('admin/departement/show.html.twig', [
            'departement' => $departement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_departement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Departement $departement): Response
    {
        $form = $this->createForm(DepartementType::class, $departement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_departement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/departement/edit.html.twig', [
            'departement' => $departement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_departement_delete", methods={"POST"})
     */
    public function delete(Request $request, Departement $departement): Response
    {
        if ($this->isCsrfTokenValid('delete' . $departement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($departement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_departement_index', [], Response::HTTP_SEE_OTHER);
    }
}
