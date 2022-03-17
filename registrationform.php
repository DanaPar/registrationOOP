<?php
require ("vendor/autoload.php");
use RegistrationForm\UserService;


$name = $_POST["name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$password = $_POST["password"];
$confirmed_password = $_POST["confirmed_password"];


$user = new UserService($name, $last_name, $email, $phone, $password, $confirmed_password);
$user->register();




