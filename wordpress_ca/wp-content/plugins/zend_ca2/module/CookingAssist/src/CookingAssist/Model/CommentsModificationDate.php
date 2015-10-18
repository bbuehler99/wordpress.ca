<?php
namespace CookingAssist\Model;


class CommentsModificationDate
{
	private $workflowId;
	private $stepId;
	private $title;
	private $authorId;
	private $modificationDate;

	public function getWorkflowId(){ return $this->workflowId;}
	public function getStepId(){ return $this->stepId;}
	public function getTitle(){ return $this->title;}
	public function getAuthorId(){ return $this->authorId;}
	public function getModificationDate(){ return $this->modificationDate;}

	public function setWorkflowId($workflowId){ $this->workflowId = $workflowId;}
	public function setStepId($stepId){ $this->stepId = $stepId;}
	public function setTitle($title){ $this->title = $title;}
	public function setAuthorId($authorId){ $this->authorId = $authorId;}
	public function setModificationDate($modificationDate){ $this->modificationDate = $modificationDate;}
}