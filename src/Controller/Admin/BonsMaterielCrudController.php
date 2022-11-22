<?php

namespace App\Controller\Admin;

use App\Entity\BonsMateriel;
use App\Entity\BonsTravail;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BonsMaterielCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BonsMateriel::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Bons de materiel')
            ->setEntityLabelInSingular('Bon de materiel')
            ->setPageTitle('index', 'Gestion des bons de materiel')
            ->setPaginatorPageSize(10);
    }


    public function configureFields(string $pageName): iterable
    {
        return [


            IdField::new('id')->hideOnForm()->HideonIndex(),
            TextareaField::new('materiel'),
            TextareaField::new('observation'),
            DateTimeField::new('datePret'),
            DateTimeField::new('dateRetour'),
            AssociationField::new('agent', 'Agent'),
            DateTimeField::new('createdAt', 'Crée à (date)')->hideOnForm()->setFormTypeOption('disabled', 'disabled'),
            Field::new('createdBy', 'Crée Par')->hideOnForm()->setFormTypeOption('disabled', 'disabled'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $sendPdfMat = Action::new('sendPdfMat', 'Télécharger Pdf', 'fa fa-envelope')
            ->linkToRoute('bonm.showm.pdf', function (BonsMateriel $bonsMateriel): array {
                return [
                    'id' => $bonsMateriel->getId()
                ];
            });

        return $actions->add(Crud::PAGE_INDEX, $sendPdfMat);
    }

}
