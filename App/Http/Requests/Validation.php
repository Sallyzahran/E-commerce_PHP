<?php

namespace App\Http\Requests;

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




