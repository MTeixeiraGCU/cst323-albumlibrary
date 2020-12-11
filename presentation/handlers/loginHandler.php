<!--

-->

<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/businessServices/model/User.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/businessServices/UserBusinessService.php';
    
    // define error message variables and set to empty values for use on form
    $userNameErr = $passwordErr = "";
    $loginMessageErr = "";
    
    //check each of the required fields and populate thier error message as necessary.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $ready = true; //we have been through the form at least once and need to populate it with values

        $user = new User("", $_POST["password"], $_POST["email"], "", "");

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

            $loggedUser = $bs->loginUser($user->getEmail(), $user->getPassword());
            
            if(!is_null($loggedUser)) {  //successful login
                $_SESSION['UserEmail'] = $user->getEmail();
                $_SESSION['LoggedIn'] = true;
                header("Location: /presentation/view/library.php");
            } 
            else {          //failed login
                $loginMessageErr = "The email or password is incorrect. Please try again.";
                include $_SERVER['DOCUMENT_ROOT'] . '/index.php';
                exit();
            }
                          
        }  
        else { //not ready
            $loginMessageErr = "";
            include $_SERVER['DOCUMENT_ROOT'] . '/index.php';
        }
    }
?>