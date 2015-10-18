<?php
namespace CookingAssist\Model;


class Level
{
	private $value;
	private $shortname;
	private $description;

	public function getValue(){ return $this->value;}
	public function getShortname(){ return $this->shortname;}
	public function getDescription(){ return $this->description;}

	public function setValue($value){ $this->value = $value;}
	public function setShortname($shortname){ $this->shortname = $shortname;}
	public function setDescription($description){ $this->description = $description;}
}