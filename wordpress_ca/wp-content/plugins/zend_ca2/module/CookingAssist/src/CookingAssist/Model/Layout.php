<?php
namespace CookingAssist\Model;


class Layout
{
	private $id;
	private $shortname;
	private $description;

	public function getId(){ return $this->id;}
	public function getShortname(){ return $this->shortname;}
	public function getDescription(){ return $this->description;}

	public function setId($id){ $this->id = $id;}
	public function setShortname($shortname){ $this->shortname = $shortname;}
	public function setDescription($description){ $this->description = $description;}
}