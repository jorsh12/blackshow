<?php

namespace app\models;

use DateTime;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * AuditableEntity
 */
abstract class AuditableEntity extends \app\models\DoctrineEntity
{
    /**
     * @var integer
     */
    private $version = 1;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $createdFromIp;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     */
    private $updatedFromIp;

    /**
     * @var \DateTime
     */
    private $deletedAt;

    /**
     * @var \app\models\Users
     */
    private $createdBy;

    // *
    //  * @var \app\models\Users
     
    private $updatedBy;


    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get createdFromIp
     *
     * @return string
     */
    public function getCreatedFromIp()
    {
        return $this->createdFromIp;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Get updatedFromIp
     *
     * @return string
     */
    public function getUpdatedFromIp()
    {
        return $this->updatedFromIp;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return SoftDeleteableEntity
     */
    public function setDeletedAt(DateTime $deletedAt = null)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Get createdBy
     *
     * @return \app\models\Users
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Get updatedBy
     *
     * @return \app\models\Users
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Is deleted?
     *
     * Not time aware
     *
     * @return bool
     */
    public function isDeleted()
    {
        return null !== $this->deletedAt;
    }

    public function preSoftDelete(LifecycleEventArgs $eventArgs) { }

    public function postSoftDelete(LifecycleEventArgs $eventArgs) { }

}
