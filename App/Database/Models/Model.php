<?php

namespace App\Database\Models;

use App\Database\Config\Connection;

// include "../../Database/Config/Connection.php";
include_once "./App/Database/Config/Connection.php";

class Model extends Connection {

    const TABLE = '';

    public function all(array $columns = ['*'],array $filter = []){
        $selected = implode(' , ',$columns);
        $query = "SELECT {$selected} FROM " . static::TABLE ;
        if(!empty($filter)){
            $query .= " WHERE  {$filter[0]} {$filter[1]}  {$filter[2]}";
        }
        return $this->conn->query($query);
    }

    public static function find(int $id){

        $query = "SELECT * FROM " . static::TABLE . "WHERE id = {$id}";
        echo $query;
    
    }


}