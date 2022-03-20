<?php
namespace RegistrationForm;

class User {
    private $name;
    private $last_name;
    private $email;
    private $phone;
    private $password;
    private $confirmed_password;

    public function __construct(string $name, string $last_name, string $email, string $phone, string $password, string $confirmed_password){
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