<?php

namespace App\Controller\Admin;

use App\Entity\Note;
use App\Form\NoteType;
use App\Repository\NoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/note")
 */
class NoteController extends AbstractController
{
    private $parent_page = 'Note';
    /**
     * @Route("/", name="admin_note_index", methods={"GET"})
     */
    public function index(NoteRepository $noteRepository): Response
    {
        return $this->render('admin/note/index.html.twig', [
            'notes' => $noteRepository->findAll(),
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/new", name="admin_note_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $note = new Note();
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($note);
            $entityManager->flush();

            return $this->redirectToRoute('admin_note_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/note/new.html.twig', [
            'note' => $note,
            'form' => $form,
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/{id}", name="admin_note_show", methods={"GET"})
     */
    public function show(Note $note): Response
    {
        return $this->render('admin/note/show.html.twig', [
            'note' => $note,
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_note_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Note $note): Response
    {
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_note_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/note/edit.html.twig', [
            'note' => $note,
            'form' => $form,
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/{id}", name="admin_note_delete", methods={"POST"})
     */
    public function delete(Request $request, Note $note): Response
    {
        if ($this->isCsrfTokenValid('delete'.$note->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($note);
            $entityManager->flush();
        }
        return $this->redirectToRoute('admin_note_index', [], Response::HTTP_SEE_OTHER);
    }
}
