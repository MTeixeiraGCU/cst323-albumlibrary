<?php

/**
 * UserBusinessService.php
 * Description: This class is designed to handle business logic for users and user logins
 * 
 * @author Marc Teixeira
 * Nov 24, 2020
 */


include_once $_SERVER['DOCUMENT_ROOT'] . '/dataServices/UserDataAccessService.php';

class UserBusinessService {
    
    public function loginUser($email, $password) {
        $das = new UserDataAccessService();
        
        $id = $das->getUser($email, $password);
        return $id;
    }
    
}
?>