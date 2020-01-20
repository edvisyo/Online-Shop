<?php

class Getproducts {

    private $id,
            $name,
            $description,
            $price,
            $image;
            

    public function __construct($dbRows) {

        $this->id = $dbRows['id'];
        $this->name = $dbRows['name'];
        $this->description = $dbRows['description'];
        $this->price = $dbRows['price'];
        $this->image = $dbRows['image'];
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getImage() {
        return $this->image;
    }
}