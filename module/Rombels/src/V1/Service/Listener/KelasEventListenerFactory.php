<?php

namespace Rombels\V1\Service\Listener;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class KelasEventListenerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $fileConfig  = $container->get('Config')['kelas']['files'];
        $innovationMapper = $container->get(\Rombels\Mapper\Kelas::class);
        $kelasHydrator = $container->get('HydratorManager')->get('Rombels\Hydrator\Siswa');
        $kelasEventListener = new KelasEventListener(
            $innovationMapper,
        );
        $kelasEventListener->setLogger($container->get("logger_default"));
        $kelasEventListener->setConfig($fileConfig);
        $kelasEventListener->setKelasHydrator($kelasHydrator);
        return $kelasEventListener;
    }
}
