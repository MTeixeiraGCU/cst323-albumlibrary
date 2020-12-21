<?php
/**
 * AlbumDataAccessService.php
 * Description: handles all the data information for albums
 *
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';

class AlbumDataAccessService {
    
    //CRUD methods
    
    //Retrieve
    /**
     * This method gets an array of all possible matching albums
     * @param string $email user email connected to this album
     * @param string $albumTitle token for album title search
     * @param string $description token for album description search
     * @param string $artist token for album artist name search
     * @return NULL|array
     */
    public function getAlbums($email, $albumTitle, $description, $artist) {
        
        $das = new DataAccessService();
        $das = new ActivityLogger($das);
        
        $conn = $das->getConnection();
        
        //adjust patterns to wildcards
        $albumTitlePattern = '%' . $albumTitle . '%';
        $descriptionPattern = '%' . $description . '%';
        $artistPattern = '%' . $artist . '%';
        
        if($stmt = $conn->prepare("SELECT * FROM `albums` WHERE USER_EMAIL LIKE ? AND (ALBUM_TITLE LIKE ? OR DESCRIPTION LIKE ? OR ARTIST LIKE ?)")) {
            
            $stmt->bind_param("ssss", $email, $artistPattern, $descriptionPattern, $artistPattern);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            
        } else {
            
            ActivityLogger::error("SQL error during query set up for getAlbums.");
            $conn->close();
            exit();
        }
        
        if(!$result) { //failed to find any albums
            ActivityLogger::warning("No albums were found that match those tokens!");
            $conn->close();
            return null;
        }
        else if($result->num_rows > 0) { //gather array of albums
            $albums = array();
            
            while($album = $result->fetch_assoc()) {
                array_push($albums, $album);
            }
            
            $conn->close();
            return $albums;
        }
    }
    
    //Create
    /**
     * This method adds a single album to the database.
     * @param string $email
     * @param string $albumTitle
     * @param string $postTime
     * @param string $description
     * @param integer $rating
     * @param string $artisit
     * @param string $imgLink
     * @return boolean
     */
    public function insertAlbum($email, $albumTitle, $postTime, $description, $rating, $artist, $imgLink) {
        $das = new DataAccessService();
        $das = new ActivityLogger($das);
        
        $conn = $das->getConnection();
        
        $query = "INSERT INTO `albums` (ALBUM_TITLE, POST_TIME, DESCRIPTION, RATING, ARTIST, IMG_LINK, USER_EMAIL) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('sssisss', $albumTitle, $postTime, $description, $rating, $artist, $imgLink, $email);
            $stmt->execute();
            $result = $stmt->affected_rows;
            $stmt->close();
        } else {           
            ActivityLogger::error("SQL error during query set up for insertAlbum.");
            $conn->close();
            exit();
        }
        
        if ($result > 0) { //successful entry
            $conn->close();
            return true;
        }
        else { //failed attempt to add album.
            ActivityLogger::warning("Could not insert new album!");
            $conn->close();
            return false;
        }
    }
    
    //Update
    /**
     * This method updates an album with new information. An album ID is required for this operation
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
        $das = new DataAccessService();
        $das = new ActivityLogger($das);
        
        $conn = $das->getConnection();
        
        $query = "UPDATE `albums` SET ALBUM_TITLE = ?, POST_TIME = ?, DESCRIPTION = ?, RATING = ?, ARTIST =  ?, IMG_LINK = ? WHERE USER_EMAIL = ? AND ID = ?";
        
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('sssisssi', $albumTitle, $postTime, $description, $rating, $artist, $imgLink, $email, $id);
            $stmt->execute();
            $result = $stmt->affected_rows;
            $stmt->close();
        } else {            
            ActivityLogger::error("SQL error during query set up for updateAlbum.");
            $conn->close();
            exit();
        }
        
        if ($result > 0) { //successful entry
            $conn->close();
            return true;
        }
        else { //failed attempt to update album.
            ActivityLogger::warning("Could not update album in database!");
            $conn->close();
            return false;
        }
    }
    
    //Delete
    /**
     * This mehtod deletes an album form the database. An album ID is required.
     * @param string $email
     * @param integer $id
     * @return boolean
     */
    public function deleteUser($email, $id) {
        $das = new DataAccessService();
        $das = new ActivityLogger($das);
        
        $conn = $das->getConnection();
        
        $query = "DELETE FROM `ablums` WHERE USER_EMAIL = ? AND ID = ?";
        
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('si', $email, $id);
            $stmt->execute();
            $result = $stmt->affected_rows;
            $stmt->close();
        } else {
            ActivityLogger::error("SQL error during query set up for deleteAlbum.");
            $conn->close();
            exit();
        }
        
        
        if ($result > 0) { //successful deletion
            $conn->close();
            return true;
        }
        else { //failed attempt to delete album.
            ActivityLogger::warning("Could not delete album from database!");
            $conn->close();
            return false;
        }
    }
    
}