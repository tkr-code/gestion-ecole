<?php

namespace App\Controller\Admin;

use App\Entity\Filiere;
use App\Form\FiliereType;
use App\Repository\FiliereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/filiere")
 */
class FiliereController extends AbstractController
{
    /**
     * @Route("/", name="admin_filiere_index", methods={"GET"})
     */
    public function index(FiliereRepository $filiereRepository): Response
    {
        return $this->render('admin/filiere/index.html.twig', [
            'filieres' => $filiereRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_filiere_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $filiere = new Filiere();
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($filiere);
            $entityManager->flush();

            return $this->redirectToRoute('admin_filiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/filiere/new.html.twig', [
            'filiere' => $filiere,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_filiere_show", methods={"GET"})
     */
    public function show(Filiere $filiere): Response
    {
        return $this->render('admin/filiere/show.html.twig', [
            'filiere' => $filiere,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_filiere_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Filiere $filiere): Response
    {
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_filiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/filiere/edit.html.twig', [
            'filiere' => $filiere,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_filiere_delete", methods={"POST"})
     */
    public function delete(Request $request, Filiere $filiere): Response
    {
        if ($this->isCsrfTokenValid('delete'.$filiere->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($filiere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_filiere_index', [], Response::HTTP_SEE_OTHER);
    }
}
