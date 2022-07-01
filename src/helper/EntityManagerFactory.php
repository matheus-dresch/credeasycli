<?php

namespace Matheus\Credeasycli\Helper;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;

class EntityManagerFactory
{
    /**
     * @return EntityManagerInterface
     * @throws \Doctrine\ORM\ORMException
     */
    public static function getEntityManager(): EntityManagerInterface
    {
        $rootDir = __DIR__ . '/../..';
        $config = ORMSetup::createAnnotationMetadataConfiguration(
            [$rootDir . '/src/entity', $rootDir . '/src/repository'],
            true
        );
        $connection = [
            'driver' => 'pdo_mysql',
            'host' => '127.0.0.1',
            'dbname' => 'credeasycli',
            'user' => 'root',
            'password' => 'root'
        ];

        return EntityManager::create($connection, $config);
    }
}
