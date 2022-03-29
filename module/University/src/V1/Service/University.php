<?php

namespace University\V1\Service;

use University\Entity\University as UniversityEntity;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\InputFilter\InputFilter as ZendInputFilter;
use University\V1\UniversityEvent;

class University
{
    use EventManagerAwareTrait;

    protected $universityEvent;

    protected $config;

    public function addUniversity(ZendInputFilter $inputFilter)
    {
        $universityEvent = new UniversityEvent();
        $universityEvent->setInputFilter($inputFilter);
        $universityEvent->setName(UniversityEvent::EVENT_CREATE_UNIVERSITY);
        $create = $this->getEventManager()->triggerEvent($universityEvent);
        if ($create->stopped()) {
            $universityEvent->setName(UniversityEvent::EVENT_CREATE_UNIVERSITY_ERROR);
            $universityEvent->setException($create->last());
            $this->getEventManager()->triggerEvent($universityEvent);
            throw $universityEvent->getException();
        } else {
            $universityEvent->setName(UniversityEvent::EVENT_CREATE_UNIVERSITY_SUCCESS);
            $this->getEventManager()->triggerEvent($universityEvent);
            return $universityEvent->getUniversityEntity();
        }
    }

    public function editUniversity($innnovationEntity, ZendInputFilter $inputFilter)
    {
        $universityEvent = new UniversityEvent();
        $universityEvent->setUniversityEntity($innnovationEntity);
        $universityEvent->setInputFilter($inputFilter);
        $universityEvent->setName(UniversityEvent::EVENT_EDIT_UNIVERSITY);
        $create = $this->getEventManager()->triggerEvent($universityEvent);
        if ($create->stopped()) {
            $universityEvent->setName(UniversityEvent::EVENT_EDIT_UNIVERSITY_ERROR);
            $universityEvent->setException($create->last());
            $this->getEventManager()->triggerEvent($universityEvent);
            throw $universityEvent->getException();
        } else {
            $universityEvent->setName(UniversityEvent::EVENT_EDIT_UNIVERSITY_SUCCESS);
            $this->getEventManager()->triggerEvent($universityEvent);
            return $universityEvent->getUniversityEntity();
        }
    }

    public function deleteUniversity(UniversityEntity $deletedData)
    {
        $universityEvent = new UniversityEvent();
        $universityEvent->setDeleteData($deletedData);
        $universityEvent->setName(UniversityEvent::EVENT_DELETE_UNIVERSITY);
        $create = $this->getEventManager()->triggerEvent($universityEvent);
        if ($create->stopped()) {
            $universityEvent->setName(UniversityEvent::EVENT_DELETE_UNIVERSITY_ERROR);
            $universityEvent->setException($create->last());
            $this->getEventManager()->triggerEvent($universityEvent);
            throw $universityEvent->getException();
        } else {
            $universityEvent->setName(UniversityEvent::EVENT_DELETE_UNIVERSITY_SUCCESS);
            $this->getEventManager()->triggerEvent($universityEvent);
            return true;
        }
    }

    public function getUniversityEvent()
    {
        if ($this->universityEvent == null) {
            $this->universityEvent = new UniversityEvent();
        }

        return $this->universityEvent;
    }

    public function setUniversityEvent(UniversityEvent $universityEvent)
    {
        $this->universityEvent = $universityEvent;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     *
     * @return self
     */
    public function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }
}
