<?php
namespace CookingAssist\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use CookingAssist\Model\Workflow;
use Zend\Stdlib\ArraySerializableInterface;

use CookingAssist\Model\Step;
use CookingAssist\Form\RecipeInputFilter;


class Recipe extends Workflow 
{
    private $inputFilter;
    
    public $id=-1;
    public $authorId=-1;
    public $noOfPeople=-1;
    public $kcal=-1;
    public $publicFlag=0;
    public $preparationTime=-1;
    public $cookingTime=-1;
    public $restingTime=-1;
    public $creationDate=-1;
    public $level=-1;
    public $steps=array();
    
    
    public function exchangeArray($data)
    {
        parent::exchangeArray($data);
//         echo 'recipedata: ';print_r($data);
        $this->id   = (!empty($data['Id'])) ? $data['Id'] : null;
        $this->authorId     = (!empty($data['AuthorId'])) ? $data['AuthorId'] : null;
        $this->noOfPeople  = (!empty($data['NoOfPeople'])) ? $data['NoOfPeople'] : null;
        $this->kcal = (!empty($data['Kcal'])) ? $data['Kcal'] : null;
        $this->publicFlag  = (!empty($data['PublicFlag'])) ? $data['PublicFlag'] : 0;
        $this->preparationTime = (!empty($data['PreparationTime'])) ? $data['PreparationTime'] : null;
        $this->cookingTime  = (!empty($data['CookingTime'])) ? $data['CookingTime'] : null;
        $this->restingTime = (!empty($data['RestingTime'])) ? $data['RestingTime'] : null;
        $this->creationDate  = (!empty($data['CreationDate'])) ? $data['CreationDate'] : null;
        $this->level  = (!empty($data['Level'])) ? $data['Level'] : 0;
        for($i=0;$i<20;$i++){
            if(  !($data['StepQuantityValue'.$i]==null) || !empty($data['StepText'.$i])       ){
                $isMultiStep = (!empty($data['IsMultiStep'.$i])) ? $data['IsMultiStep'.$i] : null;
                $stepQuantityValue = (!empty($data['StepQuantityValue'.$i])) ? $data['StepQuantityValue'.$i] : null;
                $stepQuantityUnit = (!($data['StepUnit'.$i]==null)) ? $data['StepUnit'.$i] : null;
                // empty(0) is true in php!
                $stepIngredient = (!($data['StepIngredient'.$i]==null)) ? $data['StepIngredient'.$i] : null;
                $text = (!empty($data['StepText'.$i])) ? $data['StepText'.$i] : null;
//                 $unitId = (!empty($data['stepUnit'.$i])) ? $data['stepUnit'.$i] : null;
                $pictureId = (!empty($data['PictureId'.$i])) ? $data['PictureId'.$i] : null;
                
                $step = new Step();
                
                $step->create($isMultiStep, $stepQuantityValue,$stepQuantityUnit,$stepIngredient,$text,$pictureId);
//                 echo "<br><br>";
//                 echo "text:".$step->text;
                $this->steps[] = $step;
            }
            else{
//                 echo "stepQuantity empty at step ".$i."!!!";
            }
        }
    }
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

     
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
     
    public function getInputFilter()
    {
        //TODO: implement
        $inputFilter = new RecipeInputFilter();
        $this->inputFilter = $inputFilter;
     
        return $this->inputFilter;
    }

}

?>