<?php

/**
* DataAccessService.php
* Description: This class connects and gives access to a database
*
*/

class DataAccessService
{
    //properties
    private $dbServerName;
    private $dbUsername;
    private $dbPassword;
    private $dbName;
    
    //constructor
    public function __construct(){
        $this->dbServerName = getenv('DB_SERVER');
        $this->dbUsername = getenv('DB_USER_NAME');
        $this->dbPassword = getenv('DB_PASSWORD');
        $this->dbName = getenv('DB_NAME');
    }
    
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
