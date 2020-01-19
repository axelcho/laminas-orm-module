<?php

namespace DoctrineORMModule\Service;

use DoctrineORMModule\CliConfigurator;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class CliConfiguratorFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new CliConfigurator($container);
    }

    /**
     * {@inheritDoc}
     * @throws ContainerException
     */
    public function createService(ServiceLocatorInterface $container)
    {
        return $this($container, CliConfigurator::class);
    }
}
