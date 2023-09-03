<?php

namespace App\Database\Models;

use App\Database\Config\Connection;

// include "../../Database/Config/Connection.php";
include_once "./App/Database/Config/Connection.php";

class Model extends Connection {

    const TABLE = '';

    public function all($columns = ['*']){
        $selected = implode(' , ',$columns);
        $query = "SELECT {$selected} FROM " . static::TABLE ;
        return $this->conn->query($query);
    }

    public static function find(int $id){

        $query = "SELECT * FROM " . static::TABLE . "WHERE id = {$id}";
        echo $query;
    
    }


}