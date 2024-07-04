<?php

namespace App\Controller\Admin;

use App\Entity\Peinture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PeintureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Peinture::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Nom de la peinture'),
            TextField::new('number', 'Numéro de la peinture'),
            NumberField::new('width', 'Largeur'),
            NumberField::new('height', 'Hauteur'),
            TextField::new('method', 'Méthode'),
            DateTimeField::new('createdAt', 'Date de création')->hideOnForm(),
            TextareaField::new('description', 'Description'),
            NumberField::new('prize', 'Prix'),
            NumberField::new('quantity', 'Quantité'),
            ImageField::new('mainPhotoUrl', 'Photo principale')
                ->setBasePath('/uploads/images/peintures')
                ->onlyOnIndex(),
            TextField::new('mainPhotoFile', 'Photo principale')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),
        ];
    }
}
