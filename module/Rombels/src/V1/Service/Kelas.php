<?php

namespace Rombels\V1\Service;

use Rombels\Entity\Kelas as KelasEntity;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\InputFilter\InputFilter as ZendInputFilter;
use Rombels\V1\KelasEvent;

class Kelas 
{
    use EventManagerAwareTrait;
    
    protected $kelasEvent;
    
    protected $config;
    
    public function addKelas(ZendInputFilter $inputFilter)
    {
        $kelasEvent = new KelasEvent();
        $kelasEvent->setInputFilter($inputFilter);
        $kelasEvent->setName(KelasEvent::EVENT_CREATE_KELAS);
        $create = $this->getEventManager()->triggerEvent($kelasEvent);
        if ($create->stopped()) {
            $kelasEvent->setName(KelasEvent::EVENT_CREATE_KELAS_ERROR);
            $kelasEvent->setException($create->last());
            $this->getEventManager()->triggerEvent($kelasEvent);
            throw $kelasEvent->getException();
        } else {
            $kelasEvent->setName(KelasEvent::EVENT_CREATE_KELAS_SUCCESS);
            $this->getEventManager()->triggerEvent($kelasEvent);
            return $kelasEvent->getKelasEntity();
        }
    }
    
    public function editKelas($kelas, ZendInputFilter $inputFilter)
    {
        $kelasEvent = new KelasEvent();
        $kelasEvent->setInputFilter($inputFilter);
        $kelasEvent->setKelasEntity($kelas);
        $kelasEvent->setName(KelasEvent::EVENT_EDIT_KELAS);
        $create = $this->getEventManager()->triggerEvent($kelasEvent);
        if ($create->stopped()) {
            $kelasEvent->setName(KelasEvent::EVENT_EDIT_KELAS_ERROR);
            $kelasEvent->setException($create->last());
            $this->getEventManager()->triggerEvent($kelasEvent);
            throw $kelasEvent->getException();
        } else {
            $kelasEvent->setName(KelasEvent::EVENT_EDIT_KELAS_SUCCESS);
            $this->getEventManager()->triggerEvent($kelasEvent);
            return $kelasEvent->getKelasEntity();
        }
    }
    
    public function deleteKelas(KelasEntity $deletedData)
    {
        $kelasEvent = new KelasEvent();
        $kelasEvent->setDeleteData($deletedData);
        $kelasEvent->setName(KelasEvent::EVENT_DELETE_KELAS);
        $create = $this->getEventManager()->triggerEvent($kelasEvent);
        if ($create->stopped()) {
            $kelasEvent->setName(KelasEvent::EVENT_DELETE_KELAS_ERROR);
            $kelasEvent->setException($create->last());
            $this->getEventManager()->triggerEvent($kelasEvent);
            throw $kelasEvent->getException();
        } else {
            $kelasEvent->setName(KelasEvent::EVENT_DELETE_KELAS_SUCCESS);
            $this->getEventManager()->triggerEvent($kelasEvent);
            return true;
        }
    }
    
    public function getKelasEvent()
    {
        if ($this->kelasEvent == null) {
            $this->kelasEvent = new KelasEvent();
        }
        
        return $this->kelasEvent;
    }
    
    public function setKelasEvent(KelasEvent $kelasEvent)
    {
        $this->kelasEvent = $kelasEvent;
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
