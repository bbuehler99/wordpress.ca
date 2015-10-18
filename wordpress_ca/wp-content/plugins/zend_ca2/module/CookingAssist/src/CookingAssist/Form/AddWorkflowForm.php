<?php
namespace CookingAssist\Form;

use Zend\Form\Form;
use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use Zend\Form\Element\Collection;
use Zend\Form\Fieldset;

use Zend\Form\Element\Submit;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
class AddWorkflowForm extends Form
{
    // default value = 5
    public $noOfKeywords = 5;
    protected $dbAdapter;
    /* Attributes:
    public $id;
    public $title;
    public $tipp;
    public $layoutId;
     */
    public function __construct($name='workflowform')
    {
//         $this->setDbAdapter($dbAdapter);
        // we want to ignore the name passed
        parent::__construct($name);
        
        $dbAdapter = GlobalAdapterFeature::getStaticAdapter();
        if($dbAdapter != null){
        
            $this->setDbAdapter($dbAdapter);
        }
        else{
            throw new \Exception('no dbAdapter loaded');
        }
            
        
//         $workflowElement = new Collection('workflow');
//         $workflowElement->setOptions(array(
//             'label' => 'Workflow',
//             'target_element' => array(
//                 'type' => 'CookingAssist\Form\WorkflowFieldset')
//         ));
        
//         $this->add($workflowElement);
        
        
        $this->add(array(
            'name' => 'Id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'Title',
            'type' => 'Text',
            'options' => array(
                'label' => 'Titel',
            ),
        ));
        $this->add(array(
            'name' => 'Tipp',
            'type' => 'Text',
            'options' => array(
                'label' => 'Tipp',
            ),
        ));

        $submitElement = new Submit('Submit');
        $submitElement->setValue('Hinzufügen');
        $this->add($submitElement);
    }
    
    public function getDbAdapter(){
        return $this->dbAdapter;
    }
    public function setDbAdapter(Adapter $dbAdapter){
        $this->dbAdapter = $dbAdapter;
    }
}

?>