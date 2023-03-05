<?php

namespace App\Controller;

use App\Entity\Medicament;
use App\Repository\MedicamentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(): Response
    {
        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
        ]);
    }
    //ajoutPanier qui permet d'ajouter un produit au panier il se trouve au page d'acceuil
    //redirige aussi vers la page d'acceuil
    #[Route('/ajouPanier/{id}',name:'ajouPanier',methods:['GET'])]
    public function ajouPanier(int $id,SessionInterface $session,MedicamentRepository $medicamentRepository):Response
    {
        $panier=$session->get('panier',[]);
       
        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id]=1;
        }
        $session->set('panier',$panier);
        //
        //$produit= $repositoryProduit->findAll();
        //return $this->render('jabba/homme.html.twig',['produits']);
        return $this->redirectToRoute('app_test');
    }
    //fonction qui affiche information dans le panier qui se trouve a la base
    #[Route('/affichePanier',name:'affichePanier',methods:['GET'])]
    public function affichePanier(SessionInterface $session,MedicamentRepository $medicamentRepository)
    {
        $panier=$session->get('panier',[]);
        $dataPanier=[];
        $totalPanier=0;
        foreach($panier as $id=>$quantite)
        {
            $medicament=$medicamentRepository->find($id);
            $dataPanier[]=[
                'medicament'=>$medicament,
                'quantite'=>$quantite

            ];
            $totalPanier += $medicament->getPrix()*$quantite;

        }
        return $this->render('panier/index.html.twig',compact('dataPanier','totalPanier'));

    }
    //qui permet d'incrementer la quantier d'un produit au panier,son lien
    //qui s'appelle ajout qu panier aui se trove au niveau d'affiche de panier
    //il verifie si le produit ca trouve dans le panier il invrement sinon in ajoute un nv produit
    #[Route('/versLePanier/{id}',name:'versLePanier',methods:['GET'])]
    public function versLePanier(int $id,SessionInterface $session,MedicamentRepository $medicamentRepository):Response
    {
        $panier=$session->get('panier',[]);
       
        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id]=1;
        }
        $session->set('panier',$panier);
        //
        //$produit= $repositoryProduit->findAll();
        //return $this->render('jabba/homme.html.twig',['produits']);
        return $this->redirectToRoute('affichePanier');
    }
     //RetirePanier un element sur le panier,il decremente une quantite 
     #[Route('/RetirePanier/{id}',name:'RetirePanier',methods:['GET'])]
     public function RetirePanier(int $id,SessionInterface $session,MedicamentRepository $medicamentRepository):Response
     {
         $panier=$session->get('panier',[]);
       
         if(!empty($panier[$id])){
             if($panier[$id]>1)
             {
                 $panier[$id]--;
             }else{
                 unset($panier[$id]);
             }
           
         }
         $session->set('panier',$panier);
         //
         //$produit= $repositoryProduit->findAll();
         //return $this->render('jabba/homme.html.twig',['produits']);
         return $this->redirectToRoute('affichePanier');
     }
     //RetirePanier completemnt un element sur le panier
     #[Route('/RetirePanierDeLaPanier/{id}',name:'RetirePanierDeLaPanier',methods:['GET'])]
     public function RetirePanierDeLaPanier(int $id,SessionInterface $session,MedicamentRepository $medicamentRepository):Response
     {
         $panier=$session->get('panier',[]);
       
         if(!empty($panier[$id])){
            unset($panier[$id]);
         }
         $session->set('panier',$panier);
         //
         //$produit= $repositoryProduit->findAll();
         //return $this->render('jabba/homme.html.twig',['produits']);
         return $this->redirectToRoute('affichePanier');
     }
      //ViderPanier
      #[Route('/ViderPanier',name:'ViderPanier',methods:['GET'])]
      public function ViderPanier(SessionInterface $session):Response
      {
          $session->remove('panier');
        
          //
          //$produit= $repositoryProduit->findAll();
          //return $this->render('jabba/homme.html.twig',['produits']);
          return $this->redirectToRoute('app_test');
      }
}
/*
//ajoutPanier qui permet d'ajouter un produit au panier il se trouve au page d'acceuil
    //redirige aussi vers la page d'acceuil
    #[Route('/ajouPanier/{id}',name:'ajouPanier',methods:['GET'])]
    public function ajouPanier(Produit $produit,SessionInterface $session,ProduitRepository $repositoryProduit):Response
    {
        $panier=$session->get('panier',[]);
        $id=$produit->getId();
        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id]=1;
        }
        $session->set('panier',$panier);
        //
        //$produit= $repositoryProduit->findAll();
        //return $this->render('jabba/homme.html.twig',['produits']);
        return $this->redirectToRoute('JabbaAcceil');
    }
    //fonction qui affiche information dans le panier qui se trouve a la base
    #[Route('/affichePanier',name:'affichePanier',methods:['GET'])]
    public function affichePanier(SessionInterface $session,ProduitRepository $repositoryProduit)
    {
        $panier=$session->get('panier',[]);
        $dataPanier=[];
        $totalPanier=0;
        foreach($panier as $id=>$quantite)
        {
            $produit=$repositoryProduit->find($id);
            $dataPanier[]=[
                'produit'=>$produit,
                'quantite'=>$quantite

            ];
            $totalPanier += $produit->getPrix()*$quantite;

        }
        return $this->render('panier/panier.html.twig',compact('dataPanier','totalPanier'));

    }
    //qui permet d'incrementer la quantier d'un produit au panier,son lien
    //qui s'appelle ajout qu panier aui se trove au niveau d'affiche de panier
    //il verifie si le produit ca trouve dans le panier il invrement sinon in ajoute un nv produit
    #[Route('/versLePanier/{id}',name:'versLePanier',methods:['GET'])]
    public function versLePanier(Produit $produit,SessionInterface $session,ProduitRepository $repositoryProduit):Response
    {
        $panier=$session->get('panier',[]);
        $id=$produit->getId();
        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id]=1;
        }
        $session->set('panier',$panier);
        //
        //$produit= $repositoryProduit->findAll();
        //return $this->render('jabba/homme.html.twig',['produits']);
        return $this->redirectToRoute('affichePanier');
    }
    //RetirePanier un element sur le panier,il decremente une quantite 
    #[Route('/RetirePanier/{id}',name:'RetirePanier',methods:['GET'])]
    public function RetirePanier(Produit $produit,SessionInterface $session,ProduitRepository $repositoryProduit):Response
    {
        $panier=$session->get('panier',[]);
        $id=$produit->getId();
        if(!empty($panier[$id])){
            if($panier[$id]>1)
            {
                $panier[$id]--;
            }else{
                unset($panier[$id]);
            }
          
        }
        $session->set('panier',$panier);
        //
        //$produit= $repositoryProduit->findAll();
        //return $this->render('jabba/homme.html.twig',['produits']);
        return $this->redirectToRoute('affichePanier');
    }
     //RetirePanier completemnt un element sur le panier
     #[Route('/RetirePanierDeLaPanier/{id}',name:'RetirePanierDeLaPanier',methods:['GET'])]
     public function RetirePanierDeLaPanier(Produit $produit,SessionInterface $session,ProduitRepository $repositoryProduit):Response
     {
         $panier=$session->get('panier',[]);
         $id=$produit->getId();
         if(!empty($panier[$id])){
            unset($panier[$id]);
         }
         $session->set('panier',$panier);
         //
         //$produit= $repositoryProduit->findAll();
         //return $this->render('jabba/homme.html.twig',['produits']);
         return $this->redirectToRoute('affichePanier');
     }
     //ViderPanier
     #[Route('/ViderPanier',name:'ViderPanier',methods:['GET'])]
     public function ViderPanier(SessionInterface $session):Response
     {
         $session->remove('panier');
       
         //
         //$produit= $repositoryProduit->findAll();
         //return $this->render('jabba/homme.html.twig',['produits']);
         return $this->redirectToRoute('JabbaAcceil');
     }
*/
