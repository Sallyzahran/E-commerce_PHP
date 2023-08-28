<?php

namespace App\Services;


class Media{

    private array $file =[];
    private array $errors =[];
    private string $fileNewName='' ;
    private string $fileType='';
    private string $fileExtension;




    public function size(int $max){

        if($this->file['size'] > $max){

            $this->errors[$this->fileType][__FUNCTION__] = "Max Size must be less than $max "; 
        }
        return $this;

    }


    public function extension(array $availbleExtension){

        if(! in_array($this->fileExtension,$availbleExtension)){

            $this->errors[$this->fileType][__FUNCTION__] = "Available Extension are" . implode(', ',$availbleExtension); 
        }
        return $this;

    }









    /**
     * Get the value of errors
     */ 
    public function getErrors()
    {
        return $this->errors;
    }

    public function getError(string $key)
    {
        if(isset($this->errors[$this->fileType][$key])){
            return  self::templet($this->errors[$this->fileType][$key]);


        }else {
            return null;
        }


    }


    public function templet(string $value){

        return "<p class='text-danger font-weight-bold'>{$value}</p>";

    }
    /** 
     * Get the value of file
     */ 
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the value of file
     *
     * @return  self
     */ 
    public function setFile(array $file)
    {
        $this->file = $file;

        $typeArray = explode('/',$this->file['type']);
        $this->fileType = $typeArray[0];
        $this->fileExtension = $typeArray[1];

        return $this;


    }



    /**
     * Get the value of fileNewName
     */ 
    public function getFileNewName()
    {
        return $this->fileNewName;
    }

    /**
     * Set the value of fileNewName
     *
     * @return  self
     */ 
    public function setFileNewName($fileNewName)
    {
        $this->fileNewName = $fileNewName;

        return $this;
    }



    public function upload(string $pathTo){


        $this->fileNewName = uniqid() .  '.' . $this->fileExtension;
        $newFilePath = $pathTo . $this->fileNewName;
            return move_uploaded_file($this->file['tmp_name'],$newFilePath);

    }


    public static function delete(string $path){

        if(file_exists($path)){
            unlink($path);
            return true;
        } else {
            return false;

        }
       
    }





}


