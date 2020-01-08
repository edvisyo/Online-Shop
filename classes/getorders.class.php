<?php

class Getorders {

    private $id,
            $user_id,
            $product_id,
            $product_name,
            $product_quantity,
            $total_price,
            $order_created_at;

    public function __construct($rows) {
        $this->id = $rows['id'];
        $this->user_id = $rows['user_id'];
        $this->product_id = $rows['product_id'];
        $this->product_name = $rows['product_name'];
        $this->product_quantity = $rows['product_quantity'];
        $this->total_price = $rows['total_price'];
        $this->order_created_at = $rows['order_created_at'];
    } 
    
    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getProductId() {
        return $this->product_id;
    }

    public function getProductName() {
        return $this->product_name;
    }

    public function getProductQuantity() {
        return $this->product_quantity;
    }

    public function getTotalPrice() {
        return $this->total_price;
    }

    public function getOrderDate() {
        return $this->order_created_at;
    }
}