<?php
namespace CookingAssist\Model;


class Quantity
{
	public $id;
	public $value;
	public $unitId;

	function getId(){ return $this->id;}
	public function getValue(){ return $this->value;}
	public function getUnitId(){ return $this->unitId;}

	public function setId($id){ $this->id = $id;}
	public function setValue($value){ $this->value = $value;}
	public function setUnitId($unitId){ $this->unitId = $unitId;}
	
	// exchange Array will be used for slects from db
	public function exchangeArray($data)
	{
	    $this->id     = (!empty($data['Id'])) ? $data['Id'] : null;
	    $this->value  = (!empty($data['Value'])) ? $data['Value'] : null;
	    $this->unitId = (!empty($data['UnitId'])) ? $data['UnitId'] : null;
	}
	public function getArrayCopy()
	{
	    return get_object_vars($this);
	}
	
}