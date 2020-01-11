<?php


class Products extends Database {


    public function categoryRegist($category_name = null) {
        
        try {

            $stmt = $this->connect()->prepare("INSERT INTO product_category (category_name) VALUES (:category_name)");
            $stmt->bindParam(':category_name', $category_name);
            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {
            return "Inserting data ERROR:" . $e->getMessage();
        }
    }


    public  function getCategory($sql) {

        try {

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            while($row = $stmt->fetch()) {
                $data[] = new Getcategories($row);
            } if(!empty($data)) {
                return $data;
            } else {
                return false;
            }
            
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }



    public function productRegister($name, $description, $price, $image, $product_category_id) {

        try {

            $stmt = $this->connect()->prepare("INSERT INTO products (name, description ,price, image, product_category_id) VALUES(:name, :description, :price, :image, :product_category_id)");
            $stmt->execute(array(
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'image' => $image,
                'product_category_id' => $product_category_id
            ));

        } catch (PDOException $e) {
            return "Inserting data ERROR:" . $e->getMessage();
        }
    }



    public function getProducts($sql) {

        try {

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch()) {
                $data[] = new Getproducts($row);
            }   if(!empty($data)) {
                return $data;
            }   else {
                return false;
            }

        } catch(PDOException $e) {
            return $e->getMessage();
        }
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


    public function editProduct($id, $name, $description, $price) {

        try {

        $stmt = $this->connect()->prepare("UPDATE  products SET name= '$name', description= '$description', price= '$price' WHERE id= '$id'"); 
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->execute();
        
        return $stmt;

        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }


}