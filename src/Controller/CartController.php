<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Classe\Cart;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;


class CartController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }
     /**
     * @Route("/mon-panier", name="cart")
     */
    public function index(Cart $cart): Response
    {
      
        //dd($cartComplete);
        return $this->render('cart/index.html.twig', [
            'cart' => $cart->getFull()
        ]);
        
    }

    /**
     * @Route("/cart/add/{id}", name="add_to_cart")
     */
    public function add(Cart $cart,$id): Response
    {
        $cart->add($id);
        //dd($id);
        return $this->redirectToRoute('cart');
    }

    
    /**
     * @Route("/cart/remove", name="remove_my_cart")
     */
    public function remove(Cart $cart): Response
    {
        $cart->remove();
        //dd($id);
        return $this->redirectToRoute('products');
    }

    
    /**
     * @Route("/cart/delete/{id}", name="delete_to_cart")
     */
    public function delete(Cart $cart, $id): Response
    {
        $cart->delete($id);
        //dd($id);
        return $this->redirectToRoute('cart');
    }


    /**
     * @Route("/cart/decrease/{id}", name="decrease_to_cart")
     */
    public function decrease(Cart $cart, $id): Response
    {
        $cart->decrease($id);
        //dd($id);
        return $this->redirectToRoute('cart');
    }
}
