<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Gestion des clients')
            ->setEntityLabelInSingular('Gestion du client')
            ->setPageTitle('index', 'Gestion des clients')
            ->setPaginatorPageSize(10);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $client = new User();
        $client->setClient($entityInstance->getUsers());
        $client->setEmail($entityInstance->getEmail());
        $client->setPassword($entityInstance->getPassword());
        $client->setRoles(['ROLE_CLIENT']);
        $client->setClient($entityInstance);
        $entityManager->persist($client);
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
//        $entityInstance->getUsers()->setUsername($entityInstance->getUserName());
//        $entityInstance->getUsers()->setPassword($entityInstance->getPassword());

        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {

        $entityManager->remove($entityInstance);
        $entityManager->flush();
    }

    public function configureActions(Actions $actions): Actions
    {
        $actions->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action){
            $action->setLabel("Créer un client");
            return $action;
        });
        return parent::configureActions($actions);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex()->hideOnForm(),
            TextField::new('nom'),
            TextField::new('adresse'),
            TextField::new('code_postale'),
            TextField::new('ville'),
            EmailField::new('email'),
            DateTimeField::new('createdAt', 'Crée à (date)')->hideOnForm()->setFormTypeOption('disabled', 'disabled'),
            DateTimeField::new('updatedAt', 'Mis à jour à (date)')->hideOnForm()->setFormTypeOption('disabled', 'disabled'),
            TextField::new('password')->hideOnIndex(),
            TextField::new('createdBy', 'Crée par')->hideOnForm()->setFormTypeOption('disabled', 'disabled'),

        ];
    }
}
