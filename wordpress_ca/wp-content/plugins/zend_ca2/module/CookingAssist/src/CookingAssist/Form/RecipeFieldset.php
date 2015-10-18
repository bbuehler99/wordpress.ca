<?php
namespace CookingAssist\Form;

use Zend\Form\Fieldset;
use CookingAssist\Form\AddWorkflowForm;
use Zend\Form\Element\Text;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\MultiCheckbox;
use Zend\Form\Element\Collection;
use Zend\Form\Element\Select;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
use Zend;

use Zend\Form;
use Zend\Db\Sql\Sql;
use Zend\Form\Element\Textarea;
use Zend\Form\Element\Button;

/**
 * Adds all Form Elements for Form containg a recipe. Make sure to use parents fieldset, too
 * @author root
 *
 */
class RecipeFieldset extends Fieldset
{
    protected $dbAdapter;
    private $maxNoOfSteps = 6;
    
    public function __construct(){
        $dbAdapter = Zend\Db\TableGateway\Feature\GlobalAdapterFeature::getStaticAdapter();
        $this->setDbAdapter($dbAdapter);
        
        parent::__construct('recipefieldset');
    
        $this->add(array(
            'name' => 'noOfPeople',
            'type' => 'Text',
            'options' => array(
                'label' => 'Anzahl Personen',
            ),
        ));
        
        // Add Text for kcal.
        //TODO: Rescrict input to integers
        $kcalElement = new Text('kcal');
        $kcalElement->setLabel('Anzahl Kalorien');
        $this->add($kcalElement);
        
        // Add Checkbox for publicFlag
        $publicFlagElement = new Checkbox('publicFlag');
        $publicFlagElement->setLabel('Möchten Sie das Rezept öffentlich speichern?');
        $this->add($publicFlagElement);
        
        $typeElement = new MultiCheckbox('typeId');
        $typeElement->setLabel('Rezept Typ');
        $possibleValues = array('Sommermenu','Herbstmenu','Wintermenu','Frühlingsmenu');
        $typeElement->setValueOptions($possibleValues);
        $this->add($typeElement);
        
        $selectString = 'SELECT * FROM Levels';//$select->getSqlString();
        $result = $dbAdapter->query($selectString,Adapter::QUERY_MODE_EXECUTE);
        $levels = array();
        foreach ($result as $row){
            $levels[]= $row['Shortname'];
        }
        $levelElement = new Select('level');
        $levelElement->setLabel('Schwierigkeit');
        $levelElement->setValueOptions($levels);/*array('einfach','schwierig'));*/
        $this->add($levelElement);
        
        // Add steps
        $this->addSteps(4);
        
        $stepNumbers = range(1,$this->maxNoOfSteps);
        $addStepSelect = new Select('stepNumber');
        $addStepSelect->setLabel('Anzahl Schritte wählen');
        $addStepSelect->setValueOptions($stepNumbers);
        $addStepSelect->setAttribute('id', 'noOfStepSelect');
        $addStepSelect->setAttribute('onchange', 'show()');
        $this->add($addStepSelect);
        
        
        
    }
    
    public function getDbAdapter(){
        return $this->dbAdapter;
    }
    public function setDbAdapter(AdapterInterface $dbAdapter){
        $this->dbAdapter = $dbAdapter;
    }
    public function addSteps($number){
        for ($i=0;$i<$number;$i++){
            $this->addStep($i);
        }
    }
    private function addStep($index){
        $quantityElement = new Text('stepQuantity'.$index);
        $quantityElement->setLabel('Menge');
        $quantityElement->setAttribute('id', 'stepQuantity'.$index);
        $this->add($quantityElement);
        
        $unitElement = new Select('stepUnit'.$index);
        $unitElement->setValueOptions(array('EL','TL'));
        $unitElement->setAttribute('id','stepUnit'.$index );
        $this->add($unitElement);
        
        
        $ingredientElement = new Select('stepIngredient'.$index);
        $ingredientElement->setValueOptions(array('Öl','Rahm'));
        $ingredientElement->setAttribute('id', 'stepIngredient'.$index);
        $this->add($ingredientElement);
        
        $textElement = new Textarea('stepText'.$index);
        $textElement->setAttribute('id', 'stepText'.$index);
        $this->add($textElement);
    }
   
}

?>