<?php
namespace CookingAssist\Model;


class SingleStepIngredient
{
	private $workflowId;
	private $stepId;
	private $ingredientId;

	public function getWorkflowId(){ return $this->workflowId;}
	public function getStepId(){ return $this->stepId;}
	public function getIngredientId(){ return $this->ingredientId;}

	public function setWorkflowId($workflowId){ $this->workflowId = $workflowId;}
	public function setStepId($stepId){ $this->stepId = $stepId;}
	public function setIngredientId($ingredientId){ $this->ingredientId = $ingredientId;}
	

	public function exchangeArray($data)
	{

        $this->workflowId     = (!empty($data['workflowId'])) ? $data['workflowId'] : null;
        $this->stepId  = (!empty($data['stepId'])) ? $data['stepId'] : null;
        $this->ingredientId = (!empty($data['ingredientId'])) ? $data['ingredientId'] : null;
	}
	public function getArrayCopy()
	{
	    return get_object_vars($this);
	}
	
}