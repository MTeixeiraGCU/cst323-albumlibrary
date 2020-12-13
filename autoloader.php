<?php

spl_autoload_register(function($class){

    // get the difference in folders between location of autoloader and the file that callled it
    $lastDirectories = substr(getcwd(), strlen(__DIR__));

    // echo "getcwd = : " . getcwd() . "<br>";
    // echo "__DIR__ = : " . __DIR__ . "<br>";
    // echo "lastdirectories = : " . $lastDirectories . "<br>";

    // count number of slashes (folder depth)
    $numberOfLastDirectories = substr_count($lastDirectories, '/');

    // echo "number of directories different : " . $numberOfLastDirectories . "<br>";

    // list of possible locations that classes are found in this project
    $directories = ['businessServices', 'businessServices/model', 'dataServices', 'presentation', 'presentation/handlers', 'presentation/view', 'presentation/media', 'presentation/css', 'utility', ];

    foreach($directories as $d){
        $currentDirectory = $d;
        for ($x = 0; $x < $numberOfLastDirectories; $x++){
            $currentDirectory = "../" . $currentDirectory;
        }
        $classfile = $currentDirectory . '/' . $class . '.php';

        if(is_readable($classfile)){
            if(require $d . '/' . $class . '.php'){
                break;
            }
        }
    }

});
