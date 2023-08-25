<?php

namespace App\Http\Requests;

use App\Database\Models\Model;
include_once "./App/Database/Models/Model.php";


class Validation {

    private $value;
    private $valueName;
    private array $errors=[];



    public function required()
    {

        if(empty($this->value)){

            $this->errors[$this->valueName][__FUNCTION__] = "{$this->valueName} is required";

        }
        return $this;


    }


        public function max(int $max){

            if ( strlen( $this->value) > $max){
            $this->errors[$this->valueName][__FUNCTION__] = "{$this->valueName} is cant be greater than $max charachters";

            }
        return $this;

        }

        public function min(int $min){

            if ( strlen( $this->value) < $min){
            $this->errors[$this->valueName][__FUNCTION__] = "{$this->valueName} is cant be less than $min charachters";

            }
        return $this;

        }



        public function in(array $array){

                if ( !in_array($this->value,$array)) {
          $this->errors[$this->valueName][__FUNCTION__] = "{$this->valueName} must be in " . implode(' or ',$array);

                }

        return $this;

        }


        public function regex( string $pattern){

           if (!preg_match($pattern,$this->value)){
            $this->errors[$this->valueName][__FUNCTION__] = "{$this->valueName} dosnt match";

           }

    return $this;

    }

    public function match( string $needle){

       if ($this->value !== $needle){
        $this->errors[$this->valueName][__FUNCTION__] = "{$this->valueName} Dosnt match";

       }

 return $this;

 }

 public function stringName(){

    if(!is_string($this->value)) {

    $this->errors[$this->valueName][__FUNCTION__] = "{$this->valueName} is invalid";
    }
return $this;


}

        public function unique(string $table, string $column){

        $model = new Model;
        
        $stmt = $model->conn->prepare(" SELECT * FROM {$table} WHERE {$column} = ?  ");
          $stmt->bind_param('s',$this->value);
          $stmt->execute();

           $result = $stmt->get_result();
           if($result->num_rows == 1){
        $this->errors[$this->valueName][__FUNCTION__] = "{$this->valueName} is already in use";

           } 
           return $this;


        }

        public function exist(string $table, string $column){

            $model = new Model;
            
            $stmt = $model->conn->prepare(" SELECT * FROM {$table} WHERE {$column} = ?  ");
              $stmt->bind_param('s',$this->value);
              $stmt->execute();
    
               $result = $stmt->get_result();
               if($result->num_rows == 0){
            $this->errors[$this->valueName][__FUNCTION__] = "{$this->valueName} is not exist";
    
               } 
               return $this;
    
    
            }
                
            


    /**
     * Set the value of value
     *
     * @return  self
     */ 
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Set the value of valueName
     *
     * @return  self
     */ 
    public function setValueName($valueName)
    {
        $this->valueName = $valueName;

        return $this;
    }

    /**
     * Get the value of errors
     */ 
    public function getErrors()
    {
        return $this->errors;
    }


           /**
     * Get the value of errors
     */ 
    public function getError( string $error)
    {

        if(isset($this->errors[$error])){

            foreach ($this->errors[$error] AS $error ){
                return $error;

            }
             return null;


        }
    }



    public function getMessage(string $error)
    {
        return "<p class='text-danger font-weight-bold'>". $this->getError($error) . "</p>";
    }




}




