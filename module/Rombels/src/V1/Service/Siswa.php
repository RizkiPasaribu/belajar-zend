<?php

namespace Rombels\V1\Service;

use Rombels\Entity\Siswa as SiswaEntity;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\InputFilter\InputFilter as ZendInputFilter;
use Rombels\V1\SiswaEvent;

class Siswa
{
    use EventManagerAwareTrait;

    protected $siswaEvent;

    protected $config;

    public function addSiswa(ZendInputFilter $inputFilter)
    {
        $siswaEvent = new SiswaEvent();
        $siswaEvent->setInputFilter($inputFilter);
        $siswaEvent->setName(SiswaEvent::EVENT_CREATE_SISWA);
        $create = $this->getEventManager()->triggerEvent($siswaEvent);
        if ($create->stopped()) {
            $siswaEvent->setName(SiswaEvent::EVENT_CREATE_SISWA_ERROR);
            $siswaEvent->setException($create->last());
            $this->getEventManager()->triggerEvent($siswaEvent);
            throw $siswaEvent->getException();
        } else {
            $siswaEvent->setName(SiswaEvent::EVENT_CREATE_SISWA_SUCCESS);
            $this->getEventManager()->triggerEvent($siswaEvent);
            return $siswaEvent->getSiswaEntity();
        }
    }

    public function editSiswa($innnovationEntity, ZendInputFilter $inputFilter)
    {
        $siswaEvent = new SiswaEvent();
        $siswaEvent->setSiswaEntity($innnovationEntity);
        $siswaEvent->setInputFilter($inputFilter);
        $siswaEvent->setName(SiswaEvent::EVENT_EDIT_SISWA);
        $create = $this->getEventManager()->triggerEvent($siswaEvent);
        if ($create->stopped()) {
            $siswaEvent->setName(SiswaEvent::EVENT_EDIT_SISWA_ERROR);
            $siswaEvent->setException($create->last());
            $this->getEventManager()->triggerEvent($siswaEvent);
            throw $siswaEvent->getException();
        } else {
            $siswaEvent->setName(SiswaEvent::EVENT_EDIT_SISWA_SUCCESS);
            $this->getEventManager()->triggerEvent($siswaEvent);
            return $siswaEvent->getSiswaEntity();
        }
    }

    public function deleteSiswa(SiswaEntity $deletedData)
    {
        $siswaEvent = new SiswaEvent();
        $siswaEvent->setDeleteData($deletedData);
        $siswaEvent->setName(SiswaEvent::EVENT_DELETE_SISWA);
        $create = $this->getEventManager()->triggerEvent($siswaEvent);
        if ($create->stopped()) {
            $siswaEvent->setName(SiswaEvent::EVENT_DELETE_SISWA_ERROR);
            $siswaEvent->setException($create->last());
            $this->getEventManager()->triggerEvent($siswaEvent);
            throw $siswaEvent->getException();
        } else {
            $siswaEvent->setName(SiswaEvent::EVENT_DELETE_SISWA_SUCCESS);
            $this->getEventManager()->triggerEvent($siswaEvent);
            return true;
        }
    }

    public function getSiswaEvent()
    {
        if ($this->siswaEvent == null) {
            $this->siswaEvent = new SiswaEvent();
        }

        return $this->siswaEvent;
    }

    public function setSiswaEvent(SiswaEvent $siswaEvent)
    {
        $this->siswaEvent = $siswaEvent;
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
