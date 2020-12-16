<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/header.php';

//check each of the required fields and populate thier error message as necessary.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['UserEmail'])) {
    
    $albumName = "";
    $artist = "";
    $postDate = "";
    $rating = 0;
    $description = "";
    $img_name = "";
    
    
    if(isset($_POST['albumName'])) {
        $albumName = $_POST['albumName'];
    }
    
    if(isset($_POST['artist'])) {
        $artist = $_POST['artist'];
    }
    
    if(isset($_POST['postDate'])) {
        $postDate = $_POST['postDate'];
    }
    
    if(isset($_POST['rating'])) {
        $rating = $_POST['rating'];
    }
    
    if(isset($_POST['description'])) {
        $description = $_POST['description'];
    }
    
    //check for image properties
    if(isset($_FILES['img_file'])) {
    
        ActivityLogger::info("Setting up image upload!");
        
        $dir = $_SERVER['DOCUMENT_ROOT'] . "/presentation/media/";
        $img_name = $_FILES["img_file"]["name"];
        $target_file = $dir . basename($img_name);
        $ready = true;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["img_file"]["tmp_name"]);
        if($check == false) {
            ActivityLogger::error("Could not upload img file! File: " . $img_name);
            $img_name = "noimage.png";
            $ready = false;
        }
            
        // Check if file already exists
        if (file_exists($target_file) && $ready) {
            ActivtyLogger::warning("File already exists! File: " . $img_name);
            $ready = false;
        }
        
        // Check file size
        if ($_FILES["img_file"]["size"] > 500000 && $ready) {
            ActivityLogger::error("File size is too big, default to noimage! File: " . $img_name);
            $img_name = "noimage.png";
            $ready = false;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $ready) {
                ActivityLogger::error("File type is not supported, default to noimage! File: " . $img_name);
                $img_name = "noimage.png";
                $ready = false;
        }
            
        // Check if we are ready to upload the file
        if ($ready) {
            ActivityLogger::info("Attempting to add image to server!");
            if (move_uploaded_file($_FILES["img_file"]["tmp_name"], $target_file)) {
                ActivityLogger::info("Image file has been uploaded! File: " . $img_name);
            } else {
                ActivityLogger::error("Image file could not be uploaded! File: " . $img_name);
                $img_name = "noimage.png";
            }
        }
 
    } else {
        ActivityLogger::warning("Could not upload image!");
    }
    
    $album = new Album($albumName, $postDate, $description, $rating, $artist, $img_name);
    $album = new ActivityLogger($album);
    
    //add album to the users library
    $bs = new AlbumBusinessService();
    $bs = new ActivityLogger($bs);
    
    $bs->createAlbum($_SESSION['UserEmail'], $album->getAlbumTitle(), $album->getPostTime(), $album->getDescription(), $album->getRating(), $album->getartist(), $album->getImgLink());
    
} 
    
header("Location: /presentation/view/albumAdded.php?AlbumName=" . $album->getAlbumTitle());

?>