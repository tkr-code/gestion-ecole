<?php

namespace App\Controller\Admin;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/formation")
 */
class FormationController extends AbstractController
{
    private $parent_page = 'Formation';
    /**
     * @Route("/", name="admin_formation_index", methods={"GET"})
     */
    public function index(FormationRepository $formationRepository): Response
    {
        return $this->render('admin/formation/index.html.twig', [
            'formations' => $formationRepository->findAll(),
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/new", name="admin_formation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formation);
            $entityManager->flush();
            $this->addFlash('success','Nouvelle formation enrgistrée');

            return $this->redirectToRoute('admin_formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/formation/new.html.twig', [
            'formation' => $formation,
            'form' => $form,
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/{id}", name="admin_formation_show", methods={"GET"})
     */
    public function show(Formation $formation): Response
    {
        return $this->render('admin/formation/show.html.twig', [
            'formation' => $formation,
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_formation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formation $formation): Response
    {
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Formation modifiée');
            return $this->redirectToRoute('admin_formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/formation/edit.html.twig', [
            'formation' => $formation,
            'form' => $form,
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/{id}", name="admin_formation_delete", methods={"POST"})
     */
    public function delete(Request $request, Formation $formation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_formation_index', [], Response::HTTP_SEE_OTHER);
    }
}
