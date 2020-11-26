<?php

/**
 * UserDataAccessService.php
 * Description: handles all the data information for users
 *
 * @author Marc Teixeira
 * Nov 24, 2020
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/dataServices/DataAccessService.php';

class UserDataAccessService
{
    //methods
    public function getUser($email, $password) {
        
        $das = new DataAccessService();
        
        $conn = $das->getConnection();
        
        if($stmt = $conn->prepare("SELECT * FROM users WHERE EMAIL LIKE ? AND PASSWORD LIKE BINARY ?")) {
            
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
}