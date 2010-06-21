<?php
/**
 * Welcome to Doctrine 2.
 *
 * This is the index file of the sandbox. The first section of this file
 * demonstrates the bootstrapping and configuration procedure of Doctrine 2.
 * Below that section you can place your test code and experiment.
 */

use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ApcCache,
    Doctrine\ORM\Tools,
    SymfonyComponents\Yaml;

require_once 'config.local.php';
require 'Event.php';
require 'Entities/Event.php';
require 'Doctrine/Common/ClassLoader.php';

// Set up class loading. You could use different autoloaders, provided by your favorite framework,
// if you want to.
$doctrineClassLoader = new ClassLoader('Doctrine', '/usr/share/php/');
$doctrineClassLoader->register();

$entitiesClassLoader = new ClassLoader('Entities', __DIR__);
$entitiesClassLoader->register();
$proxiesClassLoader = new ClassLoader('Proxies', __DIR__);
$proxiesClassLoader->register();

// Set up caches
$config = new Configuration;
$cache = new ApcCache;
$config->setMetadataCacheImpl($cache);
$driverImpl = $config->newDefaultAnnotationDriver(array(__DIR__."/Entities"));
$config->setMetadataDriverImpl($driverImpl);
$config->setQueryCacheImpl($cache);

// Proxy configuration
$config->setProxyDir(__DIR__ . '/Proxies');
$config->setProxyNamespace('Proxies');
$config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache);

// Database connection information
$connectionOptions = array(
    'dbname' => $GLOBALS['db_name'],
    'user' => $GLOBALS['db_user'],
    'password' => $GLOBALS['db_password'],
    'host' => $GLOBALS['db_host'],
    'driver' => 'pdo_mysql'
);

// Create EntityManager
$em = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);

$event = new Entities_Event;
$event->setTitle('Min titel');
$em->persist($event);
$em->flush();

echo 'Event created' . PHP_EOL;

