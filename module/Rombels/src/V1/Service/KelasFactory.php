<?php

namespace Rombels\V1\Service;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class KelasFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config')['kelas'];
        $innovationService = new Kelas();
        $innovationService->setConfig($config);
        return $innovationService;
    }
}
