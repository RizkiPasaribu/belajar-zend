<?php

namespace University\V1;

use Zend\EventManager\Event;
use Zend\InputFilter\InputFilterInterface;
use \Exception;

class UniversityEvent extends Event
{
    const EVENT_CREATE_UNIVERSITY           = 'create.university';
    const EVENT_CREATE_UNIVERSITY_SUCCESS   = 'create.university.success';
    const EVENT_CREATE_UNIVERSITY_ERROR     = 'create.university.error';

    const EVENT_EDIT_UNIVERSITY           = 'edit.university';
    const EVENT_EDIT_UNIVERSITY_SUCCESS   = 'edit.university.success';
    const EVENT_EDIT_UNIVERSITY_ERROR     = 'edit.university.error';

    const EVENT_DELETE_UNIVERSITY           = 'delete.university';
    const EVENT_DELETE_UNIVERSITY_SUCCESS   = 'delete.university.success';
    const EVENT_DELETE_UNIVERSITY_ERROR     = 'delete.university.error';

    /**#@-*/
    /**
     * @var University\Entity\University
     */
    protected $universityEntity;

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
     * Get the value of universityEntity
     *
     * @return  University\Entity\University
     */
    public function getUniversityEntity()
    {
        return $this->universityEntity;
    }

    /**
     * Set the value of universityEntity
     *
     * @param  University\Entity\University  $universityEntity
     *
     * @return  self
     */
    public function setUniversityEntity(\University\Entity\University $universityEntity)
    {
        $this->universityEntity = $universityEntity;

        return $this;
    }
}
