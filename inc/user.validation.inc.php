<?php

class UserValidation {

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