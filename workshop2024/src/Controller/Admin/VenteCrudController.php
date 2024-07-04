<?php

namespace App\Controller\Admin;

use App\Entity\Vente;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VenteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vente::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('peinture', 'Peinture'),
            AssociationField::new('client', 'Client'),
            AssociationField::new('status', 'Statut de la vente'),
            DateTimeField::new('realisedAt', 'Date de réalisation'),
            MoneyField::new('amount', 'Montant')
                ->setCurrency('EUR')
                ->hideWhenCreating() // Cacher lors de la création
                ->hideWhenUpdating(), // Cacher lors de la mise à jour
        ];
    }
}
