<?php

namespace App\Controller\Admin;

use App\Entity\DateEntreeFonction;
use App\Entity\DateSortieFonction;
use App\Entity\User;
use App\Entity\MonChoix;
use App\Entity\Personne;
use App\Form\MonChoixType;
use App\Entity\Departement;
use App\Form\MonChoix_1Type;
use App\Form\MonChoix_2Type;
use App\Form\MonChoix_3Type;
use App\Form\PasswordEditType;
use App\Entity\DepartementChoix;
use App\Repository\UserRepository;
use App\Entity\ResponsableDepartement;
use App\Form\DepartementSelectionType;
use App\Form\ResponsableDepartementDateEntreeFonctionType;
use App\Form\ResponsableDepartementType;
use App\Form\ResponsableDepartementType1;
use App\Repository\DepartementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ResponsableDepartementDateFonctionType;
use App\Form\ResponsableDepartementDateSortieFonctionType;
use App\Repository\ResponsableDepartementRepository;
use DateTime;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("/admin/responsable/departement")
 */
class ResponsableDepartementController extends AbstractController
{
    /**
     * @Route("/", name="admin_responsable_departement_index", methods={"GET"})
     */
    public function index(
        ResponsableDepartementRepository $responsableDepartementRepository,
        UserRepository $u
    ): Response {
        return $this->render('admin/responsable_departement/index.html.twig', [
            'responsable_departements' => $u->getAllresponsable()

        ]);
    }

    /**
     * @Route("/new", name="admin_responsable_departement_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordHasherInterface $hash): Response
    {
        $user = new User();
        $form = $this->createForm(ResponsableDepartementType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(["ROLE_RESPONSABLE_DEPARTEMENT"])
                ->setPassword($hash->hashPassword($user, $user->getPassword()));
            $respo = new ResponsableDepartement();
            $respo->setDateEntreFonction($form->get('date_entre_fonction')->getData())
                ->setDateSortieFonction($form->get('date_sortie_fonction')->getData())
                ->setDepartement($form->get('departement')->getData());
            $user->setResponsable($respo);
            // dd($form);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Un Nouveau responsable à été enregistré');

            return $this->redirectToRoute('admin_responsable_departement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/responsable_departement/new.html.twig', [
            'responsable_departement' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_responsable_departement_show", methods={"GET"})
     */
    // public function show(ResponsableDepartement $responsableDepartement): Response
    // {
    //     return $this->render('admin/responsable_departement/show.html.twig', [
    //         'responsable_departement' => $responsableDepartement,
    //     ]);
    // }

    /**
     * @Route("/{id}/edit", name="admin_responsable_departement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, DepartementRepository $d): Response
    {
        $depart = $user->getResponsable()->getDepartement()->getDesignation();
        $date_entre_fonct = $user->getResponsable()->getDateEntreFonction();
        $date_sortie_fonct = $user->getResponsable()->getDateSortieFonction();
        $choix = new MonChoix();
        $choix_1 = new MonChoix();
        $choix_2 = new MonChoix();
        $choix_3 = new MonChoix();

        $departement = new DepartementChoix();
        $respo = new ResponsableDepartement();

        $formPassword = $this->createForm(PasswordEditType::class);

        $formChoix = $this->createForm(MonChoixType::class, $choix);
        $formChoix_1 = $this->createForm(MonChoix_1Type::class, $choix_1);
        $formChoix_2 = $this->createForm(MonChoix_2Type::class, $choix_2);
        $formChoix_3 = $this->createForm(MonChoix_3Type::class, $choix_3);

        $form = $this->createForm(ResponsableDepartementType1::class, $user);
        $form->handleRequest($request);

        #concerne uniquement les infos personnelles que l'on mettra à jour
        if ($form->isSubmitted() && $form->isValid()) {

            //dd($form);
            //on modifie la personne
            $personne = new Personne();
            $personne->setNom($user->getPersonne()->getNom())
                ->setPrenom($user->getPersonne()->getPrenom())
                ->setAvatar($user->getPersonne()->getAvatar())
                ->setProfession($user->getPersonne()->getProfession());
            $user->setEmail($user->getEmail());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Modification du responsable reussie');

            return $this->redirectToRoute('admin_responsable_departement_index', [], Response::HTTP_SEE_OTHER);
        }

        $formDepartement = $this->createForm(DepartementSelectionType::class, $departement);
        $formDepartement->handleRequest($request);

        #concernant le changemet du department qu'il doit diriger
        if ($formDepartement->isSubmitted() && $formDepartement->isValid()) {
            //dump($request->request->get('departement_selection')["designation"]);
            $respo->setDepartement($d->find($request->request->get('departement_selection')["designation"]));
            $respo->setDateEntreFonction($user->getResponsable()->getDateSortieFonction());
            $respo->setDateSortieFonction($user->getResponsable()->getDateSortieFonction());
            $user->setResponsable($respo);
            //dump($user);
            //dd($respo);

            #on persit le user pour valider les modifications
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Modification du responsable reussie : changement de departement');

            return $this->redirectToRoute('admin_responsable_departement_index', [], Response::HTTP_SEE_OTHER);
        }

        $dateEntreeFonction = new DateEntreeFonction();
        $formDateEntreeFonction = $this->createForm(ResponsableDepartementDateEntreeFonctionType::class, $dateEntreeFonction);
        $formDateEntreeFonction->handleRequest($request);
        #concernant la modification de la date d'entree en fonction
        if ($formDateEntreeFonction->isSubmitted() && $formDateEntreeFonction->isValid()) {
            //dump($request->request->get("responsable_departement_date_entree_fonction")["date_entre_fonction"]);
            $respo->setDateEntreFonction(new DateTime($request->request->get("responsable_departement_date_entree_fonction")["date_entre_fonction"]));
            $respo->setDateSortieFonction($user->getResponsable()->getDateSortieFonction());
            $respo->setDepartement($user->getResponsable()->getDepartement());
            $user->setResponsable($respo);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Modification du responsable reussie : changement de la date entree en fonction');
            return $this->redirectToRoute('admin_responsable_departement_index', [], Response::HTTP_SEE_OTHER);

            //dd($respo);
        }

        $dateSortieFonction = new DateSortieFonction();
        $formDateSortieFonction = $this->createForm(ResponsableDepartementDateSortieFonctionType::class, $dateSortieFonction);
        $formDateSortieFonction->handleRequest($request);
        #concernant le changement de la date de sortie en fonction
        if ($formDateSortieFonction->isSubmitted() && $formDateSortieFonction->isValid()) {
            //dump($request);
            //dd($request->request->get("responsable_departement_date_sortie_fonction")["date_sortie_fonction"]);
            $respo->setDateSortieFonction(new DateTime($request->request->get("responsable_departement_date_sortie_fonction")["date_sortie_fonction"]));
            $respo->setDateEntreFonction($user->getResponsable()->getDateEntreFonction());
            $respo->setDepartement($user->getResponsable()->getDepartement());

            $user->setResponsable($respo);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Modification du responsable reussie : changement de la date sortie en fonction');
            return $this->redirectToRoute('admin_responsable_departement_index', [], Response::HTTP_SEE_OTHER);

            //dd($user);

        }

        return $this->renderForm('admin/responsable_departement/edit.html.twig', [
            'responsable_departement' => $user,
            'date_entre_fonct' => $date_entre_fonct,
            'date_sortie_fonct' => $date_sortie_fonct,
            'form' => $form,
            'formChoix' => $formChoix,
            'formChoix_1' => $formChoix_1,
            'formChoix_2' => $formChoix_2,
            'formChoix_3' => $formChoix_3,
            'formDepartement' => $formDepartement,
            'formDateEntreeFonction' => $formDateEntreeFonction,
            'formDateSortieFonction' => $formDateSortieFonction,
            'formPassword' => $formPassword,
            'departement' => $depart,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_responsable_departement_delete", methods={"POST"})
     */
    public function delete(Request $request, ResponsableDepartement $responsableDepartement): Response
    {
        if ($this->isCsrfTokenValid('delete' . $responsableDepartement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($responsableDepartement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_responsable_departement_index', [], Response::HTTP_SEE_OTHER);
    }
}
