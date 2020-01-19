<?php

namespace DoctrineORMModule\Service;

use DoctrineModule\Service\AbstractFactory;
use DoctrineORMModule\Collector\MappingCollector;
use Doctrine\Common\Persistence\ObjectManager;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\ServiceLocatorInterface;

/**
 * Service factory responsible for instantiating {@see \DoctrineORMModule\Collector\MappingCollector}
 *
 * @license MIT
 * @link    http://www.doctrine-project.org/
 * @author  Marco Pivetta <ocramius@gmail.com>
 */
class MappingCollectorFactory extends AbstractFactory
{
    /**
     * {@inheritDoc}
     *
     * @return MappingCollector
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $name          = $this->getName();
        /* @var $objectManager ObjectManager */
        $objectManager = $container->get('doctrine.entitymanager.' . $name);

        return new MappingCollector($objectManager->getMetadataFactory(), 'doctrine.mapping_collector.' . $name);
    }


    /**
     * @param ServiceLocatorInterface $container
     * @return MappingCollector
     * @throws ContainerException
     */
    public function createService(ServiceLocatorInterface $container)
    {
        return $this($container, MappingCollector::class);
    }

    /**
     * {@inheritDoc}
     */
    public function getOptionsClass()
    {
    }
}
