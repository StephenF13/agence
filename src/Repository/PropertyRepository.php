<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }

    public function findAllVisibleQuery(PropertySearch $search)
    {
        $query = $this->createQueryBuilder('p')
            ->andWhere('p.sold = false');


        if ($search->getMaxPrice()) {
            $query = $query->andWhere('p.price <= :maxPrice')->setParameter('maxPrice', $search->getMaxPrice());
        }

        if ($search->getMinSurface()) {
            $query = $query->andWhere('p.surface >= :minSurface')->setParameter('minSurface', $search->getMinSurface());
        }

        if ($search->getOptions()->count() > 0) {
            $key = 0;
            foreach ($search->getOptions() as $option) {
                $key++;
                $query = $query->andWhere(":option$key MEMBER OF p.options")->setParameter("option$key", $option );
            }
        }

        return $query->getQuery();
    }

    public function findLatest()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.sold = false')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();

    }

}
