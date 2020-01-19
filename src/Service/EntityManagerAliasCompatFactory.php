<?php

namespace DoctrineORMModule\Service;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Doctrine\ORM\EntityManager;

/**
 * Factory that provides the `Doctrine\ORM\EntityManager` alias for `doctrine.entitymanager.orm_default`
 *
 * @license MIT
 * @link    http://www.doctrine-project.org/
 * @author  Marco Pivetta <ocramius@gmail.com>
 */
class EntityManagerAliasCompatFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return EntityManager
     *
     * @deprecated this method was introduced to allow aliasing of service `Doctrine\ORM\EntityManager`
     *             from `doctrine.entitymanager.orm_default`
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return $container->get('doctrine.entitymanager.orm_default');
    }

    /**
     * {@inheritDoc}
     *
     * @return \Doctrine\ORM\EntityManager
     *
     * @deprecated this method was introduced to allow aliasing of service `Doctrine\ORM\EntityManager`
     *             from `doctrine.entitymanager.orm_default`
     */

    /**
     * @param ServiceLocatorInterface $container
     * @return EntityManager
     * @throws ContainerException
     */
    public function createService(ServiceLocatorInterface $container)
    {
        return $this($container, EntityManager::class);
    }
}
