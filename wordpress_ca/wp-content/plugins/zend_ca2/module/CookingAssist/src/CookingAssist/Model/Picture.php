<?php
namespace CookingAssist\Model;


class Picture
{
	private $id;
	private $title;
	private $description;
	private $link;
	private $uploaderId;

	public function getId(){ return $this->id;}
	public function getTitle(){ return $this->title;}
	public function getDescription(){ return $this->description;}
	public function getLink(){ return $this->link;}
	public function getUploaderId(){ return $this->uploaderId;}

	public function setId($id){ $this->id = $id;}
	public function setTitle($title){ $this->title = $title;}
	public function setDescription($description){ $this->description = $description;}
	public function setLink($link){ $this->link = $link;}
	public function setUploaderId($uploaderId){ $this->uploaderId = $uploaderId;}
}