<?php
namespace CookingAssist\Form;

use Zend\Form\Fieldset;
use Zend\Form\Element\Collection;
use Zend\Db\Adapter\Adapter;
use Zend;

class WorkflowFieldset extends Fieldset
{
    protected $dbAdapter;

    public function __construct($name='workflow'){
        $dbAdapter = Zend\Db\TableGateway\Feature\GlobalAdapterFeature::getStaticAdapter();
        $this->setDbAdapter($dbAdapter);
        
        parent::__construct($name);

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'title',
            'type' => 'Text',
            'options' => array(
                'label' => 'Titel',
            ),
        ));
        $this->add(array(
            'name' => 'tipp',
            'type' => 'Text',
            'options' => array(
                'label' => 'Tipp',
            ),
        ));
 

    }
    public function getDbAdapter(){
        return $this->dbAdapter;
    }
    public function setDbAdapter(Adapter $dbAdapter){
        $this->dbAdapter = $dbAdapter;
    }
}

?>