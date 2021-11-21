<?php

namespace App\Controller\Admin;

use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/classe")
 */
class ClasseController extends AbstractController
{
    private $parentPage = 'Classe';
    /**
     * @Route("/", name="admin_classe_index", methods={"GET"})
     */
    public function index(ClasseRepository $classeRepository): Response
    {
        return $this->render('admin/classe/index.html.twig', [
            'classes' => $classeRepository->findAll(),
            'parent_page'=>$this->parentPage
        ]);
    }

    /**
     * @Route("/new", name="admin_classe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($classe);
            $entityManager->flush();
            $this->addFlash('success','La classe a été ajoutée');
            return $this->redirectToRoute('admin_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/classe/new.html.twig', [
            'classe' => $classe,
            'form' => $form,
            'parent_page'=>$this->parentPage
        ]);
    }

    /**
     * @Route("/{id}", name="admin_classe_show", methods={"GET"})
     */
    public function show(Classe $classe): Response
    {
        return $this->render('admin/classe/show.html.twig', [
            'classe' => $classe,
            'parent_page'=>$this->parentPage
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_classe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Classe $classe): Response
    {
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/classe/edit.html.twig', [
            'classe' => $classe,
            'form' => $form,
            'parent_page'=>$this->parentPage
        ]);
    }

    /**
     * @Route("/{id}", name="admin_classe_delete", methods={"POST"})
     */
    public function delete(Request $request, Classe $classe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$classe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($classe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_classe_index', [], Response::HTTP_SEE_OTHER);
    }
}
