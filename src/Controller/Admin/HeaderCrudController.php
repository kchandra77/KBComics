<?php

namespace App\Controller\Admin;

use App\Entity\Header;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class HeaderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Header::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'titre du header'),
            TextareaField::new('content','Contenu de notre header'),
            TextField::new('btnTitle', 'titre de notre bouton'),
            TextField::new('btnUrl', 'url de destination de notre bouton'),
            ImageField::new('illustration')
            ->setUploadDir('public\uploads')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setBasePath('uploads/')
            ->setRequired(false),
        ];
    }
    
}
