<?php
namespace CookingAssist\Model;

class Workflow
{
    public $id;
    public $title;
    public $tipp;
    public $layoutId;
    public $keywords;
    
    public function exchangeArray($data)
    {
        $this->id     = (!empty($data['Id'])) ? $data['Id'] : null;
        $this->title  = (!empty($data['Title'])) ? $data['Title'] : null;
        $this->tipp = (!empty($data['Tipp'])) ? $data['Tipp'] : null;
        $this->layoutId  = (!empty($data['LayoutId'])) ? $data['LayoutId'] : null;
        $this->keywords  = (!empty($data['Keywords'])) ? $data['Keywords'] : null;
    }
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}

?>