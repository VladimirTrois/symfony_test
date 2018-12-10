<?php

namespace App\Repository;

use App\Entity\Biere;
use App\Entity\BiereSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Biere|null find($id, $lockMode = null, $lockVersion = null)
 * @method Biere|null findOneBy(array $criteria, array $orderBy = null)
 * @method Biere[]    findAll()
 * @method Biere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BiereRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Biere::class);
    }

    /**
     * @param BiereSearch $search
     * @return Biere[]
     */
    public function listBiereLikeNomBiereOuBrasserie(BiereSearch $search) : array {
        //$query=[];
        //if ($search->getNom() != null){
            $query= $this->createQueryBuilder('b')
                    ->innerjoin('b.id_brasserie', 'bra')
                    ->where('b.nom like :val')
                    ->orWhere('bra.nom like :val')
                    ->setParameter('val', '%'.$search->getNom().'%')
                    ->orderBy('b.nom', 'ASC')
                    ->getQuery()
                    ->getResult()
            ;
        //}
        return $query;
    }

    // /**
    //  * @return Biere[] Returns an array of Biere objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Biere
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
