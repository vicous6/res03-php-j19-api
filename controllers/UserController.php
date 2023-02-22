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

  public function createUser(array $post)
    {
        
        // create the user in the manager
        $newUser = new User(null, $post['username'], $post['firstName'], $post['lastName'], $post['email']);
        $userCreated = $this->um->createUser($newUser);

        $userTab = $userCreated->toArray();

        // render the created user
        $this->render($userTab);

    }

    public function updateUser(string $post)
    {
        var_dump($_POST);
        // update the user in the manager
        $userToUpdate = new User(intval($_POST['id']), $_POST['username'], $_POST['firstName'], $_POST['lastName'], $_POST['email']);
       var_dump($userToUpdate);
        $this->um->updateUser($userToUpdate);
echo 'manager passé';
        $userTab = $userToUpdate->toArray();
var_dump($userTab);

        // render the updated user
        $this->render($userTab);

    }

    public function deleteUser(string $post)
    {
        
        // delete the user in the manager
        $this->um->deleteUser(intval($post));

        // render the list of all users
        $this->render(['users' => $this->um->getAllUsers()]);
    }
}