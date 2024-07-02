<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstname', 'Prénom')
                ->setHelp('Exemple : Placeholder'),
            TextField::new('lastname', 'Nom')
                ->setHelp('Exemple : Martin'),
            EmailField::new('email', 'Email')
                ->setHelp('Exemple : pierre.martin@exemple.fr'),
            TelephoneField::new('phone', 'Téléphone')
                ->setHelp('Exemple : 06 66 66 66 66'),
            TextField::new('adresse', 'Adresse')
                ->setHelp('Exemple : 33 rue de Lille'),
            TextField::new('complement', 'Complément')
                ->setHelp('Exemple : Appt 19 Résidence Boris Vian'),
            TextField::new('town', 'Ville')
                ->setHelp('Exemple : LILLE'),
            TextField::new('postalCode', 'Code postal')
                ->setHelp('Exemple : 59000'),
            DateTimeField::new('createdAt', 'Créé le')
                ->hideOnForm(),
            DateTimeField::new('updatedAt', 'Mis à jour le')
                ->hideOnForm(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $showClient = Action::new('showClient', 'Voir')
            ->linkToRoute('admin_client_show', function (Client $client): array {
                return ['id' => $client->getId()];
            });

        return $actions
            ->add(Action::INDEX, $showClient);
    }

    #[Route('/admin/client/{id}', name: 'admin_client_show')]
    public function show(Client $client): Response
    {
        return $this->render('admin/client_show.html.twig', [
            'client' => $client,
        ]);
    }
}
