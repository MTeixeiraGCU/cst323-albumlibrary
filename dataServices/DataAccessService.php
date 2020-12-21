<?php

/**
* DataAccessService.php
* Description: This class connects and gives access to a database
*
*/

class DataAccessService
{
    //properties
    private $dbServerName = "l0ebsc9jituxzmts.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    private $dbUsername = "czhtc2g92jdj2co4";
    private $dbPassword = "jxwne81lfyvrma4t";
    private $dbName = "fa8bcve3hdjavv78";
    
    //methods
    /**
     * This method grabs a connection to the database and returns it. Connection must be closed externally.
     * @return mysqli
     */
    public function getConnection() {
        
        $conn = new mysqli($this->dbServerName, $this->dbUsername, $this->dbPassword, $this->dbName);
        
        if($conn->connect_error) {
            ActivityLogger::error("Could not create connection to the database! Check the given connection strings!");
            die("Connection failed! " . $conn->connect_error . "<br>");
        }
        else {
            ActivityLogger::info("Connection to database was created!");
            return $conn;
        }
    }
}
