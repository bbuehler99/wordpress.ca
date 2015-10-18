<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'CookingAssist\Controller\CookingAssist' => 'CookingAssist\Controller\CookingAssistController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'cookingassist' => array(
                'type'    =>  'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/cookingassist',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                       'controller' => 'CookingAssist\Controller\CookingAssist',
                       'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/:action[/:id]]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'     => '[0-9]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'CookingAssist' => __DIR__ . '/../view',
        ),
    ),
);
