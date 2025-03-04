<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Produit')
            ->setEntityLabelInPlural('Produits')
            ->setPageTitle('index', 'Gestion des Produits')
            ->setPaginatorPageSize(20);
    }

    
    public function configureFields(string $pageName): iterable
    {

        $required=true;
        if($pageName=="edit"){
            $required=false;
        }
        return [
            IdField::new('id')->hideOnForm()->setHelp('Nom Du Produit'), 
            TextField::new('name', 'Nom du produit'), 
            SlugField::new('slug','url')->setTargetFieldName('name')->setHelp('Url de votre produit généré automatiquement'),
            TextEditorField::new('description', 'Description')->setHelp('Description de votre produit'), 
            ImageField::new('illustration', 'Illustration')
                ->setUploadDir('public/uploads')->setBasePath('/uploads')
                ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')
                ->setHelp('Description de votre produit')
                ->setRequired($required)
                ,
         /*   MoneyField::new('price', 'Prix')->setCurrency('EUR'), */
            NumberField::new('price', 'Prix')->setHelp('Prix du HT du produit'),
            ChoiceField::new('tva', 'Taux de tva')->setChoices([
                '5.5%' => '5.5',
                '10 %' => '10' , 
                '20 %' => '20'
            ]),
           AssociationField::new('category', 'Catégorie'), 
        ];
    }
    
}
