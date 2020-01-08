<?php

class RegisterValidation {

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
        //$this->validateUsername();
        $this->validateEmail();
        $this->validatePassword();

        return $this->errors;
    }

    private function validateName() {

        $value = trim($this->data['name']);

        if(empty($value)) {
            $this->addError('name', 'Vardas negali buti tuscias!');
        } 
    }

    private function validateLastname() {

        $value = trim($this->data['lastname']);

        if(empty($value)) {
            $this->addError('lastname', 'Pavarde negali buti tuscia!');
        } 
    }

    //private function validateUsername() {

        //$value = trim($this->data['username']);

        //if(empty($value)) {
            //$this->addError('username', 'Vartotojo vardas negali buti tuscias!');
        //} //else {
            //if(!preg_match('/^[a-zA-Z0-9]{6,12}$/', $value)) {
                //$this->addError('username', 'Vartotojo vardas privalo buti 6-12 simboliu!');
            //}
        //}
    //}

    private function validateEmail() {
        $value = trim($this->data['email']);

        if(empty($value)) {
            $this->addError('email', 'El.Pasto adresas negali buti tuscias!');
        } else {
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'El.Pasto adresas turi buti tikras!');
            }
        }
    }

    private function validatePassword() {

        $value = trim($this->data['password']);

        if(empty($value)) {
            $this->addError('password', 'Slaptazodis negali buti tuscias!');
        } //else {
            //if(!preg_match('/^[a-zA-Z0-9]{6,12}$/', $value)) {
                //$this->addError('password', 'Slaptazodis privalo buti 6-12 simboliu!');
            //}
        //}
    }

    private function addError($key, $value) {
        $this->errors[$key] = $value;
    }

}