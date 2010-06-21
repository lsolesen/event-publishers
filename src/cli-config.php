<?php
require_once 'config.local.php';
require_once 'Doctrine/Common/ClassLoader.php';
require_once 'Ilib/ClassLoader.php';

$classLoader = new \Doctrine\Common\ClassLoader('Entities', __DIR__);
$classLoader->register();

$classLoader = new \Doctrine\Common\ClassLoader('Proxies', __DIR__);
$classLoader->register();

$config = new \Doctrine\ORM\Configuration();
$config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache);
$driverImpl = $config->newDefaultAnnotationDriver(array(__DIR__."/Entities"));
$config->setMetadataDriverImpl($driverImpl);

$config->setProxyDir(__DIR__ . '/Proxies');
$config->setProxyNamespace('Proxies');

$connectionOptions = array(
    'dbname' => $GLOBALS['db_name'],
    'user' => $GLOBALS['db_user'],
    'password' => $GLOBALS['db_password'],
    'host' => $GLOBALS['db_host'],
    'driver' => 'pdo_mysql'
);

$em = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);

$helpers = array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em, __DIR__ . '/Entities')
);

$helperSet = new \Symfony\Components\Console\Helper\HelperSet($helpers);