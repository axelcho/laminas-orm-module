<?php

namespace DoctrineORMModule\Yuml;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Interop\Container\Exception\NotFoundException;
use Laminas\Http\Client;
use Laminas\ServiceManager\AbstractPluginManager;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class YumlControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return YumlController
     * @throws ContainerException
     * @throws NotFoundException
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        if ($serviceLocator instanceof AbstractPluginManager) {
            $serviceLocator = $serviceLocator->getServiceLocator() ?: $serviceLocator;
        }

        return $this($serviceLocator, YumlController::class);
    }

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     *
     * @return YumlController
     *
     * @throws NotFoundException
     * @throws ServiceNotFoundException if unable to resolve the service
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');

        if (! isset($config['zenddevelopertools']['toolbar']['enabled'])
            || ! $config['zenddevelopertools']['toolbar']['enabled']
        ) {
            throw new ServiceNotFoundException(
                sprintf('Service %s could not be found', YumlController::class)
            );
        }

        return new YumlController(
            new Client('https://yuml.me/diagram/plain/class/', ['timeout' => 30])
        );
    }
}
