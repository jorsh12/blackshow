<?php

namespace app\models;

use DateTime;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

/**
 * AuditableEntity
 */
abstract class SoftAuditableEntity extends \app\models\DoctrineEntity
{
    /**
     * @var integer
     */
    private $version = 1;

    /**
     * @var string
     */
    private $createdFromIp;

    /**
     * @var string
     */
    private $updatedFromIp;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \DateTime
     */
    private $deletedAt;

    /**
     * @var string
     */
    private $createdBy;

    /**
     * @var string
     */
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
     * Get createdFromIp
     *
     * @return string
     */
    public function getCreatedFromIp()
    {
        return $this->createdFromIp;
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
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
     * Get createdBy
     *
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Get updatedBy
     *
     * @return string
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
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
