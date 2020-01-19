<?php

namespace DoctrineORMModule\Service;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Form\Element\ObjectSelect;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;


/**
 * Factory for {@see ObjectSelect}
 *
 * @license MIT
 * @link    http://www.doctrine-project.org/
 * @author  Daniel Gimenes <daniel@danielgimenes.com.br>
 */
class ObjectSelectFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return ObjectSelect
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get(EntityManager::class);
        $element       = new ObjectSelect;

        $element->getProxy()->setObjectManager($entityManager);

        return $element;
    }
    /**
     * {@inheritDoc}
     */

    /**
     * @param ServiceLocatorInterface $container
     * @return ObjectSelect
     * @throws ContainerException
     */
    public function createService(ServiceLocatorInterface $container)
    {
        return $this($container, ObjectSelect::class);
    }
}
