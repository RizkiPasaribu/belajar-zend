<?php

namespace University\V1\Service\Listener;

use University\Entity\University;;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Exception\InvalidArgumentException;
use Psr\Log\LoggerAwareTrait;
use University\Mapper\UniversityTrait;
use Zend\EventManager\EventManagerAwareTrait;
use University\V1\UniversityEvent;
use Zend\Log\Exception\RuntimeException;

class UniversityEventListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;
    use EventManagerAwareTrait;
    use LoggerAwareTrait;
    use UniversityTrait;

    protected $config;
    protected $universityEvent;
    protected $universityHydrator;
    protected $universityIndicatorHydrator;
    protected $universityIndicatorAttachmentHydrator;
    protected $fillingTimeRangeHydrator;

    public function __construct(
        \University\Mapper\University $universityMapper
    ) {
        $this->setUniversityMapper($universityMapper);
    }

    /**
     * (non-PHPdoc)
     * @see \Zend\EventManager\ListenerAggregateInterface::attach()
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            UniversityEvent::EVENT_CREATE_UNIVERSITY,
            [$this, 'createUniversity'],
            500
        );

        $this->listeners[] = $events->attach(
            UniversityEvent::EVENT_EDIT_UNIVERSITY,
            [$this, 'editUniversity'],
            500
        );

        $this->listeners[] = $events->attach(
            UniversityEvent::EVENT_DELETE_UNIVERSITY,
            [$this, 'deleteUniversity'],
            500
        );
    }

    public function createUniversity(UniversityEvent $event)
    {
        try {
            if (!$event->getInputFilter() instanceof InputFilterInterface) {
                throw new InvalidArgumentException('Input Filter not set');
            }
            $bodyRequest = $event->getInputFilter()->getValues();
            $bodyRequest['logo'] = $bodyRequest['logo']['tmp_name'];
            $bodyRequest = str_replace("data/photo", "", $bodyRequest);

            $universityEntity = new University;
            $hydrateEntity  = $this->getUniversityHydrator()->hydrate($bodyRequest, $universityEntity);
            $entityResult   = $this->getUniversityMapper()->save($hydrateEntity);
            $event->setUniversityEntity($entityResult);
            $uuid = $universityEntity->getUuid();

            $this->logger->log(
                \Psr\Log\LogLevel::INFO,
                "{function}: New University {uuid} created successfully",
                [
                    "function" => __FUNCTION__,
                    "uuid" => $uuid
                ]
            );
        } catch (RuntimeException $e) {
            $event->stopPropagation(true);
            $this->logger->log(
                \Psr\Log\LogLevel::ERROR,
                "{function} : Something Error! \nError_message: {message}",
                [
                    "message" => $e->getMessage(),
                    "function" => __FUNCTION__
                ]
            );
            return $e;
        }
    }

    public function editUniversity(UniversityEvent $event)
    {
        try {
            $inputFilter = $event->getInputFilter();
            if (!$inputFilter instanceof InputFilterInterface)
                throw new InvalidArgumentException('InputFilter not set');

            $bodyRequest = $inputFilter->getValues();

            $entity = $event->getUniversityEntity();

            $entity->setUpdatedAt(new \DateTime('now'));
            $hydratedEntity = $this->universityHydrator->hydrate($bodyRequest, $entity);

            if (!($hydratedEntity instanceof University))
                throw new \Exception('HyratedEntity is not instance of University Entity');

            $resultEntity  = $this->universitysMapper->save($hydratedEntity);

            if (!($resultEntity instanceof University))
                throw new \Exception("ResultEntity is not instance of University Entity");
            $event->setUniversityEntity($resultEntity);
            $uuid = $resultEntity->getUuid();

            $this->logger->log(
                \Psr\Log\LogLevel::INFO,
                "{function}: University {uuid} updated successfully",
                [
                    "function" => __FUNCTION__,
                    "uuid" => $uuid
                ]
            );
        } catch (\Exception $ex) {
            $event->stopPropagation(true);
            $this->logger->log(
                \Psr\Log\LogLevel::ERROR,
                "{function} : Something Error! \nError_message: {message}",
                [
                    "message" => $ex->getMessage(),
                    "function" => __FUNCTION__
                ]
            );
        }
    }

    public function deleteUniversity(UniversityEvent $event)
    {
        try {
            $deletedData = $event->getDeleteData();
            $this->getUniversityMapper()->delete($deletedData);
            $uuid   = $deletedData->getUuid();

            $this->logger->log(
                \Psr\Log\LogLevel::INFO,
                "{function} {uuid}: Data University deleted successfully",
                [
                    'uuid' => $uuid,
                    "function" => __FUNCTION__
                ]
            );
        } catch (\Exception $e) {
            $this->logger->log(\Psr\Log\LogLevel::ERROR, "{function} : Something Error! \nError_message: " . $e->getMessage(), ["function" => __FUNCTION__]);
        }
    }

    /**
     * Get the value of universityHydrator
     */
    public function getUniversityHydrator()
    {
        return $this->universityHydrator;
    }

    /**
     * Set the value of universityHydrator
     *
     * @return  self
     */
    public function setUniversityHydrator($universityHydrator)
    {
        $this->universityHydrator = $universityHydrator;

        return $this;
    }

    /**
     * Get the value of config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set the value of config
     *
     * @return  self
     */
    public function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }
}
