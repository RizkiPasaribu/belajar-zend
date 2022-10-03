<?php

namespace Rombels\V1\Service\Listener;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class SiswaEventListenerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $fileConfig  = $container->get('Config')['siswa']['files'];
        $innovationMapper = $container->get(\Rombels\Mapper\Siswa::class);
        $universityHydrator = $container->get('HydratorManager')->get('Rombels\Hydrator\Siswa');
        $universityEventListener = new SiswaEventListener(
            $innovationMapper,
        );
        $universityEventListener->setLogger($container->get("logger_default"));
        $universityEventListener->setConfig($fileConfig);
        $universityEventListener->setSiswaHydrator($universityHydrator);
        return $universityEventListener;
    }
}
