<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/businessServices/model/User.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/businessServices/UserBusinessService.php';

// define error message variables and set to empty values
$userNameRegErr = $passwordRegErr = $password2RegErr = $emailRegErr = "";
$regMessageErr = "* required fields";


//check each of the required fields and populate thier error message as necessary.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $user = new User($_POST["userName"], $_POST["password1"], $_POST["email"], "", "");
    $password2 = $_POST["password2"];
    
    $ready = true;
    
    if (empty($user->getUserName())) {
        $userNameRegErr = "User Name is required!";
        $ready = false;
    } elseif (preg_match('/\s/', $user->getUserName())) {
        $userNameRegErr = "User Name cannot contain spaces!";
        $ready = false;
    }
    
    if(empty($user->getPassword())) {
        $passwordRegErr = "Password is a required field!";
        $ready = false;
    } /*elseif (!preg_match('#[a-zA-Z]+#', $user->getPassword()) || !preg_match('#[0-9]+#', $user->getPassword()) || strlen($user->getPassword()) < 8) {       //password constraints
        $passwordRegErr = "Password must be 8 characters long and contain atleast one number!";
        $ready = false;
    }*/
    
    if(empty($password2)) {
        $password2RegErr = "You must reenter your password!";
        $ready = false;
    } elseif($user->getPassword() != $password2) {
        $password2RegErr = "Your passwords do not match!";
        $ready = false;
    }
    
    if(empty($user->getEmail())){
        $emailRegErr = "You must enter an email to register!";
        $ready = false;
    }
    
    if($ready) {
        $bs = new UserBusinessService();
        
        //check for a duplicate user
        
        if($bs->registerUser($user->getEmail(), $user->getUserName(), $user->getPassword(), $user->getDob(), $user->getRole())) { //successful check of registration
            $_SESSION["User"] = $user;
            header('Location: /presentation/view/registrationComplete.php');
        }
        else {  //user already exists
            $regMessageErr = "There was a problem during registration.";
            include $_SERVER['DOCUMENT_ROOT'] . '/presentation/view/registration.php';
            exit();
        }
    }
    else { //not ready to move to next form
        include $_SERVER['DOCUMENT_ROOT'] . '/presentation/view/registration.php';
    }
}
?>