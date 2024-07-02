<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    // Configure fields to be displayed in the CRUD interface
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('username'),
            TextField::new('roles'),
            TextField::new('password')->hideOnIndex(),
        ];
    }
}
