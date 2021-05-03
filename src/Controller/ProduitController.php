<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Produit;
use App\Classe\Search;
use App\Form\SearchType;

class ProduitController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/nos-produits", name="products")
     */
    public function index(Request $request): Response
    {
        $products = $this->entityManager->getRepository(Produit::class)->findAll();
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $products = $this->entityManager->getRepository(Produit::class)->findWithSearch($search);
           
        } else {
            $products = $this->entityManager->getRepository(Produit::class)->findAll();
        }

        return $this->render('product/index.html.twig',[
            'products' => $products,
            'form' => $form->createView() 
        ]);
    }

    /**
     * @Route("/produit/{titre}", name="product")
     */
    public function show($titre): Response
    {
        $product = $this->entityManager->getRepository(Produit::class)->findOneByTitre($titre);
        $products = $this->entityManager->getRepository(Produit::class)->findByIsBest(1);

        if (!$product){
            return $this->redirectToRoute('products');
        }

        return $this->render('product/show.html.twig',[
            'product' => $product,
            'products' => $products
        ]);
    }
}
