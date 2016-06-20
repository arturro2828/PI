<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\NoResultException;

class GroupRepository extends EntityRepository implements UserProviderInterface {

    public function getGroupByName($name) {

        $query = $this
                ->createQueryBuilder('u')
                ->where('u.name = :name')
                ->setParameter('name', $name)
                ->getQuery();

        try {
            $group = $query->getSingleResult();
            return $group;
        } catch (NoResultException $e) {
            return null;
        }
    }

    public function loadUserByUsername($username) {
        
    }

    public function refreshUser(UserInterface $user) {
        
    }

    public function supportsClass($class) {
        
    }

}
