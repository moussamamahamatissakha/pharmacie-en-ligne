<?php

namespace App\Controller;

use App\Entity\Comprime;
use App\Entity\Medicament;
use App\Entity\Poudre;
use App\Entity\Sirop;
use App\Form\MedicamentType;
use App\Repository\MedicamentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class MedicamentController extends AbstractController
{
    #[Route('/addMedicament', name: 'add_medicament')]
    public function index(Request $request, SluggerInterface $slugger,
    EntityManagerInterface $manager,MedicamentRepository $medicamentRepository): Response
    {
        $medicament = new Medicament();
        $form = $this->createForm(MedicamentType::class, $medicament);
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

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                // $img=new Image();
                // $img->setName($newFilename);
                // $img->setEtat("valide");
                // $manager->persist($newFilename);
                // $manager->flush();
                //$burger->setImage($img);
                $medicament->setImage($newFilename);
                $medicament->setEtat("active");
                $manager->persist($medicament);
                $manager->flush();  

            }

            // ... persist the $product variable or any other work

            return $this->redirectToRoute('add_medicament');
        }
        return $this->render('medicament/index.html.twig', [
            'form' => $form->createView()
        ]);

    }
    //add comprimer
    
    #[Route('/addComprimer', name: 'add_comprimer')]
    public function add_comprimer(Request $request, SluggerInterface $slugger,
    EntityManagerInterface $manager,MedicamentRepository $medicamentRepository): Response
    {
        $comprimer = new Comprime();
        $form = $this->createForm(MedicamentType::class, $comprimer);
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

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                // $img=new Image();
                // $img->setName($newFilename);
                // $img->setEtat("valide");
                // $manager->persist($newFilename);
                // $manager->flush();
                //$burger->setImage($img);
                $comprimer->setImage($newFilename);
                $comprimer->setEtat("active");
                $manager->persist($comprimer);
                $manager->flush();  

            }

            // ... persist the $product variable or any other work

            return $this->redirectToRoute('add_comprimer');
        }
        return $this->render('medicament/index.html.twig', [
            'form' => $form->createView()
        ]);

    }
    //add sirop
    #[Route('/addSirop', name: 'add_sirop')]
    public function add_sirop(Request $request, SluggerInterface $slugger,
    EntityManagerInterface $manager,MedicamentRepository $medicamentRepository): Response
    {
        $sirop = new Sirop();
        $form = $this->createForm(MedicamentType::class, $sirop);
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

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                // $img=new Image();
                // $img->setName($newFilename);
                // $img->setEtat("valide");
                // $manager->persist($newFilename);
                // $manager->flush();
                //$burger->setImage($img);
                $sirop->setImage($newFilename);
                $sirop->setEtat("active");
                $manager->persist($sirop);
                $manager->flush();  

            }

            // ... persist the $product variable or any other work

            return $this->redirectToRoute('add_sirop');
        }
        return $this->render('medicament/index.html.twig', [
            'form' => $form->createView()
        ]);

    }
    //add poudre
     //add sirop
    //add comprimer
    
    #[Route('/addPoudre', name: 'add_poudre')]
    public function add_poudre(Request $request, SluggerInterface $slugger,
    EntityManagerInterface $manager,MedicamentRepository $medicamentRepository): Response
    {
        $poudre = new Poudre();
        $form = $this->createForm(MedicamentType::class, $poudre);
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

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                // $img=new Image();
                // $img->setName($newFilename);
                // $img->setEtat("valide");
                // $manager->persist($newFilename);
                // $manager->flush();
                //$burger->setImage($img);
                $poudre->setImage($newFilename);
                $poudre->setEtat("active");
                $manager->persist($poudre);
                $manager->flush();  

            }

            // ... persist the $product variable or any other work

            return $this->redirectToRoute('add_poudre');
        }
        return $this->render('medicament/index.html.twig', [
            'form' => $form->createView()
        ]);

    }
}
/* 
#[Route('/boisson', name: 'app_boisson')]
    public function index(Request $request, SluggerInterface $slugger,PaginatorInterface $paginator,
    EntityManagerInterface $manager,BoissonRepository $boissonRepo): Response
    {
        //
        $boissonAll=$boissonRepo->findAll();
        $boissons = $paginator->paginate(
            $boissonAll, 
            $request->query->getInt('page', 1),2
        );
        $boisson = new Boisson();
        $form = $this->createForm(BoissonType::class, $boisson);
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

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                // $img=new Image();
                // $img->setName($newFilename);
                // $img->setEtat("valide");
                // $manager->persist($newFilename);
                // $manager->flush();
                //$burger->setImage($img);
                $boisson->setImage($newFilename);
                $boisson->setEtat("acrive");
                $manager->persist($boisson);
                $manager->flush();  

            }

            // ... persist the $product variable or any other work

            return $this->redirectToRoute('app_boisson');
        }
        return $this->render('boisson/index.html.twig', [
            'form' => $form->createView(),
            'boissons' => $boissons
        ]);
       
    }



*/
