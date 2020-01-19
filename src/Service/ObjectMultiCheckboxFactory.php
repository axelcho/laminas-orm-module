<?php

namespace DoctrineORMModule\Service;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Form\Element\ObjectMultiCheckbox;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * Factory for {@see ObjectMultiCheckbox}
 *
 * @license MIT
 * @link    http://www.doctrine-project.org/
 * @author  Daniel Gimenes <daniel@danielgimenes.com.br>
 */
class ObjectMultiCheckboxFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return ObjectMultiCheckbox
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get(EntityManager::class);
        $element       = new ObjectMultiCheckbox;

        $element->getProxy()->setObjectManager($entityManager);

        return $element;
    }


    /**
     * @param ServiceLocatorInterface $container
     * @return ObjectMultiCheckbox
     * @throws ContainerException
     */
    public function createService(ServiceLocatorInterface $container)
    {
        return $this($container, ObjectMultiCheckbox::class);
    }
}
