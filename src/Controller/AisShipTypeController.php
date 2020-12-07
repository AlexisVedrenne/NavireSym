<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
    public function voirTous(){
        $type=[ 1=>'Reserved',
                2=>'Win In Ground',
                3=>'Special Category',
                4=>'Higt-Speed Craft',
                5=>'Special Category',
                6=>'Passenger',
                7=>'Cargo',
                8=>'Tanker',
                9=>'Other',];
        
        return array('type'=>$type);
    }
}
