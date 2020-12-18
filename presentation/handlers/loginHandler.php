<?php

/**
 * loginHandler.php
 * This file is called by the login page after the users attempts to login. It checks their credientials and populates any error fields based on what the user entered.
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';
    
    // define error message variables and set to empty values for use on form
    $userNameErr = $passwordErr = "";
    $loginMessageErr = "";
    
    //check each of the required fields and populate thier error message as necessary.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $ready = true; //we have been through the form at least once and need to populate it with values

        $user = new User("", $_POST["password"], $_POST["email"], "", "");
        $user = new ActivityLogger($user);

        if (empty($user->getEmail())) {
            $userNameErr = "* Email is required!";
            $ready = false;
        }

        if(empty($user->getPassword())) {
            $passwordErr = "* Password is a required field!";
            $ready = false;
        }

        if($ready) {   //ready to attempt another login
            
            session_start();
            
            $bs = new UserBusinessService();
            $bs = new ActivityLogger($bs);

            $loggedUser = $bs->loginUser($user->getEmail(), $user->getPassword());
            
            if(!is_null($loggedUser)) {  //successful login
                $_SESSION['UserEmail'] = $user->getEmail();
                $_SESSION['LoggedIn'] = true;
                
                ActivityLogger::info("Successful login for : " . $_SESSION['UserEmail']);
                
                header("Location: /presentation/view/library.php");
            } 
            else {          //failed login
                $loginMessageErr = "The email or password is incorrect. Please try again.";
                
                ActivityLogger::warning("Could not authenticate user!");
                
                include $_SERVER['DOCUMENT_ROOT'] . '/index.php';
                exit();
            }
                          
        }  
        else { //not ready
            $loginMessageErr = "";
            
            ActivityLogger::warning("Invalid stat was entered in the login fields!");
            
            include $_SERVER['DOCUMENT_ROOT'] . '/index.php';
        }
    }
?>