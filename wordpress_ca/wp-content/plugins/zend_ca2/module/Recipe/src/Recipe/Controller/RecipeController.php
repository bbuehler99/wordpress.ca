<?php
namespace Recipe\Controller;
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Recipe for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Recipe\Model\Recipe;
use Recipe\Form\RecipeForm;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class RecipeController extends AbstractActionController
{
    protected $recipeTable;
    
    public function getAction(){
    
        $id = (int) $this->params()->fromRoute('id', 0);
         
        // Get the Recipe with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $recipe = $this->getRecipeTable()->getRecipe($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('recipe', array(
                'action' => 'index'
            ));
        }

        // need typecasting to array
        return (array) $recipe;         
    }
    public function indexAction()
    {
        return new ViewModel(array(
             'recipes' => $this->getRecipeTable()->fetchAll(),
         ));
    }
    public function getRecipeTable(){
        if (!$this->recipeTable) {
            $sm = $this->getServiceLocator();
            $this->recipeTable = $sm->get('Recipe\Model\RecipeTable');
        }
        return $this->recipeTable;
    }

    public function addAction(){
        $form = new RecipeForm();
        $form->get('submit')->setValue('Add');
         
        $request = $this->getRequest();
        if ($request->isPost()) {
            $recipe = new Recipe();
            $form->setInputFilter($recipe->getInputFilter());
            $form->setData($request->getPost());
             
            if ($form->isValid()) {
                echo 'is valid';
                $recipe->exchangeArray($form->getData());
                $this->getRecipeTable()->saveRecipe($recipe);
                 
                // Redirect to list of recipes
                return $this->redirect()->toRoute('recipe');
            }
        }
        return array('form' => $form);
    }
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('recipe', array(
                'action' => 'add'
            ));
        }
         
        // Get the Recipe with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $recipe = $this->getRecipeTable()->getRecipe($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('recipe', array(
                'action' => 'index'
            ));
        }
         
        $form  = new RecipeForm();
        $form->bind($recipe);
        $form->get('submit')->setAttribute('value', 'Edit');
         
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($recipe->getInputFilter());
            $form->setData($request->getPost());
             
            if ($form->isValid()) {
                $this->getRecipeTable()->saveRecipe($recipe);
                 
                // Redirect to list of recipes
                return $this->redirect()->toRoute('recipe');
            }
        }
         
        return array(
            'id' => $id,
            'form' => $form,
        );
    }
    
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('recipe');
        }
         
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
             
            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                echo 'deleting...'.$id;
                $this->getRecipeTable()->deleteRecipe($id);
            }
             
            // Redirect to list of Recipes
            return $this->redirect()->toRoute('recipe');
        }
         
        return array(
            'id'    => $id,
            'recipe' => $this->getRecipeTable()->getRecipe($id)
        );
    }
    
}
