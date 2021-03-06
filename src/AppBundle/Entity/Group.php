<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * @ORM\Table(name="app_groups")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\GroupRepository")
 */
class Group implements RoleInterface,\Serializable {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(name="name", type="string", length=30) */
    protected $name;

    /** @ORM\Column(name="role", type="string", length=20) */
    protected $role;

    /** @ORM\ManyToMany(targetEntity="User", mappedBy="groups") */
    protected $users;

    public function __construct() {
        $this->users = new ArrayCollection();
    }

    public function getRole() {
        
        
        return $this->role;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Group
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Group
     */
    public function setRole($role) {
        $this->role = $role;

        return $this;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Group
     */
    public function addUser(\AppBundle\Entity\User $user) {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user) {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers() {
        return $this->users;
    }

    public function serialize()
    {
        /*
         * ! Don't serialize $users field !
         */
        return \serialize(array(
            $this->id,
            $this->name,
            $this->role
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->name,
            $this->role
        ) = \unserialize($serialized);
    }
}
