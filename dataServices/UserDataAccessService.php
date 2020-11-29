<?php

/**
 * UserDataAccessService.php
 * Description: handles all the data information for users
 *
 * @author Marc Teixeira
 * Nov 24, 2020
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/CST-323-CLC-Project/dataServices/DataAccessService.php';

class UserDataAccessService
{
    //CRUD methods
    public function getUser($email, $password) {
        
        $das = new DataAccessService();
        
        $conn = $das->getConnection();
        
        if($stmt = $conn->prepare("SELECT * FROM `users` WHERE EMAIL LIKE ? AND PASSWORD LIKE BINARY ?")) {
            
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            
        } else {
            
            echo "SQL error during query set up for getUser.";
            $conn->close();
            exit();
        }
        
        if(!$result) {
            $conn->close();
            return null;
        }
        else if($result->num_rows == 1) {
            $conn->close();
            return $result->fetch_assoc();
        }
        else {
            $conn->close();
            return null;
        }
    }
    
    public function insertUser($email, $userName, $password, $dob, $role) {
        $das = new DataAccessService();
        
        $conn = $das->getConnection();
        
        $query = "INSERT INTO `users` (EMAIL, USERNAME, PASSWORD, DOB, ROLE) VALUES (?, ?, ?, ?, ?)";
        
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('sssss', $email, $userName, $password, $dob, $role);
            $stmt->execute();
            $result = $stmt->affected_rows;
            $stmt->close();
        }
        if ($result > 0) { //successful entry
            $conn->close();
            return true;
        }
        else { //failed attempt to register.
            $conn->close();
            return false;
        }
    }
    
    public function updateUser($email, $userName, $password, $dob, $role) {
        $das = new DataAccessService();
        
        $conn = $das->getConnection();
        
        $query = "UPDATE `users` SET USERNAME = ?, PASSWORD = ?, DOB = ?, ROLE = ? WHERE EMAIL = ?";
        
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('sssss', $email, $userName, $password, $dob, $role);
            $stmt->execute();
            $result = $stmt->affected_rows;
            $stmt->close();
        }
        if ($result > 0) { //successful entry
            $conn->close();
            return true;
        }
        else { //failed attempt to register.
            $conn->close();
            return false;
        }
    }
    
    public function deleteUser($email) {
        $das = new DataAccessService();
        
        $conn = $das->getConnection();
        
        $query = "DELETE FROM `users` WHERE EMAIL = ?";
        
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->affected_rows;
            $stmt->close();
        }
        if ($result > 0) { //successful entry
            $conn->close();
            return true;
        }
        else { //failed attempt to register.
            $conn->close();
            return false;
        }
    }
}