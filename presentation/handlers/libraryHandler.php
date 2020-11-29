<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/businessServices/model/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/businessServices/model/Album.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/businessServices/AlbumBusinessService.php';


if(isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] === true) {
    $bs = new AlbumBusinessService();
    
    $albums = $bs->getAlbums($_SESSION['UserEmail']);
    
    include $_SERVER['DOCUMENT_ROOT'] . '/presentation/view/library.php';
    
} else { //return to main page
    header("Location: /index.php");
}