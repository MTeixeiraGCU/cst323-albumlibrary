<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/CST-323-CLC-Project/businessServices/model/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/CST-323-CLC-Project/businessServices/model/Album.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/CST-323-CLC-Project/businessServices/AlbumBusinessService.php';

if(isset($_SESSION['UserEmail'])) {
    $bs = new AlbumBusinessService();
    
    $albums = $bs->getAlbums($_SESSION['UserEmail']);
    
} else { //return to main page
    header("Location: /CST-323-CLC-Project/index.php");
}