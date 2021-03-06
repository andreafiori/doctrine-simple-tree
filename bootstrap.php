<?php

require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array("src/Entity");
$isDevMode = false;

$dbParams = array(
	'driver'   => 'pdo_mysql',
	'host'	   => 'localhost',
	'user'     => 'root',
	'password' => 'root',
	'dbname'   => 'doctrine-tree',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);