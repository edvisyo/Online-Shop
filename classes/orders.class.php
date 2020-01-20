<?php

    class Orders extends Database {

    public function makeOrder($user_id, $product_id, $product_name, $product_price, $product_quantity, $total_price) {

        try {

            $stmt = $this->connect()->prepare("INSERT INTO orders (user_id, product_id, product_name, product_price, product_quantity, total_price) VALUES(:user_id, :product_id, :product_name, :product_price, :product_quantity, :total_price)");
            $stmt->execute(array(
                'user_id' => $user_id,
                'product_id' => $product_id,
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_quantity' => $product_quantity,
                'total_price' => $total_price
            ));

        } catch (PDOException $e) {
            return "Inserting data ERROR:" . $e->getMessage();
        }
    }


        public function getOrders($query) {

        try {

            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
                while($row = $stmt->fetch()) {
                $data[] = new Getorders($row);
            }   if(!empty($data)) {
                return $data;
            }   else {
                return false;
            } 

        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }


    public function deleteOrders($id) {

        try {

        $stmt = $this->connect()->prepare("DELETE FROM orders WHERE id= '$id'");
        $stmt->execute();

        return $stmt;

        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }
    
}


?>