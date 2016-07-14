<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * 
 * @ORM\Table(name="app_users")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserRepository")
 */
class User implements UserInterface, \Serializable {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="username", type="string", length=25)
     */
    protected $username;

    /**
     * @ORM\Column(name="email", type="string", length=100)
     */
    protected $email;

    /**
     * @ORM\Column(name="password", type="string", length=100)
     */
    protected $password;

    /**
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="users")
     * 
     */
    protected $groups;

    /**
     * @ORM\Column(name="dueDate", type="date")
     */
    protected $dueDate;
    
    /**
     * @ORM\Column(name="isActive", type="string")
     */
    protected $isActive;
    
    /**
     * @ORM\Column(name="emailCode", type="string", length=32)
     */   
    
    protected $emailCode;
    

    public function getDueDate() {
        return $this->dueDate;
    }

    public function setDueDate(\DateTime $dueDate = null) {
        $this->dueDate = $dueDate;
    }

    public function __construct() {
        $this->groups = new ArrayCollection();
        $this->dueDate = new \DateTime();
        $this->emailCode = md5( microtime());
        $this->isActive = false;
    }

    public function getRoles() {



        return $this->groups->toArray();
    }

    /** @see \Serializable::serialize() */
    public function serialize() {
        return serialize(array(
            $this->id,
            $this->username,
            $this->email,
            $this->password

                // see section on salt below
                // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized) {
        list (
                $this->id,
                $this->username,
                $this->email,
                $this->password

                // see section on salt below
                // $this->salt
                ) = unserialize($serialized);
    }

    public function eraseCredentials() {
        
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Add group
     *
     * @param \AppBundle\Entity\Group $group
     *
     * @return User
     */
    public function addGroup(\AppBundle\Entity\Group $group) {
        $this->groups[] = $group;
         
        return $this;
    }

    /**
     * Remove group
     *
     * @param \AppBundle\Entity\Group $group
     */
    public function removeGroup(\AppBundle\Entity\Group $group) {
        $this->groups->removeElement($group);
       
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroups() {
        return $this->groups;
    }

    public function getSalt() {
        
    }


    /**
     * Set isActive
     *
     * @param string $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return string
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

   
    public function setEmailCode($emailCode)
    {
        $this->emailCode = $emailCode;

        return $this;
    }

    
    public function getEmailCode()
    {
        return $this->emailCode;
    }

   
   
}
