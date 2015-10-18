<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Recipe\Controller\Recipe' => 'Recipe\Controller\RecipeController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'recipe' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/recipe[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Recipe\Controller\Recipe',
                        'action'     => 'index',
                    ),
                
                'may_terminate' => true,
                ),
                /*
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/:action[/:id]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
                */
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Recipe' => __DIR__ . '/../view',
        ),
    ),
);
