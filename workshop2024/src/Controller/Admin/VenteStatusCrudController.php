<?php

namespace App\Controller\Admin;

use App\Entity\VenteStatus;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VenteStatusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VenteStatus::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom du statut'),
        ];
    }
}
