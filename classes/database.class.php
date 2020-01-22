<?php

class Database {

    private $dbhost,
            $dbuser,
            $dbpass,
            $dbname,
            $charset;

    public function connect() {

        $this->dbhost = "localhost";
        $this->dbuser = "root";
        $this->dbpass = "";
        $this->dbname = "onlineshoppdo";
        $this->charset = "UTF8";


        try{
        $dsn = "mysql:host=" . $this->dbhost . ";dbname=" . $this->dbname . ";charset=" . $this->charset;
        $pdo = new PDO($dsn, $this->dbuser, $this->dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully!";
        return $pdo;
        } catch (PDOException $e) {
                echo "Connect failed:" . $e->getMessage();
        }
    }
    
    
}
