<?php

namespace App\Database\Models;

use App\Database\Models\Contract\Crud;



class Product extends Model implements Crud {

    const TABLE = "product_details";

  private $id,$name_en,$name_ar,$image,$price,$details_en,$details_ar,$quantity,$status,$created_at,$updated_at,$brand_id,$subcategory_id ;




  /**
   * Get the value of id
   */ 
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  self
   */ 
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of name_en
   */ 
  public function getName_en()
  {
    return $this->name_en;
  }

  /**
   * Set the value of name_en
   *
   * @return  self
   */ 
  public function setName_en($name_en)
  {
    $this->name_en = $name_en;

    return $this;
  }

  /**
   * Get the value of name_ar
   */ 
  public function getName_ar()
  {
    return $this->name_ar;
  }

  /**
   * Set the value of name_ar
   *
   * @return  self
   */ 
  public function setName_ar($name_ar)
  {
    $this->name_ar = $name_ar;

    return $this;
  }

  /**
   * Get the value of price
   */ 
  public function getPrice()
  {
    return $this->price;
  }

  /**
   * Set the value of price
   *
   * @return  self
   */ 
  public function setPrice($price)
  {
    $this->price = $price;

    return $this;
  }

  /**
   * Get the value of image
   */ 
  public function getImage()
  {
    return $this->image;
  }

  /**
   * Set the value of image
   *
   * @return  self
   */ 
  public function setImage($image)
  {
    $this->image = $image;

    return $this;
  }

  /**
   * Get the value of details_en
   */ 
  public function getDetails_en()
  {
    return $this->details_en;
  }

  /**
   * Set the value of details_en
   *
   * @return  self
   */ 
  public function setDetails_en($details_en)
  {
    $this->details_en = $details_en;

    return $this;
  }

  /**
   * Get the value of details_ar
   */ 
  public function getDetails_ar()
  {
    return $this->details_ar;
  }

  /**
   * Set the value of details_ar
   *
   * @return  self
   */ 
  public function setDetails_ar($details_ar)
  {
    $this->details_ar = $details_ar;

    return $this;
  }

  /**
   * Get the value of quantity
   */ 
  public function getQuantity()
  {
    return $this->quantity;
  }

  /**
   * Set the value of quantity
   *
   * @return  self
   */ 
  public function setQuantity($quantity)
  {
    $this->quantity = $quantity;

    return $this;
  }

  /**
   * Get the value of status
   */ 
  public function getStatus()
  {
    return $this->status;
  }

  /**
   * Set the value of status
   *
   * @return  self
   */ 
  public function setStatus($status)
  {
    $this->status = $status;

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

  /**
   * Get the value of brand_id
   */ 
  public function getBrand_id()
  {
    return $this->brand_id;
  }

  /**
   * Set the value of brand_id
   *
   * @return  self
   */ 
  public function setBrand_id($brand_id)
  {
    $this->brand_id = $brand_id;

    return $this;
  }

  /**
   * Get the value of subcategory_id
   */ 
  public function getSubcategory_id()
  {
    return $this->subcategory_id;
  }

  /**
   * Set the value of subcategory_id
   *
   * @return  self
   */ 
  public function setSubcategory_id($subcategory_id)
  {
    $this->subcategory_id = $subcategory_id;

    return $this;
  }

  public function create(){


  }
  public function reade(){

    
  }
  public function update(){

    
  }
  public function delete(){

    
  }



  public function specs(){

    $query = " SELECT specs.name , product_spec.value , product_spec.product_id
    from specs JOIN product_spec ON 
    specs.id = product_spec.spec_id
    WHERE product_spec.product_id = ? ";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i',$this->id);
    $stmt->execute();
    return $stmt->get_result();
  }



  public function reviews(){

    $query ="SELECT reviwes.* , users.first_name , users.last_name
    FROM reviwes JOIN users ON users.id = reviwes.user_id
    WHERE reviwes.product_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i',$this->id);
    $stmt->execute();
    return $stmt->get_result();

  }



  public function latestProducts(){



    $query = "SELECT * FROM products
    order BY created_at DESC
    LIMIT 4";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->get_result();
  }


    



}





