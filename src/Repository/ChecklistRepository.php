<?php

namespace App\Repository;

use App\Entity\Checklist;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Checklist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Checklist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Checklist[]    findAll()
 * @method Checklist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChecklistRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Checklist::class);
    }

    public function nbBiere(User $user)
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.biere) as total')
            ->andWhere('c.user = :val')
            ->setParameter('val', $user)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    public function nbBiereDistinct(User $user)
    {
        $qbNbBiereDist = $this->createQueryBuilder('c')
            ->select('count(distinct (c.biere)) as nbBiereDistinct')
            ->andWhere('c.user = :val')
            ->setParameter('val', $user)
            ->getQuery()
            ->getSingleScalarResult()
            ;
        return $qbNbBiereDist;
    }

    /**
     * @param User $user
     * @return array
     */
    public function nbBiereDistinctType(User $user)
    {
        return $this->createQueryBuilder('c')
            ->innerjoin('c.biere', 'b')
            ->select("b.type, count(c.biere) as nb" )
            ->andWhere('c.user = :val')
            ->groupBy('b.type')
            ->setParameter('val', $user)
            ->getQuery()
            ->getArrayResult()
            ;
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function nbBiereDistinctOrigineBrasseur(User $user)
    {
        return $this->createQueryBuilder('c')
            ->innerjoin('c.biere', 'b')
            ->innerjoin('b.id_brasserie', 'bra')
            ->select("bra.pays as pays, count(c.biere) as nb" )
            ->andWhere('c.user = :val')
            ->groupBy('bra.pays')
            ->setParameter('val', $user)
            ->getQuery()
            ->getResult()
            ;
    }

    public function biereFavorites(User $user)
    {
        /**
         * Correspond à
         * SELECT COUNT(biere_id)
            FROM Checklist
            WHERE user_id = 2
            GROUP BY (biere_id)
         */
        $qbNbBiereDist = $this->createQueryBuilder('c')
            ->select('count(c.biere) as nbBiereDistParBiere')
            ->andWhere('c.user = :val')
            ->setParameter('val', $user)
            ->groupBy('c.biere')
        ;

        $qbFavorites = $this->createQueryBuilder('c2');
        $qbFavorites
            ->innerjoin('c2.biere', 'b')
            ->select("b.nom as nom, count(c2.biere) as nb" )
            ->andWhere('c2.user = :val')
            ->groupBy('c2.biere, b.nom')
            ->having($qbFavorites->expr()->gte('nb', $qbFavorites->expr()->all($qbNbBiereDist) ))
            ->setParameter('val', $user)

            ;
        return $qbFavorites->getQuery()->getArrayResult();
    }

    // /**
    //  * @return Checklist[] Returns an array of Checklist objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Checklist
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
