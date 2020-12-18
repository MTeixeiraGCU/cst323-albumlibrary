<?php

/**
 * UserDataAccessService.php
 * Description: handles all the data information for users
 *
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';

class UserDataAccessService
{
    //CRUD methods
    
    //Retrieve
    /**
     * This method grabs a single user for the database with the matching credientials
     * @param String $email
     * @param String $password
     * @return NULL|unknown
     */
    public function getUser($email, $password) {
        
        $das = new DataAccessService();
        $das = new ActivityLogger($das);
        
        $conn = $das->getConnection();
        
        if($stmt = $conn->prepare("SELECT * FROM `users` WHERE EMAIL LIKE ? AND PASSWORD LIKE BINARY ?")) {            
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();            
        } else {            
            ActivityLogger::error("SQL error during query set up for getUser.");
            $conn->close();
            exit();
        }
        
        if(!$result) { // failed retrieveing user
            ActivityLogger::error("Could not add new user to database!");
            $conn->close();
            return null;
        }
        else if($result->num_rows == 1) {
            $conn->close();
            return $result->fetch_assoc();
        }
        else {
            ActivityLogger::warning("Mulitple entires found in database occured!");
            $conn->close();
            return null;
        }
    }
    
    //Create
    /**
     * This method adds a single user to the database
     * @param String $email
     * @param String $userName
     * @param String $password
     * @param String $dob
     * @param String $role
     * @return boolean
     */
    public function insertUser($email, $userName, $password, $dob, $role) {
        $das = new DataAccessService();
        $das = new ActivityLogger($das);
        
        $conn = $das->getConnection();
        
        $query = "INSERT INTO `users` (EMAIL, USERNAME, PASSWORD, DOB, ROLE) VALUES (?, ?, ?, ?, ?)";
        
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('sssss', $email, $userName, $password, $dob, $role);
            $stmt->execute();
            $result = $stmt->affected_rows;
            $stmt->close();
        } else {
            ActivityLogger::error("SQL error during query set up for insertUser.");
            $conn->close();
            exit();
        }
        
        if ($result > 0) { //successful entry
            $conn->close();
            return true;
        }
        else { //failed attempt to register.
            ActivityLogger::warning("From UserDataAccessService::insertUser : no user was added to the database. affected_rows = " . $result . "!");
            $conn->close();
            return false;
        }
    }
    
    //Update
    /**
     * This method updates a users information on the database
     * @param String $email
     * @param String $userName
     * @param String $password
     * @param String $dob
     * @param String $role
     * @return boolean
     */
    public function updateUser($email, $userName, $password, $dob, $role) {
        $das = new DataAccessService();
        $das = new ActivityLogger($das);
        
        $conn = $das->getConnection();
        
        $query = "UPDATE `users` SET USERNAME = ?, PASSWORD = ?, DOB = ?, ROLE = ? WHERE EMAIL = ?";
        
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('sssss', $email, $userName, $password, $dob, $role);
            $stmt->execute();
            $result = $stmt->affected_rows;
            $stmt->close();
        } else {
            ActivityLogger::error("SQL error during query set up for updateUser.");
            $conn->close();
            exit();
        }
        
        if ($result > 0) { //successful entry
            $conn->close();
            return true;
        }
        else { //failed attempt to update user.
            ActivityLogger::warning("Could not update user information into database!");
            $conn->close();
            return false;
        }
    }
    
    //Delete
    /**
     * This method removes a single user and thier albums form the database
     * @param String $email
     * @return boolean
     */
    public function deleteUser($email) {
        $das = new DataAccessService();
        $das = new ActivityLogger($das);
        
        $conn = $das->getConnection();
        
        $query = "DELETE FROM `users` WHERE EMAIL = ?";
        
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->affected_rows;
            $stmt->close();
        } else {
            ActivityLogger::error("SQL error during query set up for deleteUser.");
            $conn->close();
            exit();
        }
        
        if ($result > 0) { //successful deletion
            $conn->close();
            return true;
        }
        else { //failed attempt to delete user.
            ActivityLogger::warning("Could not delete user from database!");
            $conn->close();
            return false;
        }
    }
}