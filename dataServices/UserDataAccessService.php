<?php

/**
 * UserDataAccessService.php
 * Description: handles all the data information for users
 *
 * @author Marc Teixeira
 * Nov 24, 2020
 */

class UserDataAccessService
{
    //methods
    public function getUser($userName, $password) {
        
        $das = new DataAccessService();
        
        $conn = $das->getConnection();
        
        if($stmt = $conn->prepare("SELECT * FROM users WHERE USERNAME LIKE ? AND PASSWORD LIKE BINARY ?")) {
            
            $stmt->bind_param("ss", $userName, $password);
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
            return -1;
        }
        else if($result->num_rows == 1) {
            $conn->close();
            return $result->fetch_assoc()["ID"];
        }
        else {
            $conn->close();
            return -1;
        }
    }
}