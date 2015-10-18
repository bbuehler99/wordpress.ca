<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/CookingAssist for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace CookingAssist;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Debug;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use CookingAssist\Model\Recipe;
use CookingAssist\Model\AddRecipeTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use CookingAssist\Model\Workflow;
use CookingAssist\Model\Type;
use CookingAssist\Model\Ingredient;
use CookingAssist\Model\Step;
use CookingAssist\Model\Quantity;
use CookingAssist\Model\SingleStepIngredient;
use CookingAssist\Service\DbService;
use CookingAssist\Model\RecipeType;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        $sm = $e->getApplication()->getServiceManager();
        $adapter = $sm->get('Zend\Db\Adapter\Adapter');
        \Zend\Db\TableGateway\Feature\GlobalAdapterFeature::setStaticAdapter($adapter);
    }
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'dbAdapter' => function($sm){
                    return $sm->get('Zend\Db\Adapter\Adapter');
                    
                },
                'CookingAssist\Model\AddRecipeTable' =>  function($sm) {
                    $recipesTableGateway = $sm->get('RecipesTableGateway');
                    $workflowsTableGateway = $sm->get('WorkflowsTableGateway');
                    $recipeTypesTableGateway = $sm->get('RecipeTypesTableGateway');
                    $ingredientsTableGateway = $sm->get('SingleStepIngredientsTableGateway');
                    $stepsTableGateway = $sm->get('StepsTableGateway');
                    $quantitiesTableGateway = $sm->get('QuantitiesTableGateway');
                    $table = new AddRecipeTable($recipesTableGateway,$workflowsTableGateway,$recipeTypesTableGateway,$ingredientsTableGateway,$stepsTableGateway,$quantitiesTableGateway);
                    return $table;
                },
                'RecipesTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Recipe());
                    
                    return new TableGateway('Recipes', $dbAdapter, null, $resultSetPrototype);
                },
                'WorkflowsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Workflow());
                    
                    return new TableGateway('Workflows', $dbAdapter, null, $resultSetPrototype);
                },
                'RecipeTypesTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new RecipeType());
                    return new TableGateway('RecipeTypes', $dbAdapter, null, $resultSetPrototype);
                },
                'SingleStepIngredientsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new SingleStepIngredient());
                    return new TableGateway('SingleStepIngredients', $dbAdapter, null, $resultSetPrototype);
                },
                'IngredientsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Ingredient());
                    return new TableGateway('Ingredients', $dbAdapter, null, $resultSetPrototype);
                },
                'StepsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    // needs exchagne method
                    $resultSetPrototype->setArrayObjectPrototype(new Step());
                    return new TableGateway('Steps', $dbAdapter, null, $resultSetPrototype);
                },
                'QuantitiesTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    // needs exchagne method
                    $resultSetPrototype->setArrayObjectPrototype(new Quantity());
                    return new TableGateway('Quantities', $dbAdapter, null, $resultSetPrototype);
                },
                'DbService' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $dbService = new DbService($dbAdapter);
                    return $dbService;
                },
                
            ),
        );
    
    }
   
}
