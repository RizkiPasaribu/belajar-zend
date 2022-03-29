<?php

namespace University\V1\Service\Listener;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class UniversityEventListenerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $fileConfig  = $container->get('Config')['universitys']['files'];
        $innovationMapper = $container->get(\University\Mapper\University::class);
        $universityHydrator = $container->get('HydratorManager')->get('University\Hydrator\University');
        $universityEventListener = new UniversityEventListener(
            $innovationMapper,
        );
        $universityEventListener->setLogger($container->get("logger_default"));
        $universityEventListener->setConfig($fileConfig);
        $universityEventListener->setUniversityHydrator($universityHydrator);
        return $universityEventListener;
    }
}
