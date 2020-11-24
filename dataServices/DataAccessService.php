<?php

/**
* DataAccessService.php
* Description: This class connects and gives access to a database
*
* @author Marc Teixeira
* Nov 24, 2020
*/

class DataAccessService
{
    //properties
    private $dbServerName = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "root";
    private $dbName = "cst_323_project";
    
    //methods
    public function getConnection() {
        
        $conn = new mysqli($this->dbServerName, $this->dbUsername, $this->dbPassword, $this->dbName);
        
        if($conn->connect_error) {
            die("Connection failed! " . $conn->connect_error . "<br>");
        }
        else {
            return $conn;
        }
    }
}
