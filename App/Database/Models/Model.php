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

    public function find(int $id){

        $query = "SELECT * FROM " . static::TABLE . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param('i',$id);
        $stmt->execute();
        return $stmt->get_result();

    
    }


}