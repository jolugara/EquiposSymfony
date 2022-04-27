<?php

namespace App\Repository;

use App\Entity\Jugador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Jugador|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jugador|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jugador[]    findAll()
 * @method Jugador[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JugadorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Jugador::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Jugador $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Jugador $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Jugador[] Returns an array of Jugador objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Jugador
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
