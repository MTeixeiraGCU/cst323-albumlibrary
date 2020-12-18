<?php

/**
* DataAccessService.php
* Description: This class connects and gives access to a database
*
*/

class DataAccessService
{
    //properties
    private $dbServerName = "dno6xji1n8fm828n.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    private $dbUsername = "jbckpw5uh2ugr3bz";
    private $dbPassword = "i72m1gq2g5s60at1";
    private $dbName = "lxnp1v0ujxnefmlg";
    
    //methods
    /**
     * This method grabs a connection to the database and returns it. Connection must be closed externally.
     * @return mysqli
     */
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
