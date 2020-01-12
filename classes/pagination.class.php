<?php

// class Pagination extends Products {

// }

class Pagination extends Database {

    public function records() {

        try {

            $stmt = $this->connect()->prepare("SELECT * FROM products");
            $stmt->rowCount();
            $stmt->execute();
            $counts = $stmt->rowCount();
                //if($counts > 0) {
                    //echo "Total .$counts";
                //} else {
                    //echo "Nothing is count";
                //}

            $page_rows = 6;
            $last_page = ceil($counts/$page_rows);
            
            echo $last_page;

            if($last_page < 1) {
                $last_page = 1;
            }

            if(isset($_GET['page'])) {
                $page_num = preg_replace('#[^0-9]#', '', $_GET['page']);
                echo $page_num;
            }

            $page_num = 10;

            if($page_num < 1) {
                $page_num = 1;
            } else if($page_num > $last_page) {
                $page_num = $last_page;
            }

            $begin_limit = ($page_num - 1)*$page_rows;
            $end_limit = $page_rows;

            $query = $this->connect()->prepare("SELECT * FROM products ORDER BY id DESC LIMIT :begin, :end");
            $query->bindValue(':begin', (int)$begin_limit, PDO::PARAM_INT);
            $query->bindValue(':end', (int)$end_limit, PDO::PARAM_INT);
            $query->execute();
            while($res = $query->fetch(PDO::FETCH_ASSOC));
                $all = $res['id'];
                echo $all;

        } catch(PDOException $e) {
            return "ERROR:" . $e->getMessage();
        }        

    }
}



     