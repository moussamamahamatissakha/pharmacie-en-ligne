<?php

namespace App\Controller;

use App\Entity\Ordonnance;
use App\Form\OrdonnanceType;
use App\Repository\OrdonnanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class OrdonnanceController extends AbstractController
{
    #[Route('/ordonnance', name: 'app_ordonnance')]
    public function index(Request $request, SluggerInterface $slugger,
    EntityManagerInterface $manager,OrdonnanceRepository $ordonnanceRepository): Response
    {
        $ordonnance = new Ordonnance();
        $form = $this->createForm(OrdonnanceType::class, $ordonnance);
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
                //var_dump($this->getUser());die;
                $ordonnance->setImage($newFilename);
                $ordonnance->setUser($this->getUser());
                //$ordonnance->setEtat("active");
                $manager->persist($ordonnance);
                $manager->flush();  

            }

            // ... persist the $product variable or any other work

            return $this->redirectToRoute('app_ordonnance');
        }
        $ordonnances=$ordonnanceRepository->findAll();


        return $this->render('ordonnance/index.html.twig', [
            'controller_name' => 'OrdonnanceController',
            'form' => $form->createView(),
            'ordonnances' => $ordonnances
        ]);
    }
}
/*
Request $request, SluggerInterface $slugger,
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

    }*/
