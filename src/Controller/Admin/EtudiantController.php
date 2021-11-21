<?php

namespace App\Controller\Admin;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/etudiant")
 */
class EtudiantController extends AbstractController
{
    private $parent_page = 'Etudiant';
    /**
     * @Route("/", name="admin_etudiant_index", methods={"GET"})
     */
    public function index(EtudiantRepository $etudiantRepository): Response
    {
        return $this->render('admin/etudiant/index.html.twig', [
            'etudiants' => $etudiantRepository->findAll(),
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/new", name="admin_etudiant_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $etudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etudiant);
            $entityManager->flush();

            return $this->redirectToRoute('admin_etudiant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/etudiant/new.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form,
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/{id}", name="admin_etudiant_show", methods={"GET"})
     */
    public function show(Etudiant $etudiant): Response
    {
        return $this->render('admin/etudiant/show.html.twig', [
            'etudiant' => $etudiant,
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_etudiant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Etudiant $etudiant): Response
    {
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_etudiant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/etudiant/edit.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form,
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/{id}", name="admin_etudiant_delete", methods={"POST"})
     */
    public function delete(Request $request, Etudiant $etudiant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etudiant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($etudiant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_etudiant_index', [], Response::HTTP_SEE_OTHER);
    }
}
