<?php

/**
 * searchResultHandler.php
 * This file is called by the search bar field to find matching tokens in the users library. An associative array of albums will be generated in '$albums', null if no albums exist
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';

if(isset($_SESSION['UserEmail']) || !isset($_GET['token'])) {
    $bs = new AlbumBusinessService();
    $bs = new ActivityLogger($bs);
    
    $albums = $bs->searchAlbums($_SESSION['UserEmail'],$_GET['token'],$_GET['token'],$_GET['token']);
    
} else { //return to main page
    header("Location: /index.php");
}

?>