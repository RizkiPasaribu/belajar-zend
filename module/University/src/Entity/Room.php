<?php

namespace University\Entity;

use Aqilix\ORM\Entity\EntityInterface;

/**
 * Room
 */
class Room implements EntityInterface
{
    /**
     * @var string|null
     */
    private $code;

    /**
     * @var bool|null
     */
    private $isclassroom = true;

    /**
     * @var \DateTime|null
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     */
    private $updatedAt;

    /**
     * @var \DateTime|null
     */
    private $deletedAt;

    /**
     * @var string
     */
    private $uuid;

    /**
     * @var \University\Entity\Major
     */
    private $majorUuid;


    /**
     * Set code.
     *
     * @param string|null $code
     *
     * @return Room
     */
    public function setCode($code = null)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set isclassroom.
     *
     * @param bool|null $isclassroom
     *
     * @return Room
     */
    public function setIsclassroom($isclassroom = null)
    {
        $this->isclassroom = $isclassroom;

        return $this;
    }

    /**
     * Get isclassroom.
     *
     * @return bool|null
     */
    public function getIsclassroom()
    {
        return $this->isclassroom;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime|null $createdAt
     *
     * @return Room
     */
    public function setCreatedAt($createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime|null $updatedAt
     *
     * @return Room
     */
    public function setUpdatedAt($updatedAt = null)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt.
     *
     * @param \DateTime|null $deletedAt
     *
     * @return Room
     */
    public function setDeletedAt($deletedAt = null)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt.
     *
     * @return \DateTime|null
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Get uuid.
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set majorUuid.
     *
     * @param \University\Entity\Major|null $majorUuid
     *
     * @return Room
     */
    public function setMajorUuid(\University\Entity\Major $majorUuid = null)
    {
        $this->majorUuid = $majorUuid;

        return $this;
    }

    /**
     * Get majorUuid.
     *
     * @return \University\Entity\Major|null
     */
    public function getMajorUuid()
    {
        return $this->majorUuid;
    }
}
