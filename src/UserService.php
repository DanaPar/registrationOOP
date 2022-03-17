<?php
namespace RegistrationForm;

class UserService {
    public function register(){
        $name = $_POST["name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];
        $confirmed_password = $_POST["confirmed_password"];

        $new_user = new User($name, $last_name, $email, $phone, $password, $confirmed_password);
        $validate = new UserValidator();
        $validate->validate($new_user);
        $db = new UserRepository();
        $db->dbConnection($new_user);


    }
}