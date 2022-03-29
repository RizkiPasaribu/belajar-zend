<?php

namespace University\V1\Service;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class UniversityFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config')['university'];
        $innovationService = new University();
        $innovationService->setConfig($config);
        return $innovationService;
    }
}
