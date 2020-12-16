<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\Repository\AisShipTypeRepository;
use App\Entity\Port;

class AisShipTypeController extends AbstractController
{
    /**
     * @Route("/aisshiptype", name="aisshiptype")
     */
    public function index(): Response
    {
        return $this->render('ais_ship_type/index.html.twig', [
            'controller_name' => 'AisShipTypeController',
        ]);
    }
    
    /**
     * @Route("/aisshiptype/voirtous", name="aisshiptype_voirtous")
     * @Template("aisshiptype/voirtous.html.twig")
     */
    public function voirTous(AisShipTypeRepository $repo){
        $type=$repo->findAll();      
        return array('type'=>$type);
    }
    
    /**
     * @Route("/aisshiptype/portcompatible/{id}", name="aisshiptype_portcompatible")
     * @Template("aisshiptype/portcompatible.html.twig")
     */
    public function portCompatible(int $id,AisShipTypeRepository $repo){
        $type=$repo->find($id);
        $lesPorts=$type->getLesPorts();
        return array('lesPort'=>$type->getLesPorts());
    }
}
