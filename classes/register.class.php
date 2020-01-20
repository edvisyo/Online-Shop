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


    public function notUniqueEmail($value) {

        try {

            $stmt = $this->connect()->prepare("SELECT email FROM users WHERE email= '$value'");
            $stmt->execute();
            $row = $stmt->fetch();
            if($row) {
                return TRUE;
            }

        } catch(PDOException $e) {
            return "ERROR:" . $e->getMessage();
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


    public function loginAfterRegister($email, $password) {

        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE email= :email AND password= :password");
        $stmt->execute(array('email' => $email, 'password' => $password));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0) {
            $_SESSION['username'] = $row['email'];
            $_SESSION['userId'] = $row['id'];
            }
    }



}

