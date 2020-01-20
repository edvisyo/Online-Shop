<?php 


class Pagination extends Database {

    private $table,
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


    public function deleteProduct($id) {

        try {

        $stmt = $this->connect()->prepare("DELETE FROM products WHERE id= '$id'"); 
        $stmt->execute();
        
        return $stmt;

        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    
    public function currentPage() {
        return isset($_GET['page']) ? (int)$_GET['page'] :1;
    }

    
    public function getPageNumbers() {
        return ceil($this->total_records / $this->limit);
    }

    public function prevPage() {
        return ($this->currentPage() - 1);
    }

    public function nextPage($page) {
        return ($this->currentPage($page) + 1);
    }

    public function is_active($page) {
        return ($page == $this->currentPage()) ? 'active' : '';
    }
}