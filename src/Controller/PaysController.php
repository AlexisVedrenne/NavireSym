<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pay;
use App\Repository\PayRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\Form\PaysType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

     /**
     * @Route("/pays", name="pays_")
     */
class PaysController extends AbstractController
{
    /**
     * @Route("/pays", name="pays")
     */
    public function index(): Response
    {
        return $this->render('pays/index.html.twig', [
            'controller_name' => 'PaysController',
        ]);
    }
    
    /**
     * @Route("/voirtous",name="voirtous")
     * @Template("pays/voirtous.html.twig")
     * @param PayRepository $repo
     * @return type
     */
    public function VoirTous(PayRepository $repo){
        $lesPays=$repo->findAll();
        return array('lesPays'=>$lesPays);
    }
    
    /**
     * @Route("/voir/{id}",name="voir") 
     * @param PayRepository $repo
     * @param type $nom
     * @return type
     */
    public function voirUn(Request $request,PayRepository $repo,int $id, EntityManagerInterface $manager){
        $lePays=$repo->find($id);
        $form=$this->createForm(PaysType::class,$lePays);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $manager->persist($lePays);
            $manager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('pays/voir.html.twig',['form'=>$form->createView(),]);
    }
}
