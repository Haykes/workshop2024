<?php

namespace App\Controller\Admin;

use App\Entity\Peinture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PeintureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Peinture::class;
    }

    // Configure fields to be displayed in the CRUD interface
    public function configureFields(string $pageName): iterable
    {
        return [
        ];
    }
}
