<?php

namespace App\Controller\Admin;

use App\Entity\CoefficientMatiere;
use App\Form\CoefficientMatiereType;
use App\Repository\CoefficientMatiereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/coefficient-matiere")
 */
class CoefficientMatiereController extends AbstractController
{
    /**
     * @Route("/", name="admin_coefficient_matiere_index", methods={"GET"})
     */
    public function index(CoefficientMatiereRepository $coefficientMatiereRepository): Response
    {
        return $this->render('admin/coefficient_matiere/index.html.twig', [
            'coefficient_matieres' => $coefficientMatiereRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_coefficient_matiere_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $coefficientMatiere = new CoefficientMatiere();
        $form = $this->createForm(CoefficientMatiereType::class, $coefficientMatiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($coefficientMatiere);
            $entityManager->flush();

            return $this->redirectToRoute('admin_coefficient_matiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/coefficient_matiere/new.html.twig', [
            'coefficient_matiere' => $coefficientMatiere,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_coefficient_matiere_show", methods={"GET"})
     */
    public function show(CoefficientMatiere $coefficientMatiere): Response
    {
        return $this->render('admin/coefficient_matiere/show.html.twig', [
            'coefficient_matiere' => $coefficientMatiere,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_coefficient_matiere_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CoefficientMatiere $coefficientMatiere): Response
    {
        $form = $this->createForm(CoefficientMatiereType::class, $coefficientMatiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_coefficient_matiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/coefficient_matiere/edit.html.twig', [
            'coefficient_matiere' => $coefficientMatiere,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_coefficient_matiere_delete", methods={"POST"})
     */
    public function delete(Request $request, CoefficientMatiere $coefficientMatiere): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coefficientMatiere->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($coefficientMatiere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_coefficient_matiere_index', [], Response::HTTP_SEE_OTHER);
    }
}
