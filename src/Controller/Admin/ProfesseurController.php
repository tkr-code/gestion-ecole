<?php

namespace App\Controller\Admin;

use App\Entity\Professeur;
use App\Form\ProfesseurType;
use App\Repository\ProfesseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/professeur")
 */
class ProfesseurController extends AbstractController
{
    private $parent_page = 'Professeur' ;
    /**
     * @Route("/", name="admin_professeur_index", methods={"GET"})
     */
    public function index(ProfesseurRepository $professeurRepository): Response
    {
        return $this->render('admin/professeur/index.html.twig', [
            'professeurs' => $professeurRepository->findAll(),
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/new", name="admin_professeur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $professeur = new Professeur();
        $form = $this->createForm(ProfesseurType::class, $professeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($professeur);
            $entityManager->flush();
            $this->addFlash('success','Nouveau Professeur enregistrée');
            return $this->redirectToRoute('admin_professeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/professeur/new.html.twig', [
            'professeur' => $professeur,
            'form' => $form,
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/{id}", name="admin_professeur_show", methods={"GET"})
     */
    public function show(Professeur $professeur): Response
    {
        return $this->render('admin/professeur/show.html.twig', [
            'professeur' => $professeur,
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_professeur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Professeur $professeur): Response
    {
        $form = $this->createForm(ProfesseurType::class, $professeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_professeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/professeur/edit.html.twig', [
            'professeur' => $professeur,
            'form' => $form,
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/{id}", name="admin_professeur_delete", methods={"POST"})
     */
    public function delete(Request $request, Professeur $professeur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$professeur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($professeur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_professeur_index', [], Response::HTTP_SEE_OTHER);
    }
}
