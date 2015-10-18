<?php
namespace CookingAssist\Form;

use Zend\InputFilter\InputFilter;
use CookingAssist\Util\Constants;

class RecipeInputFilter extends InputFilter
{
    protected $config = array(
        array(
            'name' => 'Title',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 50,
                    ),
                ),
            ),
        ),  
        array(
            'name' => 'Tipp',
            'required' => false,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 0,
                        'max' => 50,
                    ),
                ),
            ),
        ),        
        array(
            'name' => 'NoOfPeople',
            'required' => true,
            'filters' => array(
                array('name' => 'Int'),
            ),
            'validators' => array(
                array(
                    'name' => 'Between',
                    'options' => array(
                        'min' => 1,
                        'max' => 20,
                    ),
                ),
            ),
        ),       
        array(
            'name' => 'Kcal',
            'required' => false,
            'filters' => array(
                array('name' => 'Int'),
            ),
            'validators' => array(
                array(
                    'name' => 'Between',
                    'options' => array(
                        'min' => 0,
                        'max' => 10000,
                    ),
                ),
            ),
        ),       
        array(
            'name' => 'PreparationTime',
            'required' => false,
            'filters' => array(
                array('name' => 'Int'),
            ),
            'validators' => array(
                array(
                    'name' => 'Between',
                    'options' => array(
                        'min' => 0,
                        'max' => 1000,
                    ),
                ),
            ),
        ),       
        array(
            'name' => 'RestingTime',
            'required' => false,
            'filters' => array(
                array('name' => 'Int'),
            ),
            'validators' => array(
                array(
                    'name' => 'Between',
                    'options' => array(
                        'min' => 0,
                        'max' => 1000,
                    ),
                ),
            ),
        ),        
        array(
            'name' => 'CookingTime',
            'required' => false,
            'filters' => array(
                array('name' => 'Int'),
            ),
            'validators' => array(
                array(
                    'name' => 'Between',
                    'options' => array(
                        'min' => 0,
                        'max' => 1000,
                    ),
                ),
            ),
        ),   
    );
    
    public function __construct(){
        foreach($this->config as $conf){
            $this->add($this->getFactory()->createInput($conf));
        }
        for($i=0;$i<Constants::$MAXNOOFSTEPS;$i++){
            $stepCfg = $this->getStepConf($i);
            foreach($stepCfg as $conf){
                $this->add($this->getFactory()->createInput($conf));
            }
        }
    }
    
    private function getStepConf($i){
        $stepConfig = array(
             array(
                'name' => 'StepQuantityValue'.$i,
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 50,
                        ),
                    ),
                ),
            ), 
            array(
                'name' => 'StepText'.$i,
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 1000,
                        ),
                    ),
                ),
            ),
    );
    return $stepConfig;
    }
}

?>