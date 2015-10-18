<?php
namespace CookingAssist\Service;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use CookingAssist\Model\Recipe;


class DbService
{
    protected $dbAdapter;

    function __construct($dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;   
    }
    
    function fetchAllLevels(){
//         $sql = new Sql($dbAdapter);
//         $select = $sql->select();
//         $select->from('Levels');
        $selectString = 'SELECT * FROM Levels';//$select->getSqlString();
        $result = $this->dbAdapter->query($selectString,Adapter::QUERY_MODE_EXECUTE);
        $levels = array();
        foreach ($result as $row){
            $levels[]= $row['Shortname'];
        }
        return $levels;
    }
    
    function getRecipe($id){
        $selectString = 'SELECT * FROM Workflows NATURAL INNER JOIN Recipes  WHERE Id='.$id;
        $result = $this->dbAdapter->query($selectString,Adapter::QUERY_MODE_EXECUTE);
        if(count($result)>1){
            throw new \Exception("Too many results when querying recipe");            
        }
        $recipe = new Recipe();
        $recipe->exchangeArray($result->toArray());
        return $recipe;
    }
}

?>