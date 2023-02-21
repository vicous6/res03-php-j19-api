<?php

class UserController extends AbstractController {
    private UserManager $um;

    public function __construct()
    {
        $this->um = new UserManager();
    }

    public function getUsers()
    {
       $users = $this->um->getAllUsers();

        $this->render(["users"=>$users]);
    }

    public function getUser(array $get)
    {
        // get the user from the manager
         $users = $this->um->getUserById($get["id"]);
        // either by email or by id

   $this->render(["users"=>$users]);
    }

    public function createUser(array $post)
    {
        // create the user in the manager

        // render the created user
    }

    public function updateUser(array $post)
    {
        // update the user in the manager

        // render the updated user
    }

    public function deleteUser(array $post)
    {
        // delete the user in the manager

        // render the list of all users
    }
}