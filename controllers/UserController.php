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
       
       $tab =[];
foreach($users as $user){
    
    
  
    array_push($tab ,$user->toArray());
}
        $this->render($tab);
        
    }

    public function getUser(string $get)
    {
      
        $id = intval($get);
      
        // get the user from the manager
         $user= $this->um->getUserById($id);
  
       
      $tab =   $user->toArray();

      $this->render($tab);
    }
// $_POST????????
  public function createUser(array $post)
    {
        // create the user in the manager
        $newUser = new User(null, $post['username'], $post['firstName'], $post['lastName'], $post['email']);
        $userCreated = $this->um->createUser($newUser);

        $userTab = $userCreated->toArray();

        // render the created user
        $this->render($userTab);

    }

    public function updateUser(array $post)
    {
        // update the user in the manager
        $userToUpdate = new User(intval($post['id']), $post['username'], $post['firstName'], $post['lastName'], $post['email']);
        $this->um->updateUser($userToUpdate);

        $userTab = $userToUpdate->toArray();

        // render the updated user
        $this->render($userTab);

    }

    public function deleteUser(array $post)
    {
        // delete the user in the manager
        $this->um->deleteUser(intval($post['id']));

        // render the list of all users
        $this->render(['users' => $this->um->getAllUsers()]);
    }
}