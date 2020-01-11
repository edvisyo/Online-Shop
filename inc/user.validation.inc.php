<?php

class UserValidation extends Login {

    private $data,
            $errors = [];

    private static $fields = ['email', 'password'];

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

        $this->validateEmail();
        $this->validatePassword();

        return $this->errors;
    }


    private function validateEmail() {
        $value = trim($this->data['email']);

        if(empty($value)) {
            $this->addError('email', 'El.Pašto adresas negali būti tuščias!');
        } else {
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'El.Pašto adresas turi būti tikras!');
            }
        } if($this->checkEmail($value)) {
            $this->addError('email', 'El.Pašto adresas įvestas neteisingas');
        } 
    }

    private function validatePassword() {

        $value = trim($this->data['password']);

        if(empty($value)) {
            $this->addError('password', 'Slaptažodis negali būti tuščias!');
        } else {
            if($this->checkPassword(md5($value))) {
                $this->addError('password', 'Slaptažodis įvestas neteisingas');
            }
        } 
    }

    private function addError($key, $value) {
        $this->errors[$key] = $value;
    }

}