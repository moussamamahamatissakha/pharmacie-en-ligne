<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Medicament;
use App\Repository\CommandeRepository;
use App\Repository\LivreurRepository;
use App\Repository\MedicamentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CommandeController extends AbstractController
{
    #[Route('/allCommande', name: 'all_commande')]
    public function all_commande(CommandeRepository $commandeRepo): Response
    {     
        $commandes=$commandeRepo->findAll();
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
            'commandes' => $commandes,
        ]);
    }
    #[Route('/mesCommandes', name: 'mes_commandes')]
    public function mes_commandes(CommandeRepository $commandeRepo): Response
    {
       
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $user = $this->getUser();
        $commandes=$commandeRepo->findby(['client'=>$user]);
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
            'commandes' => $commandes,
        ]);
    }
    //details d'un commande 
    #[Route('/detailsCommande/{id}', name: 'detailsCommande')]
    public function detailsCommande(int $id,CommandeRepository $commandeRepo): Response
    {
        $commande=$commandeRepo->find($id);


        return $this->render('commande/details.html.twig', [
            'controller_name' => 'CommandeController',
            'commande' => $commande,
        ]);
    }
    //changer etat d'un commande en valide
    #[Route('/changerEtatCommande/{id}', name: 'changerEtatCommande')]
    public function changerEtatCommande(int $id,CommandeRepository $commandeRepo, LivreurRepository $livreurRepository,EntityManagerInterface $em): Response
    {
        $commande=$commandeRepo->find($id);
        $commande->setEtat("valide");
        $em->persist($commande);
        $em->flush();

        $livreurs=$livreurRepository->findAll();
        return $this->render('livreur/list.html.twig', [
            'livreurs' => $livreurs,
            'idCommande' => $id
        ]);
    }
    //changerEtatCommandePayer
    #[Route('/changerEtatCommandePayer/{id}', name: 'changerEtatCommandePayer')]
    public function changerEtatCommandePayer(int $id,CommandeRepository $commandeRepo, EntityManagerInterface $em): Response
    {
        $commande=$commandeRepo->find($id);
        $commande->setEtat("payée");
        $livreur= $commande->getLivreur();
        $livreur->setEtat("disponible");
        $em->persist($livreur);
        $em->flush();
        $em->persist($commande);
        $em->flush();

        return $this->redirectToRoute('all_commande');
    }
    //changerEtatCommandeAnnuler
    #[Route('/changerEtatCommandeAnnuler/{id}', name: 'changerEtatCommandeAnnuler')]
    public function changerEtatCommandeAnnuler(int $id,CommandeRepository $commandeRepo, EntityManagerInterface $em): Response
    {
        $commande=$commandeRepo->find($id);
        $commande->setEtat("annulée");
        $em->persist($commande);
        $em->flush();

        return $this->redirectToRoute('all_commande');
    }


    //ajout une commande
    #[Route('/add-command', name: 'make_command')]
    public function makeCommand(CommandeRepository $commandeRepo, MedicamentRepository $medicamentRepository, 
    SessionInterface $session, Request $request,
    EntityManagerInterface $em): Response
    {
        $zone = $request->request->get("zone");
        $total=$request->request->get("total");
        $ttoall=(float)$total+1000;
       
       // $x=($_POST['zone']);
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        // $client=new Client();
        // $client=$this->getUser();
        //isset($_POST['secteur']
        $medicaments = $session->get('panier', []);
        if($medicaments!=null){
            $commande = new Commande();
            $commande->setEtat("encours")
                    ->setClient($this->getUser())
                    ->setDate(new \DateTimeImmutable())
                    ->setPrix($ttoall)
                    ->setNumero("")
                    ->setZone($zone);
            foreach ($medicaments as $key=>$idMedicament) {
                //$medicament = new Medicament();
                $medicament = $medicamentRepository->find($key);
                for ($i=0; $i < $idMedicament ; $i++) { 
                    $commande->addMedicament($medicament);
                }
            }
            $em->persist($commande);
            $em->flush();
            $commande->setNumero("CMT_".$commande->getId());
            $em->persist($commande);
            $em->flush();
        }else{
            return $this->redirectToRoute('app_test');
        }
        // On supprime ce qu'il y a dans le panier
        $session->set('panier', []);
        return $this->redirectToRoute('app_test');
    }
    ////
    
    ////

}
/*

#[Route('/commands', name: 'my_commands')]
    public function index(CommandeRepository $repo): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $user = $this->getUser();
        $commandes=$repo->findby(['client'=>$user]);

        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
            'commandes' => $commandes,
        ]);
    }


    #[Route('/add-command', name: 'make_command')]
    public function makeCommand(CommandeRepository $repo, MenuRepository $repoM, SessionInterface $session, 
    EntityManagerInterface $em): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $menus = $session->get('panier', []);
        if($menus!=null){
            $commande = new Commande;
            $commande->setEtat("En cours")
                    ->setClient($this->getUser())
                    ->setCommandedAt(new \DateTimeImmutable());
            foreach ($menus as $key=>$menu) {
                $mn = new Menu;
                $mn = $repoM->find($key);
                for ($i=0; $i < $menu ; $i++) { 
                    $commande->addMenu($mn);
                }
            }
            $em->persist($commande);
            $em->flush();
        }else{
            return $this->redirectToRoute('home');
        }
        // On supprime ce qu'il y a dans le panier
        $session->set('panier', []);
        return $this->redirectToRoute('my_commands');
    }


*/
