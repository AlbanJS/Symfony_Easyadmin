<?php

namespace App\Repository;

use App\Entity\BonsTravail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BonsTravail>
 *
 * @method BonsTravail|null find($id, $lockMode = null, $lockVersion = null)
 * @method BonsTravail|null findOneBy(array $criteria, array $orderBy = null)
 * @method BonsTravail[]    findAll()
 * @method BonsTravail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BonsTravailRepository extends ServiceEntityRepository
{
    private $numero;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BonsTravail::class);
    }

    public function add(BonsTravail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BonsTravail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    public function findById(int $id) {
//        $qb = $this->createQueryBuilder('i')
//            ->where('i.id = :id')
//            ->setParameter('id', $id);
//
//        $query = $qb->getQuery();
//        return $query->execute();
//
//    }
//
//    public function findNumero(string $numero)
//    {
//        $qb = $this->createQueryBuilder('n')
//            ->where('n.numero = :numero')
//            ->setParameter('numero', $numero);
//
//        $query = $qb->getQuery();
//        return $query->execute();
//    }

}
