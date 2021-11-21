<?php

namespace App\Controller\Admin;

use App\Entity\Cour;
use App\Form\CourType;
use App\Repository\CourRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/cour")
 */
class CourController extends AbstractController
{
    /**
     * @Route("/", name="admin_cour_index", methods={"GET"})
     */
    public function index(CourRepository $courRepository): Response
    {
        return $this->render('admin/cour/index.html.twig', [
            'cours' => $courRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_cour_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cour = new Cour();
        $form = $this->createForm(CourType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cour);
            $entityManager->flush();

            return $this->redirectToRoute('admin_cour_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/cour/new.html.twig', [
            'cour' => $cour,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_cour_show", methods={"GET"})
     */
    public function show(Cour $cour): Response
    {
        return $this->render('admin/cour/show.html.twig', [
            'cour' => $cour,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_cour_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cour $cour): Response
    {
        $form = $this->createForm(CourType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_cour_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/cour/edit.html.twig', [
            'cour' => $cour,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_cour_delete", methods={"POST"})
     */
    public function delete(Request $request, Cour $cour): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_cour_index', [], Response::HTTP_SEE_OTHER);
    }
}
