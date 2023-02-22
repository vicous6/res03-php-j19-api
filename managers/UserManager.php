<?php

class UserManager extends AbstractManager {

    public function getAllUsers() : array
    {
        // get all the users from the database
         $query = $this->db->prepare('SELECT * FROM users');
    
$parameters = [
	   
	];
$query->execute();
$theUsers = $query->fetchAll(PDO::FETCH_ASSOC);


        $tab = [];

 foreach($theUsers as $user){
    
    
    $newUser = new User ($user["id"] ,$user["username"],$user["first_name"],$user["last_name"],$user["email"]);
  
    array_push($tab,$newUser);
}
return $tab;

    }

    public function getUserById(int $id) : User
    {
        
       $query = $this->db->prepare('SELECT * FROM users WHERE id = :id');
	$parameters = [
	    "id"=>$id
	];
$query->execute($parameters);
$user = $query->fetch(PDO::FETCH_ASSOC);

$theUser = new User ($user["id"] ,$user["username"],$user["first_name"],$user["last_name"],$user["email"]);

return $theUser;

        }

    public function createUser(User $user) : User
    {
        echo 'coucouss';
    $query = $this->db->prepare('INSERT INTO users VALUES (null, :username,:firstName,:lastName,:email)');

    	$parameters = [
	    "username"=>$user->getUsername(),
	    "firstName"=>$user->getFirstName(),
	    "lastName"=>$user->getLastName(),
	    "email"=>$user->getEmail()
	];
	
$query->execute($parameters);



 $query2 = $this->db->prepare('SELECT * FROM users WHERE email = :email');
 	$parameters = [
	    "email"=>$user->getEmail()
	];

	$query2->execute($parameters);
	
	$user = $query2->fetch(PDO::FETCH_ASSOC);

	$theUser = new User ($user["id"] ,$user["username"],$user["first_name"],$user["last_name"],$user["email"]);
	return $theUser;
	
    }

    public function updateUser(User $user) : User
    {
        $query = $this->db->prepare('UPDATE users SET username =:username,firstName =:firstName,lastName =:lastName,email =:email WHERE users.id=:id');

    	$parameters = [
    	    "id"=>$user->getId(),
	    "username"=>$user->getUsername(),
	    "firstName"=>$user->getFirstName(),
	    "lastName"=>$user->getLastName(),
	    "email"=>$user->getEmail()
	];
	
        $query->execute($parameters);


        $query = $this->db->prepare('SELECT * FROM users WHERE email = :email');
 	$parameters = [
	    "email"=>$user->getEmail()
	];
	$query->execute($parameters);
	
	$user = $query->fetch(PDO::FETCH_ASSOC);
	
	$theUser = new User ($user["id"] ,$user["username"],$user["first_name"],$user["last_name"],$user["email"]);
	return $theUser;
	
    }

    public function deleteUser(User $user) : array
    {
      $query = $this->db->prepare('DELETE * FROM users WHERE id = :id');
 	$parameters = [
	    "email"=>$user->getId()
	];
	$query->execute($parameters);
	
       return getAllUsers();
    }
}