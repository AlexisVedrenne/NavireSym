<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Message;
use App\Form\MessageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use App\Service\GestionContact;

class MessageController extends AbstractController
{
    /**
     * @Route("/message", name="message")
     */
    public function index(): Response
    {
        return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController',
        ]);
    }
    
    /**
     * @Route("/message/envoieMail",name="message_envoieMail")
     * @Template("message/contact.html.twig")
     * @return type
     */
    public function EnvoieMail(Request $request){
        $message= new Message();
        $form=$this->createForm(MessageType::class,$message);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $message=$form->getData();          
            GestionContact::envoiMailContact($message);
            $this->addFlash('notification',"Votre message a bien été envoyé");
        }       
        return array('form'=>$form->createView());
    }
}
