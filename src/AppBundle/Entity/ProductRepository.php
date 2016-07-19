<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;



class ProductRepository extends EntityRepository
{
    
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM AppBundle:Product p ORDER BY p.name ASC'
            )
            ->getResult();
    }
    
    public function getAllQuery($limit = null)
    {
        $queryBuilder = $this->createQueryBuilder('Advertisement');
        $queryBuilder->orderBy('Advertisement.id', 'DESC');
        if ($limit) {
            $queryBuilder->setMaxResults($limit);
        }
        return $queryBuilder->getQuery();
    }

    public function generalSearch($searchTerm)
    {
        $query = $this
                ->createQueryBuilder('u')
                ->where('u.product like :product')
                ->orWhere('u.description like :description')
                ->setParameter('product', '%'.$searchTerm.'%')
                ->setParameter('description', '%'.$searchTerm.'%')
                ->getQuery();

        
            $ads = $query->getResult();
            return $ads;
      
        
                
    }

    
}
