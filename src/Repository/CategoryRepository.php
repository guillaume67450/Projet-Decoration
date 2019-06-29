<?php

namespace App\Repository;
use App\Entity\Category;

use Doctrine\Common\Collections\Criteria;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findByParentNull($executed = false)
    {
        // Add a not equals parameter to your criteria
        $criteria = new Criteria();
        $criteria->where(Criteria::expr()->neq('parent', null));

        // Prepare query builder
        $qb = $this->createQueryBuilder('c')->addCriteria($criteria);

        if (!$executed)
            return $qb;

        // Execute query
        return $qb->getQuery()->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Category
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
