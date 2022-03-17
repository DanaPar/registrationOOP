<?php

class UserValidator {
    public function validateFields($data){
        if(empty($data)){
            die("$data empty field");
        }
        elseif (strlen($data) > 64){
            die("exceeds 64 characters");
        }
    }

    public function validateName(User $new_user){
        $this->validateFields($new_user->name());
    }

    public function validateLastName(User $new_user){
        $this->validateFields($new_user->lastName());
    }

    public function validateEmail(User $new_user){
        if(!filter_var($new_user->email(), FILTER_VALIDATE_EMAIL)){
            die("try again");
        }
        $this->validateFields($new_user->email());
    }

    public function validatePhone(User $new_user){
        if(is_numeric($new_user->phone())) {
            if (mb_strlen($new_user->phone()) < 8) {
                die("phone number too short");
            } elseif (mb_strlen($new_user->phone()) > 8) {
                die("phone number to long");
            }
        } else {
            die("Only digits allowed as phone number");
        }

        $this->validateFields($new_user->phone());
    }

    public function validatePassword(User $new_user){
        $this->validateFields($new_user->password());
        $this->validateFields($new_user->confirmedPassword());
        if($new_user->password() !== $new_user->confirmedPassword()){
            die("Password doesnt match!");
        }
    }

    public function validate(User $new_user){
        $this->validateName($new_user);
        $this->validateLastName($new_user);
        $this->validateEmail($new_user);
        $this->validatePhone($new_user);
        $this->validatePassword($new_user);
    }
}