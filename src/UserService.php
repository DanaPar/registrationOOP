<?php
namespace RegistrationForm;

class UserService {
    private UserValidator $validator;
    private UserRepository $repository;

    public function __construct(){
        $this->validator = new UserValidator();
        $this->repository = new UserRepository();
    }

    public function register(User $user): void {

        $new_user = new User($user->name(), $user->lastName(), $user->email(), $user->phone(), $user->password(), $user->confirmedPassword());
        $this->validator->validate($new_user);
        $this->repository->dbConnection($new_user);



    }
}