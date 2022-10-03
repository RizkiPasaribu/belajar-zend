<?php

namespace Rombels\V1\Service\Listener;

use Rombels\Entity\Siswa;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Exception\InvalidArgumentException;
use Psr\Log\LoggerAwareTrait;
use Rombels\Mapper\SiswaTrait;
use Zend\EventManager\EventManagerAwareTrait;
use Rombels\V1\SiswaEvent;
use Zend\Log\Exception\RuntimeException;

class SiswaEventListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;
    use EventManagerAwareTrait;
    use LoggerAwareTrait;
    use SiswaTrait;

    protected $config;
    protected $siswaEvent;
    protected $siswaHydrator;
    protected $siswaIndicatorHydrator;
    protected $siswaIndicatorAttachmentHydrator;
    protected $fillingTimeRangeHydrator;

    public function __construct(
        \Rombels\Mapper\Siswa $siswaMapper
    ) {
        $this->setSiswaMapper($siswaMapper);
    }

    /**
     * (non-PHPdoc)
     * @see \Zend\EventManager\ListenerAggregateInterface::attach()
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            SiswaEvent::EVENT_CREATE_SISWA,
            [$this, 'createSiswa'],
            500
        );

        $this->listeners[] = $events->attach(
            SiswaEvent::EVENT_EDIT_SISWA,
            [$this, 'editSiswa'],
            500
        );

        $this->listeners[] = $events->attach(
            SiswaEvent::EVENT_DELETE_SISWA,
            [$this, 'deleteSiswa'],
            500
        );
    }

    public function createSiswa(SiswaEvent $event)
    {
        try {
            if (!$event->getInputFilter() instanceof InputFilterInterface) {
                throw new InvalidArgumentException('Input Filter not set');
            }
            $bodyRequest = $event->getInputFilter()->getValues();
            $photoPath = $bodyRequest['photo']['tmp_name'];
            unset($bodyRequest['photo']);
            $bodyRequest['photo']=$photoPath;

            $siswaEntity = new Siswa;
            $hydrateEntity  = $this->getSiswaHydrator()->hydrate($bodyRequest, $siswaEntity);
            $entityResult   = $this->getSiswaMapper()->save($hydrateEntity);
            $event->setSiswaEntity($entityResult);
            $uuid = $siswaEntity->getUuid();

            $this->logger->log(
                \Psr\Log\LogLevel::INFO,
                "{function}: New Siswa {uuid} created successfully",
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

    public function editSiswa(SiswaEvent $event)
    {
        try {
            $inputFilter = $event->getInputFilter();
            if (!$inputFilter instanceof InputFilterInterface)
            throw new InvalidArgumentException('InputFilter not set');
            $bodyRequest = $inputFilter->getValues();

            $entity = $event->getSiswaEntity();
            var_dump($entity->getKelas());
            exit;
            $entity->setUpdatedAt(new \DateTime('now'));
            $hydratedEntity = $this->siswaHydrator->hydrate($bodyRequest, $entity);
            
            if (!($hydratedEntity instanceof Siswa))
            throw new \Exception('HyratedEntity is not instance of Siswa Entity');
        
            $resultEntity  = $this->siswasMapper->save($hydratedEntity);
            
            if (!($resultEntity instanceof Siswa))
            throw new \Exception("ResultEntity is not instance of Siswa Entity");
            $event->setSiswaEntity($resultEntity);
            $uuid = $resultEntity->getUuid();
            
            $this->logger->log(
                \Psr\Log\LogLevel::INFO,
                "{function}: Siswa {uuid} updated successfully",
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

    public function deleteSiswa(SiswaEvent $event)
    {
        try {
            $deletedData = $event->getDeleteData();
            $this->getSiswaMapper()->delete($deletedData);
            $uuid   = $deletedData->getUuid();

            $this->logger->log(
                \Psr\Log\LogLevel::INFO,
                "{function} {uuid}: Data Siswa deleted successfully",
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
     * Get the value of siswaHydrator
     */
    public function getSiswaHydrator()
    {
        return $this->siswaHydrator;
    }

    /**
     * Set the value of siswaHydrator
     *
     * @return  self
     */
    public function setSiswaHydrator($siswaHydrator)
    {
        $this->siswaHydrator = $siswaHydrator;

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
