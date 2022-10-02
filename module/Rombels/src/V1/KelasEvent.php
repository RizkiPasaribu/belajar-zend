<?php

namespace Rombels\V1;

use Zend\EventManager\Event;
use Zend\InputFilter\InputFilterInterface;
use \Exception;

class KelasEvent extends Event
{
    const EVENT_CREATE_KELAS           = 'create.kelas';
    const EVENT_CREATE_KELAS_SUCCESS   = 'create.kelas.success';
    const EVENT_CREATE_KELAS_ERROR     = 'create.kelas.error';

    const EVENT_EDIT_KELAS           = 'edit.kelas';
    const EVENT_EDIT_KELAS_SUCCESS   = 'edit.kelas.success';
    const EVENT_EDIT_KELAS_ERROR     = 'edit.kelas.error';

    const EVENT_DELETE_KELAS           = 'delete.kelas';
    const EVENT_DELETE_KELAS_SUCCESS   = 'delete.kelas.success';
    const EVENT_DELETE_KELAS_ERROR     = 'delete.kelas.error';

    /**#@-*/
    /**
     * @var Kelas\Entity\Kelas
     */
    protected $kelasEntity;

    /**
     * @var Zend\InputFilter\InputFilterInterface
     */
    protected $inputFilter;

    /**
     * @var \Exception
     */
    protected $exception;

    protected $deleteData;

    protected $bodyResponse;


    /**
     * @return the $inputFilter
     */
    public function getInputFilter()
    {
        return $this->inputFilter;
    }

    /**
     * @param Zend\InputFilter\InputFilterInterface $inputFilter
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        $this->inputFilter = $inputFilter;
    }

    /**
     * @return the $exception
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @param Exception $exception
     */
    public function setException(Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     * Get the value of bodyResponse
     */
    public function getBodyResponse()
    {
        return $this->bodyResponse;
    }

    /**
     * Set the value of bodyResponse
     *
     * @return  self
     */
    public function setBodyResponse($bodyResponse)
    {
        $this->bodyResponse = $bodyResponse;

        return $this;
    }

    /**
     * Get the value of deleteData
     */
    public function getDeleteData()
    {
        return $this->deleteData;
    }

    /**
     * Set the value of deleteData
     *
     * @return  self
     */
    public function setDeleteData($deleteData)
    {
        $this->deleteData = $deleteData;

        return $this;
    }

    /**
     * Get the value of kelasEntity
     *
     * @return  Kelas\Entity\Kelas
     */
    public function getKelasEntity()
    {
        return $this->kelasEntity;
    }

    /**
     * Set the value of kelasEntity
     *
     * @param  Kelas\Entity\Kelas  $kelasEntity
     *
     * @return  self
     */
    public function setKelasEntity(\Rombels\Entity\Kelas $kelasEntity)
    {
        $this->kelasEntity = $kelasEntity;

        return $this;
    }
}
