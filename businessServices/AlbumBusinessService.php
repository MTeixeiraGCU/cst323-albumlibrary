<?php
/**
 * AlbumBusinessService.php
 * Description: This class is designed to handle business logic for album manipulation
 *
 * @author Marc Teixeira
 * Nov 27, 2020
 */


include_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';

/**
 * This class handles business logic transactions between the user and the database for Albums
 *
 */
class AlbumBusinessService {
    
    /**
     * This method returns the default list of albums from the database
     * @param string $email
     * @return array of albums
     */
    public function getAlbums($email) {
        return $this->searchAlbums($email);
    }
    
    /**
     * This method searchs in the users albums for any of the matching tokens
     * @param string $email
     * @param string $albumTitle default to empty string
     * @param string $description default to empty string
     * @param string $artist defualt to empty string
     * @return array of albums matching the search field
     */
    public function searchAlbums($email, $albumTitle = "", $description = "", $artist = "") {
        $das = new AlbumDataAccessService();
        $das = new ActivityLogger($das);
        
        return $das->getAlbums($email, $albumTitle, $description, $artist);
    }
    
    /**
     * This method sends data to the database to create a new album
     * @param string $email
     * @param string $albumTitle
     * @param string $postTime
     * @param string $description
     * @param integer $rating
     * @param string $artist
     * @param string $imgLink
     * @return boolean
     */
    public function createAlbum($email, $albumTitle, $postTime, $description, $rating, $artist, $imgLink) {
        $das = new AlbumDataAccessService();
        $das = new ActivityLogger($das);
        
        if($das->insertAlbum($email, $albumTitle, $postTime, $description, $rating, $artisit, $imgLink)){
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * This method updates an existing album with the provided data (REQUIRES ALBUM ID)
     * @param string $email
     * @param integer $id
     * @param string $albumTitle
     * @param string $postTime
     * @param string $description
     * @param integer $rating
     * @param string $artist
     * @param string $imgLink
     * @return boolean
     */
    public function updateAlbum($email, $id, $albumTitle, $postTime, $description, $rating, $artist, $imgLink) {
        $das = new AlbumDataAccessService();
        $das = new ActivityLogger($das);
        
        if($das->updateAlbum($email, $id, $albumTitle, $postTime, $description, $rating, $artisit, $imgLink)){
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * This method deletes an album from the database with the given ID
     * @param string $email
     * @param integer $id
     * @param string $albumTitle
     * @param string $postTime
     * @param string $description
     * @param integer $rating
     * @param string $artist
     * @param string $imgLink
     * @return boolean
     */
    public function deleteAlbum($email, $id, $albumTitle, $postTime, $description, $rating, $artist, $imgLink) {
        $das = new AlbumDataAccessService();
        $das = new ActivityLogger($das);
        
        if($das->deleteAlbum($email, $id, $albumTitle, $postTime, $description, $rating, $artisit, $imgLink)){
            return true;
        }
        else {
            return false;
        }
    }
}
    