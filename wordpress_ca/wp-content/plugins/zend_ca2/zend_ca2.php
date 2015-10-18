<?php 
/**
 * Plugin Name: WPZF2 for CookingAssist. 2nd version
 * Plugin URI: http://www.wordpresszendframework2.com/
 * Description: Wordpress and Zend Framework 2 Integration
 * Version: 1.2.1
 * Author: Tao Báez, mod by Marcello
 * Author URI: http://www.wordpresszendframework2.com/
 * Requires at least: 3.5
 * Tested up to: 3.5.2
 *
 * Text Domain: nebulazf2
 * Domain Path: /i18n/languages/
 *
 * @package WPZF2
 * @category Core
 * @author  Tao Báez
 */
 
require 'public/index.php';

// $zf2Path = false;

// if (getenv('ZF2_PATH')) {            // Support for ZF2_PATH environment variable
//     $zf2Path = getenv('ZF2_PATH');
// } elseif (get_cfg_var('zf2_path')) { // Support for zf2_path directive value
//     $zf2Path = get_cfg_var('zf2_path');
// }

// // include $zf2Path . '/Zend/Loader/AutoloaderFactory.php';
// // Zend\Loader\AutoloaderFactory::factory(array('Zend\Loader\StandardAutoloader' => array('autoregister_zf' => true)));

// // if (!class_exists('Zend\Loader\AutoloaderFactory')) {   throw new RuntimeException('define a ZF2_PATH environment variable.'); }

// $configuration=require 'config/application.config.php';

use Zend\EventManager\EventManager;
use Zend\Http\PhpEnvironment;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\Application;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceManager;

// $config = $configuration;
$configuration = require 'config/application.config.php';

$serviceManager = new ServiceManager();
$eventManager=new EventManager();


use Zend\Loader\AutoloaderFactory;
use Zend\Mvc\Service\ServiceManagerConfig;
// AutoloaderFactory::factory();
// setup service manager
// $serviceManager = new ServiceManager(new ServiceManagerConfig());
// $serviceManager->setService('ApplicationConfig', $configuration);

// load modules -- which will provide services, configuration, and more
// $serviceManager->get('ModuleManager')->loadModules();

// bootstrap and run application
// $wpzf2plugin = $serviceManager->get('Application');
// $wpzf2plugin = $wpzf2plugin->bootstrap();
?>