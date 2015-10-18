<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/CookingAssist for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace CookingAssist\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use CookingAssist\Form\AddRecipeForm;
use Zend\View\Model;
use Zend\View\Helper\ViewModel;
use CookingAssist\Form\RecipeFieldset;
use CookingAssist\Model\Recipe;
use Zend\InputFilter\InputFilter;


class CookingAssistController extends AbstractActionController
{
    private $addRecipeTable;
    
    public function indexAction()
    {
        return array();
    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /cookingAssist/cooking-assist/foo
        return array();
    }
    public function showRecipeAction(){
        $request = $this->getRequest();
        $uri = $_SERVER['REQUEST_URI'];
        // matches last part of url. make sure there is a recipe id requested
        $id = end((explode('/',$uri)));
        if(preg_match("(\d)", $id)){

            $sm = $this->getServiceLocator();
            $dbService = $sm->get('DbService');
            $recipe = $dbService->getRecipe($id);
            
            return array(
                'id' => $id,
                'recipe' => $recipe,
            );
        }
        else{
            throw new \Exception("No id provided at end of url");
        }
    }
    public function addRecipeAction(){
        
//         $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $addRecipeForm = new AddRecipeForm();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
//             echo "is post";
            $recipe = new Recipe();
            
//             ini_set('xdebug.var_display_max_data', -1);
//             ini_set('xdebug.var_display_max_depth', 5);
//             ini_set('xdebug.var_display_max_children', 256);
//             var_dump($_POST);
            
            
            $addRecipeForm->setInputFilter($recipe->getInputFilter());
            
            /* use empty inputFilter only for devlopment. Comment this line if correct filter should be used. */
            $addRecipeForm->setInputFilter(new InputFilter());
            
            
            $addRecipeForm->setData($request->getPost());

            if($addRecipeForm->isValid()){
                var_dump("Form is valid. saving recipe.");
                $this->getAddRecipeTable()->saveRecipe($addRecipeForm->getData());
                 
                // Redirect to index
//                 return $this->redirect()->toRoute('cookingassist');
           }
        }
        
        
        return array('form'=>$addRecipeForm);
    }
    
    public function getAddRecipeTable()
    {
        if (!$this->addRecipeTable) {
            $sm = $this->getServiceLocator();
            $this->addRecipeTable = $sm->get('CookingAssist\Model\AddRecipeTable');
        }
        return $this->addRecipeTable;
    }
}
