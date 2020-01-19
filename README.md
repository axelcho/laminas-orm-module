# Doctrine 2 ORM Module for Laminas

[![Master branch build status](https://secure.travis-ci.org/doctrine/DoctrineORMModule.png?branch=master)](http://travis-ci.org/doctrine/DoctrineORMModule) [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/doctrine/DoctrineORMModule/badges/quality-score.png?s=1e2a047fb1bb0f66937bcbc3a61f960c8089c835)](https://scrutinizer-ci.com/g/doctrine/DoctrineORMModule/) [![Code Coverage](https://scrutinizer-ci.com/g/doctrine/DoctrineORMModule/badges/coverage.png?s=377656ded5ffaaf4635acfb26729caa212fb5d76)](https://scrutinizer-ci.com/g/doctrine/DoctrineORMModule/) [![Latest Stable Version](https://poser.pugx.org/doctrine/doctrine-orm-module/v/stable.png)](https://packagist.org/packages/doctrine/doctrine-orm-module) [![Total Downloads](https://poser.pugx.org/doctrine/doctrine-orm-module/downloads.png)](https://packagist.org/packages/doctrine/doctrine-orm-module)

This is drop-in replacement for DoctrineORMModule packages. 

## Installation

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

```sh
composer require axelcho/laminas-orm-module
```

Then add `DoctrineModule` and `DoctrineORMModule` to your `config/application.config.php` and create directory
`data/DoctrineORMModule/Proxy` and make sure your application has write access to it.

Installation without composer is not officially supported and requires you to manually install all dependencies
that are listed in `composer.json`

## Entities settings

To register your entities with the ORM, add following metadata driver configurations to your module (merged)
configuration for each of your entities namespaces:

```php
<?php
return [
    'doctrine' => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'my_annotation_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    'path/to/my/entities',
                    'another/path',
                ],
            ],

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => [
                'drivers' => [
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'My\Namespace' => 'my_annotation_driver',
                ],
            ],
        ],
    ],
];
```

## Connection settings

Connection parameters can be defined in the application configuration:

```php
<?php
return [
    'doctrine' => [
        'connection' => [
            // default connection name
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'params' => [
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'username',
                    'password' => 'password',
                    'dbname'   => 'database',
                ],
            ],
        ],
    ],
];
```
