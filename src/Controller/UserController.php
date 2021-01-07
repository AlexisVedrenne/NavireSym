<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

    /**
    * @Route("/user", name="user_")
    */
class UserController extends AbstractController {

    /**
     * @Route("/user", name="user")
     */
    public function index(): Response {
        return $this->render('user/index.html.twig', [
                    'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/inscription",name="inscription")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function inscription(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $pwd): Response {
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(['ROLE'=>'ROLE_USER']);
            $user->setPassword($pwd->encodePassword($user, $form->get('password')->getData()));
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('app_login');
        }
        return $this->render('user/inscription.html.twig', ['form' => $form->createView(),]);
    }
    
    /**
     * @Route("/voirLesUsers",name="users")
     * @Template("user/voirtous.html.twig")
     * @param UserRepository $repo
     * @return type
     */
    public function voirTousLesUser(UserRepository $repo){
        $lesUsers=$repo->findAll();
        return array('users'=>$lesUsers);
    }
}
