<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Pictures extends Product{
   
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
   /**
     * Image path
     *
     * @var string
     *
     * @ORM\Column(type="text", length=255, nullable=false)
     */
    protected $path;
    
    /**
     * Image file
     *
     * @var File
     *
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png", "image/tiff"},
     *     maxSizeMessage = "The maxmimum allowed file size is 5MB.",
     *     mimeTypesMessage = "Only the filetypes image are allowed."
     * )
     */
    protected $file;
    
    
    /**
 * Called before saving the entity
 * 
 * @ORM\PrePersist()
 * @ORM\PreUpdate()
 */
public function preUpload()
{   
    if (null !== $this->file) {
        // do whatever you want to generate a unique name
        $filename = sha1(uniqid(mt_rand(), true));
        $this->path = $filename.'.'.$this->file->guessExtension();
    }
}

/**
 * Called before entity removal
 *
 * @ORM\PreRemove()
 */
public function removeUpload()
{
    if ($file = $this->getAbsolutePath()) {
        unlink($file); 
    }
}

/**
 * Called after entity persistence
 *
 * @ORM\PostPersist()
 * @ORM\PostUpdate()
 */
public function upload()
{
    // The file property can be empty if the field is not required
    if (null === $this->file) {
        return;
    }

    // Use the original file name here but you should
    // sanitize it at least to avoid any security issues

    // move takes the target directory and then the
    // target filename to move to
    $this->file->move(
        $this->getUploadRootDir(),
        $this->path
    );

    // Set the path property to the filename where you've saved the file
    //$this->path = $this->file->getClientOriginalName();

    // Clean up the file property as you won't need it anymore
    $this->file = null;
}



    /**
     * Set path
     *
     * @param string $path
     *
     * @return Pictures
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
