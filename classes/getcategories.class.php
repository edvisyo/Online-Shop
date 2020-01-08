<?php

class Getcategories {
    
    private $id,
            $category_name;

    public function __construct($dbRows) {
        $this->id = $dbRows['id'];
        $this->category_name = $dbRows['category_name'];
    }   
    
    
    public function getId() {
        return $this->id;
    }

    public function getCategoryName() {
        return $this->category_name;
    }
}