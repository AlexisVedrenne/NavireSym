<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\PortType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Port;
use App\Entity\Pay;
use App\Repository\PortRepository;
/**
 * @Route("/port", name="port_")
 */
class PortController extends AbstractController {

    public function index(): Response {
        return $this->render('port/index.html.twig', [
                    'controller_name' => 'PortController',
        ]);
    }

    /**
     * @Route("/creer",name="creer")
     * @Template("port/edit.html.twig")
     */
    public function creer(Request $request, EntityManagerInterface $manager): Response {
        $port = new Port();
        $form=$this->createForm(PortType::class,$port);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $manager->persist($port);
            $manager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('port/edit.html.twig',['form'=>$form->createView(),]);
    }

    /**
     * @Route("/voirtous",name="voirTous")
     * @Template("port/voirTous.html.twig")
     * @param PortRepository $repo
     * @return type
     */
    public function voirTous(PortRepository $repo){
        $lesPorts=$repo->findAll();
        return array('lesPorts'=>$lesPorts);
    }
    
    /**
     * @Route("/voir/{id}",name="voir")
     * @param PortRepository $repo
     * @param int $id
     * @return type
     */
    public function voir(PortRepository $repo,int $id){
        $lePort=$repo->find($id);
        $form=$this->createForm(PortType::class,$lePort);
        return $this->render('port/edit.html.twig',['form'=>$form->createView(),]);
    }
}
