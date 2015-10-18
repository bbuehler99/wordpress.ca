<?php
namespace CookingAssist\Model;


class Rating
{
	private $recipeId;
	private $authorId;
	private $title;
	private $stars;
	private $text;
	private $creationDate;

	public function getRecipeId(){ return $this->recipeId;}
	public function getAuthorId(){ return $this->authorId;}
	public function getTitle(){ return $this->title;}
	public function getStars(){ return $this->stars;}
	public function getText(){ return $this->text;}
	public function getCreationDate(){ return $this->creationDate;}

	public function setRecipeId($recipeId){ $this->recipeId = $recipeId;}
	public function setAuthorId($authorId){ $this->authorId = $authorId;}
	public function setTitle($title){ $this->title = $title;}
	public function setStars($stars){ $this->stars = $stars;}
	public function setText($text){ $this->text = $text;}
	public function setCreationDate($creationDate){ $this->creationDate = $creationDate;}
}