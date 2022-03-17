<?php
namespace RegistrationForm;

class UserService {
    private $name;
    private $last_name;
    private $email;
    private $phone;
    private $password;
    private $confirmed_password;


    public function __construct($name, $last_name, $email, $phone, $password, $confirmed_password){
        $this->name = $name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->confirmed_password = $confirmed_password;
    }
    public function register(){

        $new_user = new User($this->name, $this->last_name, $this->email, $this->phone, $this->password, $this->confirmed_password);
        $validate = new UserValidator();
        $validate->validate($new_user);
        $db = new UserRepository();
        $db->dbConnection($new_user);


    }
}