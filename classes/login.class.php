<?php

class Login extends Database {


        public function loginUsers($email, $password) {

            try {

                $stmt = $this->connect()->prepare("SELECT * FROM users WHERE email= :email AND password= :password");
                $stmt->execute(array('email' => $email, 'password' => $password));
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if($stmt->rowCount() > 0) {
                    if($row['user_status_id'] == 1) {
                        session_start();
                        $_SESSION['username'] = $row['name'];
                        $_SESSION['status'] = $row['user_status_id'];
                        header("Location: admin.view.php");
                    } 
                    else if($row['user_status_id'] == 2) {
                        session_start();
                        $_SESSION['username'] = $row['email'];
                        $_SESSION['userId'] = $row['id'];
                        header("Location: ../index.php");
                    }
        } 
            return true;

            } 
                catch(PDOException $e) {
                    die($e->getMessage());
                    return false;
            }
    }
}