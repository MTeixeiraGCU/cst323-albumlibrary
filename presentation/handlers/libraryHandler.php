<?php
/**
 * libraryHandler.php
 * This file is called by the library page to process the users email and retireve all of their albums to be displayed in an associative array '$albums', null if no albums exist.
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';

if(isset($_SESSION['UserEmail'])) {
    $bs = new AlbumBusinessService();
    $bs = new ActivityLogger($bs);
    
    $albums = $bs->getAlbums($_SESSION['UserEmail']);
    
} else { //return to main page
    header("Location: /index.php");
}