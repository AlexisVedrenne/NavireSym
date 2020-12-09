<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Repository\NavireRepository;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchController extends AbstractController {

    /**
     * @Route("/search", name="search")
     */
    public function index(): Response {
        return $this->render('search/index.html.twig', [
                    'controller_name' => 'SearchController',
        ]);
    }

    /**
     * @Route("search/handlesearch", name="search_handlesearch")
     *
     */
    public function handleSearch(Request $request,NavireRepository $repo): Response{
        $valeur= $request->request->get('form')['cherche'];
        if($request->request->get('form')['choix']=='IMO'){
            $critere="Imo recherché : ". $valeur;
        }
        else{
            $critere="MMSI recherché : ".$valeur;
        }
        return new Response("<h1> $critere </h1>");
    }
    
    public function searchBar() {
        $form = $this->createFormBuilder()
                ->setAction($this->generateUrl("search_handlesearch"))
                ->add('cherche', TextType::class)
                ->add('choix', ChoiceType::class, array(
                    'choices' => array(
                        'IMO' => 'IMO',
                        'MMSI' => 'MMSI',
                    ), 'multiple' => false,
                    'expanded' => true))
                ->add('envoie',SubmitType::class)               
                ->getForm();
        return $this->render('elements/search.html.twig',['formSearch'=>$form->createView()]);
    }

}
