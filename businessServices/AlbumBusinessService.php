<?php
/**
 * AlbumBusinessService.php
 * Description: This class is designed to handle business logic for album manipulation
 *
 * @author Marc Teixeira
 * Nov 27, 2020
 */


include_once $_SERVER['DOCUMENT_ROOT'] . 'autoloader.php';

class AlbumBusinessService {
    
    public function __construct() {
        $this = new ActivityLogger($this);
    }
    
    public function getAlbums($email) {
        $das = new AlbumDataAccessService();
        
        return $das->getAlbums($email, "", "", "");
    }
    
    /**
     * This method searchs in the users albums for any of the matching tokens
     * @param string $email
     * @param string $albumTitle
     * @param string $postTime
     * @param string $description
     * @param string $artist
     */
    public function searchAlbums($email, $albumTitle = "", $description = "", $artist = "") {
        $das = new AlbumDataAccessService();
        
        return $das->getAlbums($email, $albumTitle, $description, $artist);
    }
    
    /**
     * This method sends data to the database to create a new album
     * @param unknown $email
     * @param unknown $albumTitle
     * @param unknown $postTime
     * @param unknown $description
     * @param unknown $rating
     * @param unknown $artist
     * @param unknown $imgLink
     * @return boolean
     */
    public function createAlbum($email, $albumTitle, $postTime, $description, $rating, $artist, $imgLink) {
        $das = new AlbumDataAccessService();
        
        if($das->insertAlbum($email, $albumTitle, $postTime, $description, $rating, $artisit, $imgLink)){
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * This method updates an existing album with the provided data (REQUIRES ALBUM ID)
     * @param unknown $email
     * @param unknown $id
     * @param unknown $albumTitle
     * @param unknown $postTime
     * @param unknown $description
     * @param unknown $rating
     * @param unknown $artist
     * @param unknown $imgLink
     * @return boolean
     */
    public function updateAlbum($email, $id, $albumTitle, $postTime, $description, $rating, $artist, $imgLink) {
        $das = new AlbumDataAccessService();
        
        if($das->updateAlbum($email, $id, $albumTitle, $postTime, $description, $rating, $artisit, $imgLink)){
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * This method deletes an album from the database with the given ID
     * @param unknown $email
     * @param unknown $id
     * @param unknown $albumTitle
     * @param unknown $postTime
     * @param unknown $description
     * @param unknown $rating
     * @param unknown $artist
     * @param unknown $imgLink
     * @return boolean
     */
    public function deleteAlbum($email, $id, $albumTitle, $postTime, $description, $rating, $artist, $imgLink) {
        $das = new AlbumDataAccessService();
        
        if($das->deleteAlbum($email, $id, $albumTitle, $postTime, $description, $rating, $artisit, $imgLink)){
            return true;
        }
        else {
            return false;
        }
    }
}
    