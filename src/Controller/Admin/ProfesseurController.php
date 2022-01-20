<?php

namespace App\Controller\Admin;

use App\Entity\Matiere;
use App\Entity\Professeur;
use App\Entity\User;
use App\Form\ProfesseurEditType;
use App\Form\ProfesseurType;
use App\Form\UserType;
use App\Repository\ProfesseurRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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
    public function index(ProfesseurRepository $professeurRepository, UserRepository $userRepository): Response
    {
        return $this->render('admin/professeur/index.html.twig', [
            'professeurs' =>$professeurRepository->findAll(),
            'parent_page'=>$this->parent_page
        ]);
    }

    /**
     * @Route("/new", name="admin_professeur_new", methods={"GET","POST"})
     */
    public function new(Request $request,UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $user = new User();
        $form = $this->createForm(ProfesseurType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(['ROLE_PROFESSEUR']);
            $professeur = new Professeur();
            $matieres = $form->get('matieres')->getData();
            foreach ($matieres as $key => $value) {
                $professeur->addMatiere($value);
            }
            $professeur->setTitre($form->get('titre')->getData());
            $user->setProfesseur($professeur);
            $user->setPassword($userPasswordHasherInterface->hashPassword($user,$user->getPassword()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success','Professeur enregistré');
            return $this->redirectToRoute('admin_professeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/professeur/new.html.twig', [
            'professeur' => $user,
            'form' => $form,
            'parent_page'=>$this->parent_page
        ]);
    }

    // /**
    //  * @Route("/{id}", name="admin_professeur_show", methods={"GET"})
    //  */
    // public function show(Professeur $professeur,UserRepository $userRepository): Response
    // {
    //     $professeur = $userRepository->professeurs($professeur);
    //     return $this->render('admin/professeur/show.html.twig', [
    //         'user' => $professeur,
    //         'parent_page'=>$this->parent_page
    //     ]);
    // }

    /**
     * @Route("/{id}/edit", name="admin_professeur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Professeur $professeur): Response
    {
        $form = $this->createForm(ProfesseurEditType::class, $professeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_professeur_index', [], Response::HTTP_SEE_OTHER);
        }
        // dd($user);
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
