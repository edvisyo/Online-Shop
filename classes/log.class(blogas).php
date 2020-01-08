<?php

//require("user.validation.class.php");

class Login extends Database {

     //private $email,
             //$password;
             //$rememberMe;

      public function loginUsers($email, $password) {
          //$stmt = $this->connect()->prepare("SELECT * FROM users WHERE email='" . $email ."AND password='" . $password. "'");
          //$stmt = $this->connect()->prepare("SELECT * FROM users WHERE email= :email AND password= :password");
          try {

               $stmt = $this->connect()->prepare("SELECT * FROM users WHERE email= :email AND password= :password");
               $stmt->execute(array(':email' => $email, ':password' => $password));
               $row = $stmt->fetch(PDO::FETCH_ASSOC);
               if(password_verify($password, $row['password'])) {
                    //session_regenerate_id();
                    //$_SESSION['authorized'] = true;
                    session_start();
                    $_SESSION['username'] = $row['name'];
                    //session_write_close();
      } 
          return true;

          
     
     //public function loginUsers($email, $password) { //$remember) {

          //$this->email = $email;
          //$this->password = $password;
          //$this->rememberMe = $remember;

          //if($this->email == "admin@admin.com" && $this->password == "admin") {
               //session_start();
               //$_SESSION['username'] = $this->email;

                //if($this->rememberMe == 1) {
                     //setcookie("username", $this->email, time() + (86400 * 30), "/"); // 86400 = 1 day
                //}
               //return true;
          //} else {
               //return false;
          //}

          } 
               catch(PDOException $e) {
                    die($e->getMessage());
                    return false;
          }
     }
}