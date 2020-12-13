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
    
    public function loginUser($email, $password) {
        $das = new UserDataAccessService();
        $das = new ActivityLogger($das);
        
        $email = $das->getUser($email, $password);
        return $email;
    }
    
    public function registerUser($email, $userName, $password, $dob, $role) {
        $das = new UserDataAccessService();
        $das = new ActivityLogger($das);
   
        if($das->insertUser($email, $userName, $password, $dob, $role)) {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function updateUser($email, $userName, $password, $dob, $role) {
        $das = new UserDataAccessService();
        $das = new ActivityLogger($das);
        
        if($das->updateUser($email, $userName, $password, $dob, $role)) {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function deleteUser($email) {
        $das = new UserDataAccessService();
        $das = new ActivityLogger($das);
        
        if($das->deleteUser($email)) {
            return true;
        }
        else {
            return false;
        }
    }
}
?>