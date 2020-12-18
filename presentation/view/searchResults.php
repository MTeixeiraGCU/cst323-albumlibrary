<!-- 
    searchResults.php
    This is an HTML page that displays a list of found albums from the users library that match the entered token.
    searchResultsHandler.php must be called first in order to populate the array with albums.
 -->

<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/header.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/presentation/handlers/searchResultsHandler.php';
?>

<h1>Your Search Results</h1>
<!-- This section is going to need a handler that will return all database entries for albums and fill a card out for each.  -->

<?php 

if(is_null($albums)){
    echo "<h2>No search results found for that token!</h2>";
} else {
    foreach($albums as $album) {
?>
<div class="row" style="width: 100%; margin: auto;">

<?php 
    for($i = 0; $i < 1; $i++) {

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
        
        $album = next($albums);
        if(is_null($album)){
            break;
        }
    }
?>
</div>

<?php 
}
}
?>