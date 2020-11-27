<?php
/**
 * AlbumBusinessService.php
 * Description: This class is designed to handle business logic for album manipulation
 *
 * @author Marc Teixeira
 * Nov 27, 2020
 */


include_once $_SERVER['DOCUMENT_ROOT'] . '/dataServices/AlbumDataAccessService.php';

class AlbumBusinessService {
    
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
    
    public function createAlbum($email, $albumTitle, $postTime, $description, $rating, $artist, $imgLink) {
        $das = new AlbumDataAccessService();
        
        if($das->insertAlbum($email, $albumTitle, $postTime, $description, $rating, $artisit, $imgLink)){
            return true;
        }
        else {
            return false;
        }
    }
    
    //REQUIRES ALBUM ID NUMBER
    public function updateAlbum($email, $id, $albumTitle, $postTime, $description, $rating, $artist, $imgLink) {
        $das = new AlbumDataAccessService();
        
        if($das->updateAlbum($email, $id, $albumTitle, $postTime, $description, $rating, $artisit, $imgLink)){
            return true;
        }
        else {
            return false;
        }
    }
    
    //REQUIRES ALBUM ID NUMBER
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
    