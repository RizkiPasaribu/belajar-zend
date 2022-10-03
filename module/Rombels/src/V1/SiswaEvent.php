<?php

namespace Rombels\V1;

use Zend\EventManager\Event;
use Zend\InputFilter\InputFilterInterface;
use \Exception;

class SiswaEvent extends Event
{
    const EVENT_CREATE_SISWA           = 'create.siswa';
    const EVENT_CREATE_SISWA_SUCCESS   = 'create.siswa.success';
    const EVENT_CREATE_SISWA_ERROR     = 'create.siswa.error';

    const EVENT_EDIT_SISWA           = 'edit.siswa';
    const EVENT_EDIT_SISWA_SUCCESS   = 'edit.siswa.success';
    const EVENT_EDIT_SISWA_ERROR     = 'edit.siswa.error';

    const EVENT_DELETE_SISWA           = 'delete.siswa';
    const EVENT_DELETE_SISWA_SUCCESS   = 'delete.siswa.success';
    const EVENT_DELETE_SISWA_ERROR     = 'delete.siswa.error';

    /**#@-*/
    /**
     * @var Siswa\Entity\Siswa
     */
    protected $siswaEntity;

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

    protected $updateData;


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
     * Get the value of siswaEntity
     *
     * @return  Siswa\Entity\Siswa
     */
    public function getSiswaEntity()
    {
        return $this->siswaEntity;
    }

    /**
     * Set the value of siswaEntity
     *
     * @param  Siswa\Entity\Siswa  $siswaEntity
     *
     * @return  self
     */
    public function setSiswaEntity(\Rombels\Entity\Siswa $siswaEntity)
    {
        $this->siswaEntity = $siswaEntity;

        return $this;
    }

    public function getUpdateData()
    {
        return $this->updateData;
    }

    public function setUpdateData($updateData)
    {
        $this->updateData = $updateData;
    }
}
