<?php
require ("vendor/autoload.php");
use RegistrationForm\UserService;



$user = new UserService();
$user->register();




