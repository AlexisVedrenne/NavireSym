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
use App\Repository\RoleRepository;

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
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(['ROLE' => 'ROLE_USER']);
            $user->setPassword($pwd->encodePassword($user, $request->get('password')));
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('app_login');
        }
        return $this->render('user/inscription.html.twig', ['form' => $form->createView(),]);
    }

    /**
     * @Route("/administration/voirlesusers",name="users")
     * @Template("user/voirtous.html.twig")
     * @param UserRepository $repo
     * @return type
     */
    public function voirTousLesUser(UserRepository $repo) {
        $lesUsers = $repo->findAll();
        return array('users' => $lesUsers);
    }

    /**
     * @Route("/voir/{id}",name="voirun")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserRepository $repo
     * @param RoleRepository $repoole
     * @param int $id
     * @param int $idRole
     * @return type
     */
    public function voir(Request $request, EntityManagerInterface $manager, UserRepository $repo, RoleRepository $repoole, int $id) {
        $user = $repo->find($id);
        $lesRoles=$repoole->findAll();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $role=$request->get('roles');
            $user->setRoles(['ROLE' => 'ROLE_' . $role]);
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('user_users');
        }
        
        return $this->render('user/voirun.html.twig', ['form' => $form->createView(),'role'=>$user->getRoles(),'lesRoles'=>$lesRoles]);
    }

}
