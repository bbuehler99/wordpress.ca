<?php
namespace CookingAssist\Model;


class IngredientPicture
{
	private $ingredientId;
	private $pictureId;

	public function getIngredientId(){ return $this->ingredientId;}
	public function getPictureId(){ return $this->pictureId;}

	public function setIngredientId($ingredientId){ $this->ingredientId = $ingredientId;}
	public function setPictureId($pictureId){ $this->pictureId = $pictureId;}
}