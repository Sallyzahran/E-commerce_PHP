<?php

namespace App\Database\Models;

use App\Database\Config\Connection;

// include "../../Database/Config/Connection.php";
include "./App/Database/Config/Connection.php";

class Model extends Connection {

    const TABLE = '';

    public static function all(){

        $query = "SELECT * FROM " . static::TABLE ;
        echo $query;
    }

    public static function find(int $id){

        $query = "SELECT * FROM " . static::TABLE . "WHERE id = {$id}";
        echo $query;
    
    }


}