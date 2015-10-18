<?php
namespace CookingAssist\Form;

use CookingAssist\Form\AddWorkflowForm;
use Zend\Form\Element\Text;
use Zend\Form\Element\Select;
use Zend\Form\Element\Checkbox;
use Zend;
use Zend\Db\Adapter\Adapter;
use Zend\Form\Element\MultiCheckbox;
use Zend\Form\Element\Textarea;
use Zend\Form\Element\Hidden;
use Zend_Form_Element_Multiselect;
use CookingAssist\Util\Constants;

class AddRecipeForm extends AddWorkflowForm
{
    
    private $initialSteps = 2;
    private $maxNoOfSteps;
    
    public function __construct()
    {
        parent::__construct('AddRecipeForm'); 
        
        $this->maxNoOfSteps = Constants::$MAXNOOFSTEPS;
        
        $noOfPeopleElement = new Text('NoOfPeople');
        $noOfPeopleElement->setLabel('Anzahl Personen');
        $this->add($noOfPeopleElement);
        
        //TODO: Rescrict input to integers
        $kcalElement = new Text('Kcal');
        $kcalElement->setLabel('Anzahl Kalorien');
        $this->add($kcalElement);
        
        // Add Checkbox for publicFlag
        $publicFlagElement = new Checkbox('PublicFlag');
        $publicFlagElement->setLabel('Möchten Sie das Rezept öffentlich speichern?');
        $this->add($publicFlagElement);
        
        $preparationTimeElement = new Text('PreparationTime');
        $preparationTimeElement->setLabel('Vorbereitungszeit');
        $this->add($preparationTimeElement);
        
        $cookingTimeElement = new Text('CookingTime');
        $cookingTimeElement->setLabel('Koch- / Backzeit');
        $this->add($cookingTimeElement);
        
        $restingTimeElement = new Text('RestingTime');
        $restingTimeElement->setLabel('Ruhezeit');
        $this->add($restingTimeElement);
        
        $types = $this->selectAllFrom('Types','Id', 'Name');
        $typeElement = new MultiCheckbox('TypeId');
        $typeElement->setLabel('Rezept Typ');
        $typeElement->setValueOptions($types);
        $this->add($typeElement);
        
        
        $levels = $this->selectAllFrom('Levels', 'Value', 'Shortname');
        $levelElement = new Select('Level');
        $levelElement->setLabel('Schwierigkeit');
        $levelElement->setValueOptions($levels);/*array('einfach','schwierig'));*/
        $levelElement->setValue($levels[0]);
        $this->add($levelElement);
        
        // Add steps
        $this->addSteps($this->getMaxNumberOfSteps());
        
        // Add select for chosing how many steps should be displayed
        $stepNumbers = range(1,$this->maxNoOfSteps);
        $addStepSelect = new Select('StepNumber');
        $addStepSelect->setLabel('Anzahl Schritte wählen');
        $addStepSelect->setValueOptions($stepNumbers);
        $addStepSelect->setAttribute('id', 'NoOfStepSelect');
        $addStepSelect->setAttribute('onchange', 'show(++this.value)');
        $this->add($addStepSelect);
        
    }
        

    public function addSteps($number){
        $units = $this->selectAllFrom('Units','Id','Name');
        $ingredients = $this->selectAllFrom('Ingredients','Id', 'Name');
        $recipeOptions = $this->selectAllFrom('Workflows','Id','Title');
        
        for ($i=0;$i<$number;$i++){
            $this->addStep($i,$units,$ingredients,$recipeOptions);
        }
    }
    private function addStep($index,$units,$ingredients,$recipeOptions){
        $stepIdElement = new Hidden('StepId'.$index);
        $stepIdElement->setValue($index);
        $this->add($stepIdElement);        
        
        $quantityElement = new Text('StepQuantityValue'.$index);
        $quantityElement->setLabel('Menge');
        $quantityElement->setAttribute('id', 'StepQuantityValue'.$index);
        $this->add($quantityElement);
    
        
        $unitElement = new Select('StepUnit'.$index);
        $unitElement->setValueOptions($units);
        // need to set default value. otherwise null is saved.
        $unitElement->setValue(0);
        $unitElement->setAttribute('id','StepUnit'.$index );
        $this->add($unitElement);
    
        
        $ingredientElement = new Select('StepIngredients'.$index);
        $ingredientElement->setValueOptions($ingredients);
        $ingredientElement->setAttribute('multiple', 'multiple');        
        //just set any default value. inserting ingredients has to be workes out anyway
        $ingredientElement->setValue(0);
        $ingredientElement->setAttribute('id', 'StepIngredients'.$index);
        $this->add($ingredientElement);
    
        $textElement = new Textarea('StepText'.$index);
        $textElement->setAttribute('id', 'StepText'.$index);
        $this->add($textElement);
        
//         print_r($recipeOptions);
//         $recipeOptions = $this->getRecipeNames();
        $multiStepSelect = new Select('MultiStepSelect'.$index);
        $multiStepSelect->setLabel("Rezept auswählen: ");
        $multiStepSelect->setAttribute('id', 'MultiStepSelect'.$index);
        $multiStepSelect->setValueOptions($recipeOptions);
//         $multiStepSelect->setValue(0);
        $this->add($multiStepSelect);
        
        $checkBoxElement = new Checkbox('IsMultiStep'.$index);
        $checkBoxElement->setLabel("Ist ein Rezept");
        $checkBoxElement->setAttribute('id', 'isMultiStep'.$index);
//         $checkBoxElement->setValue(0);
        $checkBoxElement->setAttribute('onclick', 'switch_step(this.id)');
        $this->add($checkBoxElement);
    }
    public function getMaxNumberOfSteps(){
        return $this->maxNoOfSteps;
    }
    public function getInitialSteps(){
        return $this->initialSteps;
    }
    private function selectAllFrom($table,$key,$column){
        $selectString = 'SELECT * FROM '.$table;
        $result = $this->getDbAdapter()->query($selectString,Adapter::QUERY_MODE_EXECUTE);
        // data will be a simple array conataining all values from table
        $data = array();
        foreach ($result as $row){
            $id = $row[$key];
            $content = $row[$column];
            if (!empty($content)){
                $data[$id]= $content;
            }            
        }
//         var_dump($data);
        return $data;
    }
    private function getRecipeNames(){
        $selectString = 'SELECT Recipes.Id,Workflows.Title FROM Workflows NATURAL JOIN Recipes';
        $result = $this->getDbAdapter()->query($selectString,Adapter::QUERY_MODE_EXECUTE);
        return $result->toArray();
    }
    

}

?>