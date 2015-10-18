<?php
namespace CookingAssist\Model;

use CookingAssist\Util\Constants;
class AddRecipeTable
{
    private $recipesTableGateway;
    private $workflowsTableGateway;
    private $recipeTypesTableGateway;
    private $singleStepIngredientsTableGateway;
    private $stepsTableGateway;
    private $quantitiesTableGateway;

    function __construct($recipesTableGateway,$workflowsTableGateway,$recipeTypesTableGateway,$singleStepsIngredientsTableGateway,$stepsTableGatway,$quantitiesTableGateway)
    {
        $this->recipesTableGateway = $recipesTableGateway;
        $this->workflowsTableGateway = $workflowsTableGateway;
        $this->recipeTypesTableGateway = $recipeTypesTableGateway;
        $this->singleStepIngredientsTableGateway = $singleStepsIngredientsTableGateway;
        $this->stepsTableGateway = $stepsTableGatway;
        $this->quantitiesTableGateway = $quantitiesTableGateway;
    }

    private function insertWorkflow($data){
        $workflowData = array(
            'Id' => (int)$data['Id'],
            'Title' => $data['Title'],
            'Tipp' => $data['Tipp'],
            // LayoutId is not filled yet. filling default value
            'LayoutId' => 1, //$data['LayoutId'],
        );
        $this->workflowsTableGateway->insert($workflowData);
        // Obtain id of inserted Workflow
        $id = $this->workflowsTableGateway->getLastInsertValue();
//         var_dump($id);
        return $id;
    }
    private function insertRecipe($id,$data){
        $recipeData = array(
            'Id' => $id,
            'AuthorId' => 1, // default value, get from Wordpress
            'NoOfPeople' => (int)$data['NoOfPeople'],
            'Kcal'  => (int)$data['Kcal'],
            'PublicFlag'    => (int)$data['PublicFlag'],
            'PreparationTime' =>  (int)$data['PreparationTime'],
            'CookingTime' =>  (int)$data['CookingTime'],
            'RestingTime'   =>  (int)$data['RestingTime'],
            // creationDate will be automatically generated by Database
            'Level' =>   (int)$data['Level'],
        );
        $this->recipesTableGateway->insert($recipeData);
        return $id;
    }
    private function insertRecipeTypes($recipeId,$data){
        foreach ($data['TypeId'] as $typeId){
//             var_dump($typeId);
            $recipeTypeData = array(
                'RecipeId' => $recipeId,
                'TypeId' => (int)$typeId,
            );
            $this->recipeTypesTableGateway->insert($recipeTypeData);
        }
        return $data['TypeId'];
    }
    private function stepNotEmpty($data,$stepId){
        if(strlen($data['StepText'.$stepId]) == 0 && strlen($data['StepQuantityValue'.$stepId]) == 0 && $data['IsMultiStep'.$stepId] == '0'){
            return 0;
        }
        return 1;
    }
    private function insertSteps($workflowId,$data){
        for ($i = 0; $i<Constants::$MAXNOOFSTEPS;$i++){
            if($this->stepNotEmpty($data,$i)){
                // general step data           
                $stepData = array(
                    'WorkflowId' => $workflowId,
                    'StepId' => $i,
                    'IsMultiStep' => (int)$data['IsMultiStep'.$i],
                    // RecipeId: only insert if is Multistep
                    // yet to implement
                    //'PictureId' => $step->pictureId,
                    );
                if($data['IsMultiStep'.$i]){
                    // insertRecipeId
                    $stepData['RecipeId'] = $data['MultiStepSelect'.$i];
                    $this->stepsTableGateway->insert($stepData);
                }
                else{
                    // find correct quantityId
                    $quantitiesData = array(
                        'Value' => (int)$data['StepQuantityValue'.$i],
                        'UnitId' => (int)$data['StepUnit'.$i],
                    );
                    $quantityId = $this->getQuantityId($quantitiesData);
    //                 var_dump("qid ".$quantityId);
                    $stepData['Text'] = $data['StepText'.$i];
                    $stepData['QuantityId'] = $quantityId;
                    $this->stepsTableGateway->insert($stepData);
                    
                    foreach($data['StepIngredients'.$i] as $ingredient){
                        $stepIngredientsData = array(
                            'WorkflowId' => $workflowId,
                             'StepId' => $i,
                             'IngredientId' => (int)$ingredient,
                        );
//                         var_dump($ingredient);
                        $this->singleStepIngredientsTableGateway->insert($stepIngredientsData);
                    }
                }
                
            }

        }
        
    }
    /*
     * Saves a single recipe
     * Inserts values from recipe into db tables
     * - Workflows
     * - Recipes
     * - RecipeTypes
     * - Steps (ev. Quantities, SingleStepIngredients)
     */
    public function saveRecipe($data){
                    ini_set('xdebug.var_display_max_data', -1);
                    ini_set('xdebug.var_display_max_depth', 5);
                    ini_set('xdebug.var_display_max_children', 256);
//         var_dump($data);
        // $id == 0 means we have a new recipe
        if (strlen($data['Id']) == 0) {
            // $id contains id of saved Workflow. Will be used to save Recipe
            $id = $this->insertWorkflow($data);
            $id = $this->insertRecipe($id,$data);
            $this->insertRecipeTypes($id, $data);
            $this->insertSteps($id, $data);
            
            
        }
    }

    
    function getQuantityId($quantitiesData){
        $result = $this->quantitiesTableGateway->select($quantitiesData);
        if(count($result)>0){
            // quantity already exists
            $current = $result->current();
            $id = $current->getArrayCopy();// returns array. get ['id'];
            return $id['id'];
        }
        else{
            // insert as new quantity
            $this->quantitiesTableGateway->insert($quantitiesData);
            $id = $this->quantitiesTableGateway->getLastInsertValue();
            return $id;
        }
    }
}

?>