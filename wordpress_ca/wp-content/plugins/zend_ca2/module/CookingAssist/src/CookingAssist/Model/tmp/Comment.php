<?php
namespace CookingAssist\Model;


class Comment
{
	private $workflowId;
	private $stepId;
	private $title;
	private $text;
	private $creationDate;
	private $authorId;

	public function getWorkflowId(){ return $this->workflowId;}
	public function getStepId(){ return $this->stepId;}
	public function getTitle(){ return $this->title;}
	public function getText(){ return $this->text;}
	public function getCreationDate(){ return $this->creationDate;}
	public function getAuthorId(){ return $this->authorId;}

	public function setWorkflowId($workflowId){ $this->workflowId = $workflowId;}
	public function setStepId($stepId){ $this->stepId = $stepId;}
	public function setTitle($title){ $this->title = $title;}
	public function setText($text){ $this->text = $text;}
	public function setCreationDate($creationDate){ $this->creationDate = $creationDate;}
	public function setAuthorId($authorId){ $this->authorId = $authorId;}
}