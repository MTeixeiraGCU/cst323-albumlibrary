<?php

/**
 * UserBusinessService.php
 * Description: This class is designed to handle business logic for users and user logins
 * 
 * @author Marc Teixeira
 * Nov 24, 2020
 */

class UserBusinessService {
    
    public function loginUser($userName, $password) {
        $das = new UserDataAccessService();
        
        $id = $das->getUser($userName, $password);
        return $id;
    }
    
}
?>