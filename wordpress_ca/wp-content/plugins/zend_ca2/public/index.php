<?php
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Application;



/**
 * Display all errors when APPLICATION_ENV is development.
 */
if ($_SERVER['APPLICATION_ENV'] == 'development') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}


/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

// Setup autoloading
require 'init_autoloader.php';

$config = require 'config/application.config.php';

$serviceManager = new ServiceManager(new ServiceManagerConfig());
$serviceManager->setService('ApplicationConfig', $config);

// load modules -- which will provide services, configuration, and more
$serviceManager->get('ModuleManager')->loadModules();

$ca_application = new Application($config, $serviceManager);
$ca_application = $ca_application->bootstrap();

// Run the application!
// $ca_application = Zend\Mvc\Application::init(require 'config/application.config.php');
// var_dump($application);
// $ca_application->run();
