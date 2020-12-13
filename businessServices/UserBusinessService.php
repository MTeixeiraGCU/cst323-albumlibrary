<?php

/**
 * UserBusinessService.php
 * Description: This class is designed to handle business logic for users and user logins
 * 
 * @author Marc Teixeira
 * Nov 24, 2020
 */


include_once $_SERVER['DOCUMENT_ROOT'] . 'autoloader.php';

class UserBusinessService {
    
    public function __construct() {
        $this = new ActivityLogger($this);
    }
    
    public function loginUser($email, $password) {
        $das = new UserDataAccessService();
        
        $email = $das->getUser($email, $password);
        return $email;
    }
    
    public function registerUser($email, $userName, $password, $dob, $role) {
        $das = new UserDataAccessService();
   
        if($das->insertUser($email, $userName, $password, $dob, $role)) {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function updateUser($email, $userName, $password, $dob, $role) {
        $das = new UserDataAccessService();
        
        if($das->updateUser($email, $userName, $password, $dob, $role)) {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function deleteUser($email) {
        $das = new UserDataAccessService();
        
        if($das->deleteUser($email)) {
            return true;
        }
        else {
            return false;
        }
    }
}
?>