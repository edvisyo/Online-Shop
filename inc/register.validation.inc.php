<?php

class RegisterValidation extends Database {

    private $data,
            $errors = [];

    private static $fields = ['name', 'lastname', 'email', 'password'];

    public function __construct($post_data) {
        $this->data = $post_data;
    }

    public function validateForm() {
        foreach(self::$fields as $field) {
            if(!array_key_exists($field, $this->data)) {
                trigger_error("$field is not present in data");
                return;
            }
        }

        $this->validateName();
        $this->validateLastname();
        $this->validateEmail();
        $this->validatePassword();

        return $this->errors;
    }

    private function validateName() {

        $value = trim($this->data['name']);

        if(empty($value)) {
            $this->addError('name', 'Vardas negali būti tuščias!');
        } 
    }

    private function validateLastname() {

        $value = trim($this->data['lastname']);

        if(empty($value)) {
            $this->addError('lastname', 'Pavardė negali būti tuščia!');
        } 
    }

    private function uniqueEmail($value) {

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

    private function validateEmail() {
        $value = trim($this->data['email']);

        if(empty($value)) {
            $this->addError('email', 'El.Pašto adresas negali būti tuščias!');
        } else {
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'El.Pašto adresas turi būti tikras!');
            }
        } if($this->uniqueEmail($value)) {
            $this->addError('email', 'Toks El.Pašto adresas jau egzistuoja!');
        } 
    }

    private function validatePassword() {

        $value = trim($this->data['password']);

        if(empty($value)) {
            $this->addError('password', 'Slaptažodis negali būti tuščias!');
        } else {
            if(!preg_match('/^[a-zA-Z0-9]{6,12}$/', $value)) {
                $this->addError('password', 'Slaptažodis privalo būti 6-12 simbolių!');
            }
        }
    }

    private function addError($key, $value) {
        $this->errors[$key] = $value;
    }

}