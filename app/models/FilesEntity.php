<?php

namespace app\models;

/**
 * Files
 */
class FilesEntity extends \app\models\AuditableEntity
{    

	/**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $mimeType;

    /**
     * @var string
     */
    private $size;

    /**
     * Set path
     *
     * @param string $path
     * @return Files
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
     * Set name
     *
     * @param string $name
     * @return Files
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set mimeType
     *
     * @param string $mimeType
     * @return Files
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get mimeType
     *
     * @return string 
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set size
     *
     * @param string $size
     * @return Files
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string 
     */
    public function getSize()
    {
        return $this->size;
    } 

    public function callback(array $info) {
    }

    public static function getUploadableListener() {
        $entityManager = static::getEntityManager();
        $eventManager = $entityManager->getEventManager();
        foreach ($eventManager->getListeners('onFlush') as $listener) {
            if ($listener instanceof \Gedmo\Uploadable\UploadableListener) {
                return $listener;
            }
        }
    }
    // /**
    //  * @var string
    //  */
    // private $descripcion;


    // /**
    //  * Set descripcion
    //  *
    //  * @param string $descripcion
    //  * @return FilesEntity
    //  */
    // public function setDescripcion($descripcion)
    // {
    //     $this->descripcion = $descripcion;
    
    //     return $this;
    // }

    // /**
    //  * Get descripcion
    //  *
    //  * @return string 
    //  */
    // public function getDescripcion()
    // {
    //     return $this->descripcion;
    // }
}
