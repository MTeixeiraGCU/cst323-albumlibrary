<?php

/**
 * UserBusinessService.php
 * Description: This class is designed to handle business logic for users and user logins
 * 
 * @author Marc Teixeira
 * Nov 24, 2020
 */


include_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';

/**
 * This class handle business logic for user accounts such as registration, login, and authentication
 *
 */
class UserBusinessService {
    
    /**
     * This method checks the users login information
     * @param string $email
     * @param string $password
     * @return string (email) a returned empty string indicates a failed login
     */
    public function loginUser($email, $password) {
        $das = new UserDataAccessService();
        $das = new ActivityLogger($das);
        
        $email = $das->getUser($email, $password);
        return $email;
    }
    
    /**
     * This method registers a new user
     * @param string $email
     * @param string $userName
     * @param string $password
     * @param string $dob
     * @param string $role
     * @return boolean return true if the user was added to the database
     */
    public function registerUser($email, $userName, $password, $dob, $role) {
        $das = new UserDataAccessService();

        ActivityLogger::warning("registerUser method pre-insert!");
   
        $results = $das->insertUser($email, $userName, $password, $dob, $role);
        
        ActivityLogger::warning("registerUser method post-insert : results : " . $results . "!");
        
        return $results;
    }
    
    /**
     * This method updates a user information on the database
     * @param string $email
     * @param string $userName
     * @param string $password
     * @param string $dob
     * @param string $role
     * @return boolean returns true if the user was updated
     */
    public function updateUser($email, $userName, $password, $dob, $role) {
        $das = new UserDataAccessService();
        $das = new ActivityLogger($das);
        
        if($das->updateUser($email, $userName, $password, $dob, $role)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * This method removes a user from the database
     * @param string $email
     * @return boolean returns true if the removal was successful
     */
    public function deleteUser($email) {
        $das = new UserDataAccessService();
        $das = new ActivityLogger($das);
        
        if($das->deleteUser($email)) {
            return true;
        } else {
            return false;
        }
    }
}
?>