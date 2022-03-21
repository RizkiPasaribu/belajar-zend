<?php

namespace Lectures\Entity;

use Aqilix\ORM\Entity\EntityInterface;

/**
 * Schedule
 */
class Schedule implements EntityInterface
{
    /**
     * @var \DateTime|null
     */
    private $startTime;

    /**
     * @var \DateTime|null
     */
    private $endTime;

    /**
     * @var string|null
     */
    private $topic;

    /**
     * @var string|null
     */
    private $description;

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
     * @var \User\\Entity\UserProfile
     */
    private $ledBy;

    /**
     * @var \University\Entity\Room
     */
    private $room;


    /**
     * Set startTime.
     *
     * @param \DateTime|null $startTime
     *
     * @return Schedule
     */
    public function setStartTime($startTime = null)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime.
     *
     * @return \DateTime|null
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime.
     *
     * @param \DateTime|null $endTime
     *
     * @return Schedule
     */
    public function setEndTime($endTime = null)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime.
     *
     * @return \DateTime|null
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set topic.
     *
     * @param string|null $topic
     *
     * @return Schedule
     */
    public function setTopic($topic = null)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic.
     *
     * @return string|null
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Schedule
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime|null $createdAt
     *
     * @return Schedule
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
     * @return Schedule
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
     * @return Schedule
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
     * Set ledBy.
     *
     * @param \User\\Entity\UserProfile|null $ledBy
     *
     * @return Schedule
     */
    public function setLedBy(\User\\Entity\UserProfile $ledBy = null)
    {
        $this->ledBy = $ledBy;

        return $this;
    }

    /**
     * Get ledBy.
     *
     * @return \User\\Entity\UserProfile|null
     */
    public function getLedBy()
    {
        return $this->ledBy;
    }

    /**
     * Set room.
     *
     * @param \University\Entity\Room|null $room
     *
     * @return Schedule
     */
    public function setRoom(\University\Entity\Room $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room.
     *
     * @return \University\Entity\Room|null
     */
    public function getRoom()
    {
        return $this->room;
    }
}
