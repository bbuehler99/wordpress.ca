<?php
namespace CookingAssist\Model;


class RecipeModificationDat
{
	private $recipeId;
	private $modificationDate;

	public function getRecipeId(){ return $this->recipeId;}
	public function getModificationDate(){ return $this->modificationDate;}

	public function setRecipeId($recipeId){ $this->recipeId = $recipeId;}
	public function setModificationDate($modificationDate){ $this->modificationDate = $modificationDate;}
}