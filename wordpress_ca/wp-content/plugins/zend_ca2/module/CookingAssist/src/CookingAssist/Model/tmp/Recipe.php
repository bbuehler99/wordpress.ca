<?php
namespace CookingAssist\Model;


class Recipe
{
	private $id;
	private $authorId;
	private $noOfPeople;
	private $kcal;
	private $publicFlag;
	private $preparationTime;
	private $cookingTime;
	private $restingTime;
	private $creationDate;
	private $level;

	public function getId(){ return $this->id;}
	public function getAuthorId(){ return $this->authorId;}
	public function getNoOfPeople(){ return $this->noOfPeople;}
	public function getKcal(){ return $this->kcal;}
	public function getPublicFlag(){ return $this->publicFlag;}
	public function getPreparationTime(){ return $this->preparationTime;}
	public function getCookingTime(){ return $this->cookingTime;}
	public function getRestingTime(){ return $this->restingTime;}
	public function getCreationDate(){ return $this->creationDate;}
	public function getLevel(){ return $this->level;}

	public function setId($id){ $this->id = $id;}
	public function setAuthorId($authorId){ $this->authorId = $authorId;}
	public function setNoOfPeople($noOfPeople){ $this->noOfPeople = $noOfPeople;}
	public function setKcal($kcal){ $this->kcal = $kcal;}
	public function setPublicFlag($publicFlag){ $this->publicFlag = $publicFlag;}
	public function setPreparationTime($preparationTime){ $this->preparationTime = $preparationTime;}
	public function setCookingTime($cookingTime){ $this->cookingTime = $cookingTime;}
	public function setRestingTime($restingTime){ $this->restingTime = $restingTime;}
	public function setCreationDate($creationDate){ $this->creationDate = $creationDate;}
	public function setLevel($level){ $this->level = $level;}
}