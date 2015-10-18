<?php
namespace CookingAssist\Model;


class Workflow
{
	private $id;
	private $title;
	private $tipp;
	private $layoutId;

	public function getId(){ return $this->id;}
	public function getTitle(){ return $this->title;}
	public function getTipp(){ return $this->tipp;}
	public function getLayoutId(){ return $this->layoutId;}

	public function setId($id){ $this->id = $id;}
	public function setTitle($title){ $this->title = $title;}
	public function setTipp($tipp){ $this->tipp = $tipp;}
	public function setLayoutId($layoutId){ $this->layoutId = $layoutId;}
}