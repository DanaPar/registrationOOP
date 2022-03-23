<?php
require ("vendor/autoload.php");
use RegistrationForm\UserService;
use RegistrationForm\User;



$name = $_POST["name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$password = $_POST["password"];
$confirmed_password = $_POST["confirmed_password"];


$user = new User($name, $last_name, $email, $phone, $password, $confirmed_password);
$service = new UserService();
$service->register($user);




