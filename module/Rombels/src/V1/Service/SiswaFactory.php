<?php

namespace Rombels\V1\Service;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class SiswaFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config')['siswa'];
        $innovationService = new Siswa();
        $innovationService->setConfig($config);
        return $innovationService;
    }
}
