<?php

namespace App\Controller;

use App\Entity\Livreur;
use App\Form\LivreurType;
use App\Repository\CommandeRepository;
use App\Repository\LivreurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class LivreurController extends AbstractController
{
    #[Route('/livreur', name: 'app_livreur')]
    public function index(Request $request, SluggerInterface $slugger,
    EntityManagerInterface $manager,LivreurRepository $livreurRepository): Response
    {
        $livreur = new Livreur();
        $form = $this->createForm(LivreurType::class, $livreur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          
            $brochureFile = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $livreur->setImage($newFilename);
                $livreur->setEtat("disponible");
                $manager->persist($livreur);
                $manager->flush();  

            }
            // ... persist the $product variable or any other work

            return $this->redirectToRoute('list_livreur');
        }
        return $this->render('livreur/add.html.twig', [
            'controller_name' => 'LivreurController',
            'form' => $form->createView()
        ]);
    }
    #[Route('/listLvreurs', name: 'list_livreur')]
    public function list_livreur(Request $request, SluggerInterface $slugger,
    EntityManagerInterface $manager,LivreurRepository $livreurRepository): Response
    {
        $idCommande=2;

        $livreurs=$livreurRepository->findAll();
        return $this->render('livreur/list.html.twig', [
            'livreurs' => $livreurs,
            'idCommande' => $idCommande
        ]);

    }
    #[Route('/livrerCommande/{id}', name: 'livrerCommande')]
    public function livrerCommande(int $id,LivreurRepository $livreurRepository, EntityManagerInterface $em,
    CommandeRepository $commandeRepository,Request $request): Response
    {
        $livreur=$livreurRepository->find($id);
        $idCommande=$request->request->get('idCommande');
        $idCommande=intval($idCommande);
        $commande=$commandeRepository->find($idCommande);
        $commande->setLivreur($livreur);
        $livreur->setEtat("indisponible");
        $em->persist($commande);
        $em->flush();
        $em->persist($livreur);
        $em->flush();
        return $this->redirectToRoute('all_commande');
    }
    /* 
    livrerCommande
     * //changer etat d'un commande en valide
    #[Route('/changerEtatCommande/{id}', name: 'changerEtatCommande')]
    public function changerEtatCommande(int $id,CommandeRepository $commandeRepo, EntityManagerInterface $em): Response
    {
        $commande=$commandeRepo->find($id);
        $commande->setEtat("valide");
        $em->persist($commande);
        $em->flush();

        return $this->redirectToRoute('all_commande');
    }
     * 
     * 
    */

}
