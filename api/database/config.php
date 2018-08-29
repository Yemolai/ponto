<?php
## PROPEL config file ##

/* Import and Setup Log */
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$defaultLogger = new Logger('defaultLogger');
$defaultLogger->pushHandler(new StreamHandler('./log/propel.log', Logger::WARNING));
/* End of Logging */

$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();

## Define default logger ##
$serviceContainer->setLogger('defaultLogger', $defaultLogger);

$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('ponto', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'classname' => 'Propel\\Runtime\\Connection\\ConnectionWrapper',
  'dsn' => 'mysql:host=devserver;dbname=ponto',
  'user' => 'ponto_reader',
  'password' => '#p0nt0#',
  'settings' =>
  array (
    'charset' => 'utf8mb4',
    'queries' =>
    array (
      'utf8' => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci, COLLATION_CONNECTION = utf8mb4_unicode_ci, COLLATION_DATABASE = utf8mb4_unicode_ci, COLLATION_SERVER = utf8mb4_unicode_ci',
    ),
  ),
  'model_paths' =>
  array (
    0 => 'generated-classes',
  ),
));
$manager->setName('ponto');
$serviceContainer->setConnectionManager('ponto', $manager);
$serviceContainer->setDefaultDatasource('ponto');