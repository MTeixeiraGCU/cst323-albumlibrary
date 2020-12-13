<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';

if(isset($_SESSION['UserEmail'])) {
    $bs = new AlbumBusinessService();
    $bs = new ActivityLogger($bs);
    
    $albums = $bs->getAlbums($_SESSION['UserEmail']);
    
} else { //return to main page
    header("Location: /index.php");
}