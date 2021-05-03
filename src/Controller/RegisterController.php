<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) #--> injection d'independance
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/inscription", name="register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $password = $encoder->encodePassword($user,$user->getPassword()); # recupere le mdp

            #dd($password);
            $user->setPassword($password);
           # $doctrine = $this->getDoctrine()->getManager();
            $this->entityManager->persist($user); #fige la data pour save
            $this->entityManager->flush(); #execute la persistance de la data et tu l'enregesitre
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
