<?php

namespace App\Database\Models;

use App\Database\Models\Contract\Crud;



class Review extends Model implements Crud{

    const TABLE = "reviwes";

private $user_id,$product_id,$comment,$rate,$created_at,$updated_at;



/**
 * Get the value of user_id
 */ 
public function getUser_id()
{
return $this->user_id;
}

/**
 * Set the value of user_id
 *
 * @return  self
 */ 
public function setUser_id($user_id)
{
$this->user_id = $user_id;

return $this;
}

/**
 * Get the value of product_id
 */ 
public function getProduct_id()
{
return $this->product_id;
}

/**
 * Set the value of product_id
 *
 * @return  self
 */ 
public function setProduct_id($product_id)
{
$this->product_id = $product_id;

return $this;
}

/**
 * Get the value of comment
 */ 
public function getComment()
{
return $this->comment;
}

/**
 * Set the value of comment
 *
 * @return  self
 */ 
public function setComment($comment)
{
$this->comment = $comment;

return $this;
}

/**
 * Get the value of rate
 */ 
public function getRate()
{
return $this->rate;
}

/**
 * Set the value of rate
 *
 * @return  self
 */ 
public function setRate($rate)
{
$this->rate = $rate;

return $this;
}

/**
 * Get the value of created_at
 */ 
public function getCreated_at()
{
return $this->created_at;
}

/**
 * Set the value of created_at
 *
 * @return  self
 */ 
public function setCreated_at($created_at)
{
$this->created_at = $created_at;

return $this;
}

/**
 * Get the value of updated_at
 */ 
public function getUpdated_at()
{
return $this->updated_at;
}

/**
 * Set the value of updated_at
 *
 * @return  self
 */ 
public function setUpdated_at($updated_at)
{
$this->updated_at = $updated_at;

return $this;
}








public function create(){

    $query = " INSERT INTO " . self::TABLE . " (user_id,product_id,comment) VALUES (?, ?, ? )";
    $stmt = $this->conn->prepare($query);
    if(!$stmt){
        return false ;
    }
    $stmt->bind_param('iis',$this->user_id,$this->product_id,$this->comment);
    return $stmt->execute();


}
public function reade(){

  
}
public function update(){

  
}
public function delete(){

  
}


public function isReviwed(){

    $query = " SELECT * FROM " . self::TABLE  . " WHERE user_id = ? AND product_id = ?";
    $stmt= $this->conn->prepare($query) ;
    $stmt->bind_param('ii',$this->user_id,$this->product_id);
    $stmt->execute();
    return $stmt->get_result();


}



}
