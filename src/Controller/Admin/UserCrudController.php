<?php

namespace App\Controller\Admin;


use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;



class UserCrudController extends AbstractCrudController
{


    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureActions(Actions $actions): Actions
    {
        $actions->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action){
            $action->setLabel("Créer un utilisateur");
            return $action;
        });
        return parent::configureActions($actions);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Utilisateurs')
            ->setEntityLabelInSingular('Utilisateur')
            ->setPageTitle('index', 'Administration des utilisateurs')
            ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {


        return [
            IdField::new('id')->hideOnForm()->HideonIndex(),
            EmailField::new('email'),
            TextField::new('password')->hideOnIndex(),
            ChoiceField::new('roles')->allowMultipleChoices()->setChoices([
                'Admin' => 'ROLE_ADMIN',
                'Client' => 'ROLE_CLIENT',
                'Agent' => 'ROLE_AGENT',

                ]),
        ];


    }

}
