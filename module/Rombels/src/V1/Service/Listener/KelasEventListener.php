<?php

namespace Rombels\V1\Service\Listener;

use Rombels\Entity\Kelas;;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Exception\InvalidArgumentException;
use Psr\Log\LoggerAwareTrait;
use Rombels\Mapper\KelasTrait;
use Zend\EventManager\EventManagerAwareTrait;
use Rombels\V1\KelasEvent;
use Zend\Log\Exception\RuntimeException;

class KelasEventListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;
    use EventManagerAwareTrait;
    use LoggerAwareTrait;
    use KelasTrait;

    protected $config;
    protected $kelasEvent;
    protected $kelasHydrator;
    protected $kelasIndicatorHydrator;
    protected $kelasIndicatorAttachmentHydrator;
    protected $fillingTimeRangeHydrator;

    public function __construct(
        \Rombels\Mapper\Kelas $kelasMapper
    ) {
        $this->setKelasMapper($kelasMapper);
    }

    /**
     * (non-PHPdoc)
     * @see \Zend\EventManager\ListenerAggregateInterface::attach()
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            KelasEvent::EVENT_CREATE_KELAS,
            [$this, 'createKelas'],
            500
        );

        $this->listeners[] = $events->attach(
            KelasEvent::EVENT_EDIT_KELAS,
            [$this, 'editKelas'],
            500
        );

        $this->listeners[] = $events->attach(
            KelasEvent::EVENT_DELETE_KELAS,
            [$this, 'deleteKelas'],
            500
        );
    }

    public function createKelas(KelasEvent $event)
    {
        try {
            if (!$event->getInputFilter() instanceof InputFilterInterface) {
                throw new InvalidArgumentException('Input Filter not set');
            }
            $bodyRequest = $event->getInputFilter()->getValues();
            $bodyRequest['logo'] = $bodyRequest['logo']['tmp_name'];
            $bodyRequest = str_replace("data/photo", "", $bodyRequest);

            $kelasEntity = new Kelas;
            $hydrateEntity  = $this->getKelasHydrator()->hydrate($bodyRequest, $kelasEntity);
            $entityResult   = $this->getKelasMapper()->save($hydrateEntity);
            $event->setKelasEntity($entityResult);
            $uuid = $kelasEntity->getUuid();

            $this->logger->log(
                \Psr\Log\LogLevel::INFO,
                "{function}: New Kelas {uuid} created successfully",
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

    public function editKelas(KelasEvent $event)
    {
        try {
            $inputFilter = $event->getInputFilter();
            if (!$inputFilter instanceof InputFilterInterface)
                throw new InvalidArgumentException('InputFilter not set');

            $bodyRequest = $inputFilter->getValues();

            $entity = $event->getKelasEntity();

            $entity->setUpdatedAt(new \DateTime('now'));
            $hydratedEntity = $this->kelasHydrator->hydrate($bodyRequest, $entity);

            if (!($hydratedEntity instanceof Kelas))
                throw new \Exception('HyratedEntity is not instance of Kelas Entity');

            $resultEntity  = $this->kelassMapper->save($hydratedEntity);

            if (!($resultEntity instanceof Kelas))
                throw new \Exception("ResultEntity is not instance of Kelas Entity");
            $event->setKelasEntity($resultEntity);
            $uuid = $resultEntity->getUuid();

            $this->logger->log(
                \Psr\Log\LogLevel::INFO,
                "{function}: Kelas {uuid} updated successfully",
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

    public function deleteKelas(KelasEvent $event)
    {
        try {
            $deletedData = $event->getDeleteData();
            $this->getKelasMapper()->delete($deletedData);
            $uuid   = $deletedData->getUuid();

            $this->logger->log(
                \Psr\Log\LogLevel::INFO,
                "{function} {uuid}: Data Kelas deleted successfully",
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
     * Get the value of kelasHydrator
     */
    public function getKelasHydrator()
    {
        return $this->kelasHydrator;
    }

    /**
     * Set the value of kelasHydrator
     *
     * @return  self
     */
    public function setKelasHydrator($kelasHydrator)
    {
        $this->kelasHydrator = $kelasHydrator;

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
