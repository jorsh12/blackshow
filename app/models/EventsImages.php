<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventsImages
 */
class EventsImages extends \app\models\FilesEntity
{
    /**
     * @var integer
     */
    private $id;

    // /**
    //  * @var string
    //  */
    //private $path;

    // /**
    //  * @var string
    //  */
    // private $name;

    // /**
    //  * @var string
    //  */
    // private $mimeType;

    // /**
    //  * @var string
    //  */
    // private $size;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    // /**
    //  * Set path
    //  *
    //  * @param string $path
    //  * @return Files
    //  */
    // public function setPath($path)
    // {
    //     $this->path = $path;

    //     return $this;
    // }

    // /**
    //  * Get path
    //  *
    //  * @return string 
    //  */
    // public function getPath()
    // {
    //     return $this->path;
    // }

    // /**
    //  * Set name
    //  *
    //  * @param string $name
    //  * @return Files
    //  */
    // public function setName($name)
    // {
    //     $this->name = $name;

    //     return $this;
    // }

    // /**
    //  * Get name
    //  *
    //  * @return string 
    //  */
    // public function getName()
    // {
    //     return $this->name;
    // }

    // /**
    //  * Set mimeType
    //  *
    //  * @param string $mimeType
    //  * @return Files
    //  */
    // public function setMimeType($mimeType)
    // {
    //     $this->mimeType = $mimeType;

    //     return $this;
    // }

    // /**
    //  * Get mimeType
    //  *
    //  * @return string 
    //  */
    // public function getMimeType()
    // {
    //     return $this->mimeType;
    // }

    // /**
    //  * Set size
    //  *
    //  * @param string $size
    //  * @return Files
    //  */
    // public function setSize($size)
    // {
    //     $this->size = $size;

    //     return $this;
    // }

    // /**
    //  * Get size
    //  *
    //  * @return string 
    //  */
    // public function getSize()
    // {
    //     return $this->size;
    // } 

    // public function callback(array $info) {
    // }

    // public static function getUploadableListener() {
    //     $entityManager = static::getEntityManager();
    //     $eventManager = $entityManager->getEventManager();
    //     foreach ($eventManager->getListeners('onFlush') as $listener) {
    //         if ($listener instanceof \Gedmo\Uploadable\UploadableListener) {
    //             return $listener;
    //         }
    //     }
    // }

}
