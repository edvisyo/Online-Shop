<?php

class Pagination extends Database {

    
}
     
     
    // Sample Usage
     
    // class Pagination extends Database{

    //     private $limit = 3,
    //             $total_records;


    //     public function set_total_records(){
    //         $stmt   = $this->connect()->prepare("SELECT id FROM products");
    //         $stmt->execute();
    //         $this->total_records = $stmt->rowCount();
    //     }

    //     public function current_page(){
    //         return isset($_GET['page']) ? (int)$_GET['page'] :1;
    //     }


    //     public function get_data(){
    //         $start = 0;
    //         if($this->current_page() > 1){
    //             $start = ($this->current_page() * $this->limit) - $this->limit;
    //         }
    //         $stmt = $this->connect()->prepare("SELECT * FROM products LIMIT $start, $this->limit");
    //         $stmt->execute();
    //         return $stmt->fetchAll(PDO::FETCH_OBJ);
    //     }


    //     public function get_pagination_numbers(){
    //         
    //         $p = ceil($this->total_records / $this->limit);
    //         return $p;
    //     }

    // }
     