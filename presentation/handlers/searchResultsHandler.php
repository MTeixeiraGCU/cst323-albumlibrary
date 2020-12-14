<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';

if(isset($_SESSION['UserEmail']) || !isset($_GET['token'])) {
    $bs = new AlbumBusinessService();
    $bs = new ActivityLogger($bs);
    
    $albums = $bs->searchAlbums($_SESSION['UserEmail'],$_GET['token'],$_GET['token'],$_GET['token']);
    
} else { //return to main page
    header("Location: /index.php");
}

?>