<?php

namespace App\Controller;

use App\Repository\ComprimeRepository;
use App\Repository\LivreurRepository;
use App\Repository\MedicamentRepository;
use App\Repository\PoudreRepository;
use App\Repository\SiropRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class TestController extends AbstractController
{
    #[Route('/', name: 'app_test')]
    public function index(Request $request,MedicamentRepository $medicamentRepository,
    ComprimeRepository $comprimeRepository,
    SiropRepository $siropRepository,
    PoudreRepository $poudreRepository,

    PaginatorInterface $paginator,UserRepository $userRepository,LivreurRepository $livreurRepository): Response
    {
        $users=$livreurRepository->findAll();
        $medicamentsAll=$medicamentRepository->findAll();
        $medicaments = $paginator->paginate(
            $medicamentsAll, 
            $request->query->getInt('page', 1),6
        );
      
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'users'=> $users,
            'medicaments'=> $medicaments,
        ]);
    }
    //all comprimes
    
    #[Route('/allComprimer', name: 'all_comprimer')]
    public function all_comprimer(Request $request,MedicamentRepository $medicamentRepository,
    ComprimeRepository $comprimeRepository,
    SiropRepository $siropRepository,
    PoudreRepository $poudreRepository,

    PaginatorInterface $paginator,UserRepository $userRepository,LivreurRepository $livreurRepository): Response
    {
        //$users=$userRepository->findAll();
        $users=$livreurRepository->findAll();
        $comprimeAll=$comprimeRepository->findAll();
        $medicaments = $paginator->paginate(
            $comprimeAll, 
            $request->query->getInt('page', 1),6
        );
        
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'medicaments'=> $medicaments,
            'users'=> $users,
     
        ]);
    }
    //all poudres
    
    #[Route('/alPoudre', name: 'all_poudre')]
    public function all_poudre(Request $request,MedicamentRepository $medicamentRepository,
    ComprimeRepository $comprimeRepository,
    SiropRepository $siropRepository,
    PoudreRepository $poudreRepository,

    PaginatorInterface $paginator,UserRepository $userRepository,LivreurRepository $livreurRepository): Response
    {
        //poudre
        $users=$livreurRepository->findAll();
        $poudreAll=$poudreRepository->findAll();
        $medicaments = $paginator->paginate(
            $poudreAll, 
            $request->query->getInt('page', 1),3
        );

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'medicaments'=> $medicaments,
            'users'=> $users,
           
        ]);
    }
    //all sirop
    
    #[Route('/allSirop', name: 'all_sirop')]
    public function all_sirop(Request $request,MedicamentRepository $medicamentRepository,
    ComprimeRepository $comprimeRepository,
    SiropRepository $siropRepository,
    PoudreRepository $poudreRepository,

    PaginatorInterface $paginator,UserRepository $userRepository,LivreurRepository $livreurRepository): Response
    {
        //$users=$userRepository->findAll();
        $users=$livreurRepository->findAll();
       
        //sirop
        $siropAll=$siropRepository->findAll();
        $medicaments = $paginator->paginate(
            $siropAll, 
            $request->query->getInt('page', 1),3
        );
       

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'medicaments'=> $medicaments,
            'users'=> $users,
          
        ]);
    }
}
