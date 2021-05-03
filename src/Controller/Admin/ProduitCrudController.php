<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Entity\Fournisseur;
use App\Entity\Autgeur;
use App\Entity\Genre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;


class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('ref_bd'),
            TextField::new('heros'),
            TextField::new('titre'),
            SlugField::new('slug')->setTargetFieldName('titre'),
            ImageField::new('illustration')
            ->setUploadDir('public\uploads')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setBasePath('uploads/')
            ->setRequired(false),
            TextareaField::new('resume'),
            BooleanField::new('isBest'),
            MoneyField::new('prix_public')->setCurrency('EUR'),
            MoneyField::new('prix_editeur')->setCurrency('EUR'),
            TextField::new('fournisseur'),
            TextField::new('auteur'),
            TextField::new('genre'),
            TextField::new('ref_fournisseur'),
            TextField::new('ref_editeur')
            
        ];
    }
    
}
