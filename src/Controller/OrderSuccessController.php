<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Order;
use App\Classe\Cart;

class OrderSuccessController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
         $this->entityManager = $entityManager;
    }

    /**
     * @Route("/commande/merci/{stripeSessionId}", name="order_validate")
     */
    public function index(Cart $cart, $stripeSessionId): Response
    {
        $order = $this->entityManager->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);
        
        if(!$order || $order->getUser()!=$this->getUser()) 
        {
            return $this->redirectToRoute('home');
        }

        if($order->getState() ==0){
            //vider la session cart
            $cart->remove();
            // Modifier le statut isPaid de notre commande en mettant 1
            $order->getState(1);
            $this->entityManager->flush();
            // Renvoyer un mail à notre client pour lui confirmez sa commande


        }
       
        // Afficher les quelques informations de la commande de l'utilisateur

        //dd($order);
        return $this->render('order_success/index.html.twig' , [

            'order' => $order
        ]);
    }
}
