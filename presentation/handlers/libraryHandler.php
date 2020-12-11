<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/businessServices/model/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/businessServices/model/Album.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/businessServices/AlbumBusinessService.php';

if(isset($_SESSION['UserEmail'])) {
    $bs = new AlbumBusinessService();
    
    $albums = $bs->getAlbums($_SESSION['UserEmail']);
    
} else { //return to main page
    header("Location: /index.php");
}