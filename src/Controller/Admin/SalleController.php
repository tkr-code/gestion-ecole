<?php

namespace App\Controller\Admin;

use App\Entity\Salle;
use App\Form\SalleType;
use App\Repository\SalleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/salle")
 */
class SalleController extends AbstractController
{
    private $parent_page = 'Salle';
    /**
     * @Route("/", name="admin_salle_index", methods={"GET"})
     */
    public function index(SalleRepository $salleRepository): Response
    {
        return $this->render('admin/salle/index.html.twig', [
            'salles' => $salleRepository->findAll(),
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/new", name="admin_salle_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $salle = new Salle();
        $form = $this->createForm(SalleType::class, $salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($salle);
            $entityManager->flush();

            return $this->redirectToRoute('admin_salle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/salle/new.html.twig', [
            'salle' => $salle,
            'form' => $form,
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/{id}", name="admin_salle_show", methods={"GET"})
     */
    public function show(Salle $salle): Response
    {
        
        return $this->render('admin/salle/show.html.twig', [
            'salle' => $salle,
            'parent_page'=>$this->parent_page

        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_salle_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Salle $salle): Response
    {
        $form = $this->createForm(SalleType::class, $salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_salle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/salle/edit.html.twig', [
            'salle' => $salle,
            'form' => $form,
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/{id}", name="admin_salle_delete", methods={"POST"})
     */
    public function delete(Request $request, Salle $salle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$salle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($salle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_salle_index', [], Response::HTTP_SEE_OTHER);
    }
}
