<?php

namespace App\Controller\Admin;



use App\Entity\BonsTravail;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class BonsTravailCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BonsTravail::class;

    }


    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {  // Nouveau bon de travail
        $newBon = new BonsTravail();
        $newBon->setTravail($entityInstance->getTravail());
        $newBon->setAgents($entityInstance->getAgents());
        $newBon->setClient($entityInstance->getClient());
        $newBon->setCreatedAt($entityInstance->getCreatedAt());
        $newBon->setUpdatedAt($entityInstance->getUpdatedAt());
        $newBon->setCreatedBy($entityInstance->getCreatedBy());
        $newBon->setUpdatedBy($entityInstance->getUpdatedBy());
        $newBon->setClient($entityInstance->getClient());
        $newBon->setDateExecutionPrevue($entityInstance->getDateExecutionPrevue());
       // Increment Last bon -> New bon
        $lastBon = $entityManager->getRepository('App\Entity\BonsTravail')->findOneBy(array(), array('id' => 'DESC'), 1, 0);
        $num = (int)$lastBon->getNumero() + 1;
        while (strlen((string)$num) < 5) {
            $num = '0' . $num;
        }
        $newBon->setNumero($num);
        $entityManager->persist($newBon);
        $entityManager->flush();

    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Bons de travail')
            ->setEntityLabelInSingular('Bon de travail')
            ->setPageTitle('index', 'Gestion des bons de travail')
            ->setPaginatorPageSize(10);
    }


    public function configureFields(string $pageName): iterable
    {
        return [


            IdField::new('id')->hideOnForm()->HideonIndex(),
            IntegerField::new('numero')->hideOnForm(),
            DateTimeField::new('dateExecutionPrevue'),
            TextField::new('Travail'),
            AssociationField::new('agents', 'Agents'),
            AssociationField::new('client', 'Client'),
            DateTimeField::new('createdAt', 'Crée à (date)')->hideOnForm()->setFormTypeOption('disabled', 'disabled'),
            DateTimeField::new('updatedAt', 'Mis à jour à (date)')->hideOnForm()->setFormTypeOption('disabled', 'disabled'),
            Field::new('createdBy', 'Crée par')->hideOnForm()->setFormTypeOption('disabled', 'disabled'),
            Field::new('updatedBy', 'Mis à jour par')->hideOnForm()->setFormTypeOption('disabled', 'disabled'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $sendPdf = Action::new('sendPdf', 'Télécharger Pdf', 'fa fa-envelope')
            ->linkToRoute('bon.show.pdf', function (BonsTravail $bonsTravail): array {
                return [
                    'id' => $bonsTravail->getId()
                ];
            });

        return $actions->add(Crud::PAGE_INDEX, $sendPdf);
    }

}
