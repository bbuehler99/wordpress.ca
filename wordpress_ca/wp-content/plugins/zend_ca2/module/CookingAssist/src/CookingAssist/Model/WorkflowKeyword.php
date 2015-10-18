<?php
namespace CookingAssist\Model;


class WorkflowKeyword
{
	private $workflowId;
	private $keyword;

	public function getWorkflowId(){ return $this->workflowId;}
	public function getKeyword(){ return $this->keyword;}

	public function setWorkflowId($workflowId){ $this->workflowId = $workflowId;}
	public function setKeyword($keyword){ $this->keyword = $keyword;}
}