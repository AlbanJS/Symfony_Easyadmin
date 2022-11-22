<?php

namespace App\Controller\Admin;

use App\Entity\Agent;
use App\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\DuplicateService;
use Doctrine\Persistence\ManagerRegistry;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;


class AgentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Agent::class;

    }

    public function configureActions(Actions $actions): Actions
    {
        $cloneAction = Action::new('Clone', 'Dupliquer')
            ->setIcon('fas fa-clone')
            ->linkToCrudAction('cloneAction');

        return $actions
            ->add(Crud::PAGE_INDEX, $cloneAction);

    }


    public function cloneAction(AdminContext $context, ManagerRegistry $doctrine)
    {
        $id     = $context->getRequest()->query->get('entityId');
        $entity = $doctrine->getRepository(Agent::class)->find($id);

        $clone = clone $entity;

        // custom logic
//        $clone->setEnabled(false);
        // ...
        $now = new DateTime();
        $clone->setCreatedAt($now);
        $clone->setUpdatedAt($now);

//        $this->persistEntity($this->get('doctrine')->getManagerForClass($context->getEntity()->getFqcn()), $clone);
//        $this->addFlash('success', 'Product duplicated');

        return $this->get(AdminUrlGenerator::class)->setAction(Action::EDIT)->generateUrl();
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Agents')
            ->setEntityLabelInSingular('Agent')
            ->setPageTitle('index', 'Agents')
            ->setPaginatorPageSize(10);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $agent = new User();
        $agent->setAgent($entityInstance->getUsers());
        $agent->setEmail($entityInstance->getEmail());
        $agent->setPassword($entityInstance->getPassword());
        $agent->setRoles(['ROLE_AGENT']);
        $agent->setAgent($entityInstance);
        $entityManager->persist($agent);
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->getUsers()->setEmail($entityInstance->getEmail());
        $entityInstance->getUsers()->setPassword($entityInstance->getPassword());

        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {

        $entityManager->remove($entityInstance);
        $entityManager->flush();
    }



    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex()->hideOnForm(),
            TextField::new('nom'),
            TextField::new('Prenom'),
            EmailField::new('email'),
            DateTimeField::new('createdAt', 'Crée à (date)')->hideOnForm()->setFormTypeOption('disabled', 'disabled'),
            DateTimeField::new('updatedAt', 'Mis à jour à (date)')->hideOnForm()->setFormTypeOption('disabled', 'disabled'),
            TextField::new('password')->hideOnIndex(),
            TextField::new('createdBy', 'Crée par')->hideOnForm()->setFormTypeOption('disabled', 'disabled'),

        ];
    }




}
