<?php


class Register extends Database {

    public function userRegister($name = null, $lastname = null, $email = null, $password = null, $user_status_id = null) {

        try {

            $stmt = $this->connect()->prepare("INSERT INTO users (name, lastname, email, password ,user_status_id) VALUES(:name, :lastname, :email, :password, :user_status_id)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':user_status_id', $user_status_id);
            $stmt->execute();

            return $stmt;
        
                 if($stmt->execute()) {
                     return "Registered successfully!";
             } 
         }   catch (PDOException $e) {
             return "Register ERROR:" . $e->getMessage();
         }
        
    }



    public function adminRegister($name = null, $password = null, $user_status_id = null) {

        try {

            $stmt = $this->connect()->prepare("INSERT INTO users (name, password ,user_status_id) VALUES(:name, :password, :user_status_id)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':user_status_id', $user_status_id);
            $stmt->execute();

            return $stmt;
        
                 if($stmt->execute()) {
                     return "Registered successfully!";
             } 
         }   catch (PDOException $e) {
             return "Register ERROR:" . $e->getMessage();
         }
        
    }



}

