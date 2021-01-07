<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Navire;
use App\Form\NavireType;
use App\Repository\NavireRepository;
use App\Entity\AisShipType;

/**
 * @Route("/navire", name="navire_")
 */
class NavireController extends AbstractController {

    /**
     * @Route("/navire", name="navire")
     */
    public function index(): Response {
        return $this->render('navire/index.html.twig', [
                    'controller_name' => 'NavireController',
        ]);
    }

    /**
     * @Route("/edit/{id}",name="edit")
     * 
     */
    public function edit(Request $request, EntityManagerInterface $manager, NavireRepository $repo,int $id): Response {
        $navire =$repo->find($id);
        $form= $this->createForm(NavireType::class,$navire);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $manager->persist($navire);
            $manager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('navire/edit.html.twig',['form'=>$form->createView(),'imo'=>$navire->getNumImo(),'mmsi'=>$navire->getNumMMSI()]);
    }

}
