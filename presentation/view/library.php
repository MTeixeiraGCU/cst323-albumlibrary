<!-- 
    library.php
    This file is an HTML page that acts as a users home page displaying all of thier albums. 
    libraryHandler.php must be called first in order to populate an array of albums for the page to be displayed.
 -->

<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/header.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/presentation/handlers/libraryHandler.php';
?>

<h1>Your Library</h1>
<!-- This section is going to need a handler that will return all database entries for albums and fill a card out for each.  -->

<?php 
if(is_null($albums)) {
    echo "<h2>Your library is empty add a new album <a href='/presentation/view/createNewAlbum.php'>HERE</a>!</h2>";
} else {
    $album = current($albums);
    for($i = 0;$i < (count($albums) / 3);$i++) {
?>
<div class="row" style="width: 100%; margin: auto;">

<?php 
        for($j = 0; $j < 3; $j++) {
    
            echo "<div class='card' style='width: 18rem; margin: auto;'>";
            echo "  <img src='/presentation/media/" . $album['IMG_LINK'] . "' class='card-img-top' alt='...'>";
            echo "  <div class='card-body'>";
            echo "      <h5 class='card-title'>" . $album['ALBUM_TITLE'] . "</h5>";
            echo "      <p class='card-text'>Release Date: " . $album['POST_TIME'] . "</p>";
            echo "      <p class='card-text'>Artist: " . $album['ARTIST'] . "</p>";
            echo "      <p class='card-text'>Rating: " . $album['RATING'] . "/5</p>";
            echo "      <p class='card-text'>Description: " . $album['DESCRIPTION'] . "</p>";
            echo "      <!-- <a href='#' class='btn btn-primary'>Go somewhere</a> -->";
            echo "  </div>";
            echo "</div>";
            
            if($album = next($albums)){
                break;
            }
        }
?>
</div>

<?php 
    }
}
?>