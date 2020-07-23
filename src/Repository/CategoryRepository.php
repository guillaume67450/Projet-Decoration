<?php

namespace App\Repository;
use App\Entity\Category;

use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
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

    public function findByParentNotNull()
    {
        $qb = $this->createQueryBuilder('c')
        ->where('c.parent > :parent')
        ->setParameter('parent', 0)
        ->orderBy('c.Name', 'ASC');

        return $qb->getQuery()->getResult();
    }

    public function findAllGreaterThanPrice($price, $includeUnavailableProducts = false): array
    {
    // automatically knows to select Products
    // the "p" is an alias you'll use in the rest of the query
    $qb = $this->createQueryBuilder('p')
        ->where('p.price > :price')
        ->setParameter('price', $price)
        ->orderBy('p.price', 'ASC');

    if (!$includeUnavailableProducts) {
        $qb->andWhere('p.available = TRUE');
    }

    $query = $qb->getQuery();

    return $query->execute();
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
