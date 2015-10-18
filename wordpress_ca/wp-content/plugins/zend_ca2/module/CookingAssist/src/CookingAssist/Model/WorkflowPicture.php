<?php
namespace CookingAssist\Model;


class WorkflowPicture
{
	private $workflowId;
	private $pictureId;
	private $mainFlag;

	public function getWorkflowId(){ return $this->workflowId;}
	public function getPictureId(){ return $this->pictureId;}
	public function getMainFlag(){ return $this->mainFlag;}

	public function setWorkflowId($workflowId){ $this->workflowId = $workflowId;}
	public function setPictureId($pictureId){ $this->pictureId = $pictureId;}
	public function setMainFlag($mainFlag){ $this->mainFlag = $mainFlag;}
}