<?php
namespace CookingAssist\Model;


class RatingModificationDate
{
	private $recipeId;
	private $authorId;
	private $title;
	private $modificationDate;

	public function getRecipeId(){ return $this->recipeId;}
	public function getAuthorId(){ return $this->authorId;}
	public function getTitle(){ return $this->title;}
	public function getModificationDate(){ return $this->modificationDate;}

	public function setRecipeId($recipeId){ $this->recipeId = $recipeId;}
	public function setAuthorId($authorId){ $this->authorId = $authorId;}
	public function setTitle($title){ $this->title = $title;}
	public function setModificationDate($modificationDate){ $this->modificationDate = $modificationDate;}
}