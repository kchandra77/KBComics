<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Produit;
use App\Entity\Header;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $products = $this->entityManager->getRepository(Produit::class)->findByIsBest(1);
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        
        return $this->render('home/index.html.twig',[
            "products" => $products,
            "headers" => $headers
        ]);
    }
}
