<?php

class User {
    public $name;
    public $last_name;
    public $email;
    public $phone;
    public $password;
    public $confirmed_password;

   public function __construct($name, $last_name, $email, $phone, $password, $confirmed_password){
        $this->name = $name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->confirmed_password = $confirmed_password;
    }

    public function name(): string {
        return $this->name;
    }
    public function lastName(): string {
        return $this->last_name;
    }
    public function email(): string {
        return $this->email;
    }
    public function phone(): string {
        return $this->phone;
    }
    public function password(): string {
        return $this->password;
    }
    public function confirmedPassword(): string {
        return $this->confirmed_password;
    }

}

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


class UserRepository
{

    public $servername = "localhost";
    public $username = "root";
    public $db_password = "";
    public $db_name = "registration_form";


    public function dbConnection(User $new_user)
    {


        try {
            $conn = new PDO("mysql:host=$this->servername; dbname=$this->db_name", $this->username, $this->db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        } catch (PDOException $e) {
            die( $e->getMessage());
        }


        try {

            $sql = "INSERT INTO user_registration (firstname, secondname, email, phone, password) VALUES (:firstname, :secondname, :email, :phone, :password)";

            $stmt = $conn->prepare($sql);

            $hashed_password = password_hash($new_user->password, PASSWORD_DEFAULT);

            $stmt->bindParam(':firstname', $new_user->name);
            $stmt->bindParam(':secondname', $new_user->last_name);
            $stmt->bindParam(':email', $new_user->email);
            $stmt->bindParam(':phone', $new_user->phone);
            $stmt->bindParam(':password', $hashed_password);



            $stmt->execute();
            echo "registration successful";
        } catch (PDOException $e) {

            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }

    }
}


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



$user = new UserService();
$user->register();




