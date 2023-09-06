<?php

namespace App\Database\Models;

use App\Database\Models\Contract\Crud;

class OrderProduct extends Model implements Crud{


    const TABLE = 'order_product';

    private $order_id,$product_id,$price,$quantity;





    /**
     * Get the value of order_id
     */ 
    public function getOrder_id()
    {
        return $this->order_id;
    }

    /**
     * Set the value of order_id
     *
     * @return  self
     */ 
    public function setOrder_id($order_id)
    {
        $this->order_id = $order_id;

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




    public function create(){


    }
    public function reade(){
  
      
    }
    public function update(){
  
      
    }
    public function delete(){
  
      
    }
  


    public function mostOrderProducts(){


        $query = "SELECT  order_product.product_id, SUM( order_product.quantity) AS total_quantity , products.image , products.name_en , products.price
        FROM order_product JOIN products ON products.id = order_product.product_id
        GROUP BY product_id
        order by  total_quantity DESC
        LIMIT 3";


      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt->get_result();

    }






}