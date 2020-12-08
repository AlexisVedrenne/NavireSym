<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Message;
use App\Form\MessageType;

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
    
    public function EnvoieMail(){
        $message= new Message();
        $form=$this->createForm(MessageType::class,$message);
        $form->handleRequest($request);
        
        return array('formMessage'=>$form->createView());
    }
}
