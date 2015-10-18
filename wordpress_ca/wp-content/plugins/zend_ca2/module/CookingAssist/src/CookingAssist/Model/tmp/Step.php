<?php
namespace CookingAssist\Model;


class Step
{
	private $workflowId;
	private $stepId;
	private $isMultiStep;
	private $recipeId;
	private $text;
	private $quantityId;
	private $pictureId;

	public function getWorkflowId(){ return $this->workflowId;}
	public function getStepId(){ return $this->stepId;}
	public function getIsMultiStep(){ return $this->isMultiStep;}
	public function getRecipeId(){ return $this->recipeId;}
	public function getText(){ return $this->text;}
	public function getQuantityId(){ return $this->quantityId;}
	public function getPictureId(){ return $this->pictureId;}

	public function setWorkflowId($workflowId){ $this->workflowId = $workflowId;}
	public function setStepId($stepId){ $this->stepId = $stepId;}
	public function setIsMultiStep($isMultiStep){ $this->isMultiStep = $isMultiStep;}
	public function setRecipeId($recipeId){ $this->recipeId = $recipeId;}
	public function setText($text){ $this->text = $text;}
	public function setQuantityId($quantityId){ $this->quantityId = $quantityId;}
	public function setPictureId($pictureId){ $this->pictureId = $pictureId;}
}