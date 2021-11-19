<?php

namespace App\Controller\Admin;

use App\Entity\ResponsableDepartement;
use App\Form\ResponsableDepartementType;
use App\Repository\ResponsableDepartementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/responsable/departement")
 */
class ResponsableDepartementController extends AbstractController
{
    /**
     * @Route("/", name="admin_responsable_departement_index", methods={"GET"})
     */
    public function index(ResponsableDepartementRepository $responsableDepartementRepository): Response
    {
        return $this->render('admin/responsable_departement/index.html.twig', [
            'responsable_departements' => $responsableDepartementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_responsable_departement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $responsableDepartement = new ResponsableDepartement();
        $form = $this->createForm(ResponsableDepartementType::class, $responsableDepartement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($responsableDepartement);
            $entityManager->flush();
            $this->addFlash('success','Un Nouveau responsable à été enregistré');

            return $this->redirectToRoute('admin_responsable_departement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/responsable_departement/new.html.twig', [
            'responsable_departement' => $responsableDepartement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_responsable_departement_show", methods={"GET"})
     */
    public function show(ResponsableDepartement $responsableDepartement): Response
    {
        return $this->render('admin/responsable_departement/show.html.twig', [
            'responsable_departement' => $responsableDepartement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_responsable_departement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ResponsableDepartement $responsableDepartement): Response
    {
        $form = $this->createForm(ResponsableDepartementType::class, $responsableDepartement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Modification du responsable reussie');

            return $this->redirectToRoute('admin_responsable_departement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/responsable_departement/edit.html.twig', [
            'responsable_departement' => $responsableDepartement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_responsable_departement_delete", methods={"POST"})
     */
    public function delete(Request $request, ResponsableDepartement $responsableDepartement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$responsableDepartement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($responsableDepartement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_responsable_departement_index', [], Response::HTTP_SEE_OTHER);
    }
}
