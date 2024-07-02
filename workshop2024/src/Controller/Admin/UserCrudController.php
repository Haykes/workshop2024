<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('username', 'Username'),
            TextField::new('password', 'Password')->onlyOnForms(),
            ArrayField::new('roles', 'Roles'),

            // Association field to display related Client entity fields
            AssociationField::new('client', 'Client')
                ->setCrudController(ClientCrudController::class)
                ->autocomplete(),

            // Fields from the Client entity
            TextField::new('client.firstname', 'Client Firstname')->hideOnForm(),
            TextField::new('client.lastname', 'Client Lastname')->hideOnForm(),
            TextField::new('client.adresse', 'Client Adresse')->hideOnForm(),
            TextField::new('client.complement', 'Client Complement')->hideOnForm(),
            TextField::new('client.town', 'Client Town')->hideOnForm(),
            TextField::new('client.postalCode', 'Client Postal Code')->hideOnForm(),
            EmailField::new('client.email', 'Client Email')->hideOnForm(),
            TextField::new('client.phone', 'Client Phone')->hideOnForm(),
        ];
    }
}
