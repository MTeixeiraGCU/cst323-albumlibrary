<?php

/**
 * User.php
 * Description: This class is designed to hold information on a single user
 *
 */
class User {
    
   //properties
   private $userName;
   private $password;
   private $email;
   private $dob;
   private $role;

   //constructor
   public function __construct($userName, $password, $email, $dob, $role) {
       $this->userName = $userName;
       $this->password = $password;
       $this->email = $email;
       $this->dob = $dob;
       $this->role = $role;
   }
   
   //getters / setters
   /**
    * @return mixed
    */
   public function getUserName()
   {
       return $this->userName;
   }
   
   /**
    * @return mixed
    */
   public function getPassword()
   {
       return $this->password;
   }
   
   /**
    * @return mixed
    */
   public function getEmail()
   {
       return $this->email;
   }
   
   /**
    * @return mixed
    */
   public function getDob()
   {
       return $this->dob;
   }
   
   /**
    * @return mixed
    */
   public function getRole()
   {
       return $this->role;
   }
   
   /**
    * @param mixed $userName
    */
   public function setUserName($userName)
   {
       $this->userName = $userName;
   }
   
   /**
    * @param mixed $password
    */
   public function setPassword($password)
   {
       $this->password = $password;
   }
   
   /**
    * @param mixed $email
    */
   public function setEmail($email)
   {
       $this->email = $email;
   }
   
   /**
    * @param mixed $dob
    */
   public function setDob($dob)
   {
       $this->dob = $dob;
   }
   
   /**
    * @param mixed $role
    */
   public function setRole($role)
   {
       $this->role = $role;
   }
   
}

?>