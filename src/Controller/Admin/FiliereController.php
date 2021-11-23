<?php

namespace App\Controller\Admin;

use App\Entity\Filiere;
use App\Entity\MonChoix;
use App\Form\FiliereType;
use App\Entity\Departement;
use App\Entity\OptionFiliere;
use App\Form\EditOptionFiliereType;
use App\Form\FiliereOptionType;
use App\Form\OptionFiliereType;
use App\Form\MonChoixType;
use App\Repository\FiliereRepository;
use App\Repository\DepartementRepository;
use App\Repository\OptionFiliereRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/filiere")
 */
class FiliereController extends AbstractController
{
    /**
     * @Route("/", name="admin_filiere_index", methods={"GET"})
     */
    public function index(FiliereRepository $filiereRepository): Response
    {
        return $this->render('admin/filiere/index.html.twig', [
            'filieres' => $filiereRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_filiere_new", methods={"POST","GET"})
     */
    public function new(Request $request, DepartementRepository $d, FiliereRepository $f): Response
    {
        $filiere = new Filiere();
        $form = $this->createForm(FiliereOptionType::class, $filiere);
        $form->handleRequest($request);

        $optionFiliere = $request->request->get("optionFiliere");

        if ($optionFiliere) {
            $ligne = '<tr>
            <th scope="row" class="num">
                
            </th>
            <td>
                <input type="text" id="codeOption[]" name="codeOption[]" class="form-control" style="text-transform:uppercase">
            </td>
            <td>
                <input type="text" id="designationOption[]" name="designationOption[]" class="form-control" style="text-transform:capitalize">
            </td>
       </tr>';
            return new JsonResponse($ligne, 200);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            dump($request);
            //on verifie d'abord si l'ajout d'une option a ete validé
            $rpOption = $request->request->get("filiere_option")["Options"];
            if ($rpOption == "oui") { //on fera l'insertion avec option filiere
                //on insert d'abord la filiere avec ses elements
                $depart = $d->find($request->request->get('filiere_option')["departement"]);

                $filiere->setCode($request->request->get('filiere_option')["code"])
                    ->setDesignation($request->request->get('filiere_option')["designation"])
                    ->setDepartement($depart);

                //on insert le departement
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($filiere);
                $entityManager->flush();

                $id_filiere = $filiere->getId();
                //pour les options filieres nous avons un tableau dimensionnel il faut les parcourir
                $codOpt = $request->request->get("codeOption");
                //dump($codOpt);
                $designOpt = $request->request->get("designationOption");

                //la trouvons le nbre d'element dans le tableau, boucl for
                for ($i = 0; $i < count($codOpt); $i++) {
                    //inserrons maintenant les options de la filiere
                    $optionFiliere = new OptionFiliere();
                    $optionFiliere->setDesignation($designOpt[$i])
                        ->setCode($codOpt[$i])
                        ->setFiliere($f->find($id_filiere));

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($optionFiliere);
                    $entityManager->flush();
                    $this->addFlash('success','Nouvelle Filiere enregistrée');
                }
                //on redirige sur l'esemble des filieres
                return $this->redirectToRoute("admin_filiere_index");
            } else { //on fera l'insertion sans option filiere
                //on insert juste la filiere sans option, ce qui pourra etre modifie s'ils veulent
                $depart = $d->find($request->request->get('filiere_option')["departement"]);

                $filiere->setCode($request->request->get('filiere_option')["code"])
                    ->setDesignation($request->request->get('filiere_option')["designation"])
                    ->setDepartement($depart);

                //on insert le departement
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($filiere);
                $entityManager->flush();
                $this->addFlash('success','Nouvelle Filiere enregistrée');

                //on redirige sur l'esemble des filieres
                return $this->redirectToRoute("admin_filiere_index");
            }
        }

        return $this->renderForm('admin/filiere/new.html.twig', [
            'filiere' => $filiere,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_filiere_show", methods={"GET"})
     */
    public function show($id, Filiere $filiere, OptionFiliereRepository $repo): Response
    {
        //affichons toutes les options d'une filiere si il y en a bien sur
        $options = $repo->findBy(["filiere" => $id]);

        return $this->render('admin/filiere/show.html.twig', [
            'filiere' => $filiere,
            'options' => $options
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_filiere_edit", methods={"GET","POST"})
     */
    public function edit(
        $id,
        Request $request,
        Filiere $filiere,
        OptionFiliereRepository $repo,
        FiliereRepository $f,
        DepartementRepository $d
    ): Response {
        //rend toutes les options d'une filiere si elle existe
        $options = $repo->findBy(["filiere" => $id]);

        //formulaire de filiere uniquement
        $form = $this->createForm(FiliereType::class, $filiere);
        //modification du departement seul
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dump($request);
            $filiere
                ->setCode($request->request->get('filiere')['code'])
                ->setDesignation($request->request->get('filiere')['designation'])
                ->setDepartement($d->find($request->request->get('filiere')['departement']));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($filiere);
            $entityManager->flush();

            return $this->redirectToRoute('admin_filiere_edit', ['id' => $id], Response::HTTP_SEE_OTHER);
        }

        //ajouter une ligne d'option filiere a cree pour une filiere existante
        $OptFi = $request->request->get('optFi');

        //si c'est apple, on ajoute une nouvelle ligne
        if ($OptFi) {
            $ligneF = '<tr>
            <th scope="row" class="num">
                                                                                                                                                                                                                                                                           
            </th>
            <td>
                <input type="text" class="form-control" id="codeOption[]" name="codeOption[]" placeholder="Code Option" style="text-transform:uppercase">
            </td>
            <td>
                <input type="text" class="form-control" id="designOption[]" name="designOption[]" placeholder="designation" style="text-transform:capitalize">
            </td>
        </tr>';
            return new JsonResponse($ligneF, 200);
        }
        //formulaire de creation ou ajout d'une option bien que la filiere est deja cree
        $choix = new MonChoix();
        $optFilForm = $this->createForm(MonChoixType::class, $choix);

        $optFilForm->handleRequest($request);
        if ($optFilForm->isSubmitted() && $optFilForm->isValid()) {
            //dd($request);
            //on verifie d'abord si l'ajout d'une option a ete validé
            $rpOption = $request->request->get("mon_choix")["Options"];
            if ($rpOption == "oui") {
                //pour la nvelle option filiere nous avons un tableau dimensionnel il faut les parcourir
                $codOpt = $request->request->get("codeOption"); //ce sont des tableaux
                //dump($codOpt);
                $designOpt = $request->request->get("designOption"); //ce sont des tableaux
                //dump($designOpt);
                //parcourons le tableau pour l'insertion
                for ($i = 0; $i < count($codOpt); $i++) {
                    //inserrons maintenant les options de la filiere
                    $optionFiliere = new OptionFiliere();
                    $optionFiliere->setDesignation($designOpt[$i])
                        ->setCode($codOpt[$i])
                        ->setFiliere($f->find($id));

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($optionFiliere);
                    $entityManager->flush();
                }
                return $this->redirectToRoute("admin_filiere_edit", ['id' => $id]);
            }
        }

        return $this->renderForm('admin/filiere/edit.html.twig', [
            'filiere' => $filiere, #rend l'objet filiere
            'form' => $form, #rend le formulaire de la filiere que l'on sohaite modiifer
            'Options' => $options, #rend les options de lafiliere selectionnee
            'OptionFiliereForm' => $optFilForm #rend un formulaire permettant d'ajouter une option filiere dans une filiere existante
        ]);
    }
    /**
     * @Route("/{idF}/edit/{idOp}", name="admin_filiere_edit_option", methods={"GET","POST"})
     */
    public function optionFiliere_Edit(
        Request $request,
        $idOp,
        $idF,
        OptionFiliereRepository $O,
        FiliereRepository $f
    ) {
        $filiere = $f->find($idF);
        $optionFiliere = $O->find($idOp);
        $form = $this->createForm(EditOptionFiliereType::class, $optionFiliere);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // dump($request);
            $optionFiliere
                ->setCode($request->request->get("edit_option_filiere")["code"])
                ->setDesignation($request->request->get("edit_option_filiere")["designation"])
                ->setFiliere($filiere);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($optionFiliere);
            $entityManager->flush();

            return $this->redirectToRoute('admin_filiere_edit', ['id' => $idF]);
        }
        return $this->renderForm(
            "admin/filiere/OptionFiliereEdit.html.twig",
            [
                'form' => $form,
                'filiere' => $filiere
            ]
        );
    }

    /**
     * @Route("/del", name="admin_filiere_del_option", methods={"GET","POST"})
     */
    public function OptionFiliere_delete(Request $request,OptionFiliereRepository $O)
    {   
        $del = $request->request->get("del");
        if ($del) {
            $id = $request->request->get("id");
            $filiere = $O->find($id);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($filiere);
            $entityManager->flush();
            $response = ["message"=>"ok"];
        } else {
            $response = ["message"=>"erreur"];
        }
        return new JsonResponse($response,200);
    }

    /**
     * @Route("/{id}", name="admin_filiere_delete", methods={"POST"})
     */
    public function delete(Request $request, Filiere $filiere): Response
    {
        if ($this->isCsrfTokenValid('delete' . $filiere->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($filiere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_filiere_index', [], Response::HTTP_SEE_OTHER);
    }
}
