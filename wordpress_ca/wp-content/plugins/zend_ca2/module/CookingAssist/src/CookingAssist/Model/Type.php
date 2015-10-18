<?php
namespace CookingAssist\Model;

class Type
{
    public $id;
    public $name;
    public $description;
    
    public function exchangeArray($data)
    {
        $super->exchangeArray($data);
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->name  = (!empty($data['name'])) ? $data['name'] : null;
        $this->description = (!empty($data['description'])) ? $data['description'] : null;
    }
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}

?>