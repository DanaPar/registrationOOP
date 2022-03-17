<?php
namespace RegistrationForm;
use PDO;
use PDOException;

class UserRepository
{

    public $servername = "localhost";
    public $username = "root";
    public $db_password = "123456";
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



            $name = $new_user->name();
            $last_name = $new_user->lastName();
            $email = $new_user->email();
            $phone = $new_user->phone();
            $hashed_password = password_hash($new_user->password(), PASSWORD_DEFAULT);

            $stmt->bindParam(':firstname', $name);
            $stmt->bindParam(':secondname', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':password', $hashed_password);



            $stmt->execute();
            echo "registration successful";
        } catch (PDOException $e) {

            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }

    }
}