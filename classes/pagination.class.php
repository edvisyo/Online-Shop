<?php 


class Pagination extends Database {

    private $table,
            //$category = 3,
            $total_records,
            $limit = 6;


    public function __construct($table) {
        $this->table = $table;
        $this->set_total_records();
    }        
           
    
    public function set_total_records() {

        $query = "SELECT id FROM products";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $this->total_records = $stmt->rowCount();
    }


    public function getData() {

        $start = 0;
        if($this->currentPage() > 1) {
            $start = ($this->currentPage() * $this->limit) - $this->limit;
        }
        $query = "SELECT * FROM $this->table LIMIT $start, $this->limit";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function getDataByCategory($category) {

        $start = 0;
        if($this->currentPage() > 1) {
            $start = ($this->currentPage() * $this->limit) - $this->limit;
        }
        $query = "SELECT * FROM $this->table WHERE product_category_id= '$category' LIMIT $start, $this->limit";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    
    public function currentPage() {
        return isset($_GET['page']) ? (int)$_GET['page'] :1;
    }
    
    
    public function getPageNumbers() {
        return ceil($this->total_records / $this->limit);
    }
}