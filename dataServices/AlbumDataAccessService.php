<?php
/**
 * AlbumDataAccessService.php
 * Description: handles all the data information for albums
 *
 * @author Marc Teixeira
 * Nov 27, 2020
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/dataServices/DataAccessService.php';

class AlbumDataAccessService {
    
    //CRUD methods
    public function getAlbums($email) {
        
        $das = new DataAccessService();
        
        $conn = $das->getConnection();
        
        if($stmt = $conn->prepare("SELECT * FROM `albums` WHERE USER_EMAIL LIKE ?")) {
            
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            
        } else {
            
            echo "SQL error during query set up for getUser.";
            $conn->close();
            exit();
        }
        
        if(!$result) { //failed to find any albums
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
    
    public function insertAlbum($email, $albumTitle, $postTime, $description, $rating, $artisit, $imgLink) {
        $das = new DataAccessService();
        
        $conn = $das->getConnection();
        
        $query = "INSERT INTO `albums` (ALBUM_TITLE, POST_TIME, DESCRIPTION, RATING, ARTIST, IMG_LINK, USER_EMAIL) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('sssssss', $albumTitle, $postTime, $description, $rating, $artist, $imgLink, $email);
            $stmt->execute();
            $result = $stmt->affected_rows;
            $stmt->close();
        }
        if ($result > 0) { //successful entry
            $conn->close();
            return true;
        }
        else { //failed attempt to register.
            $conn->close();
            return false;
        }
    }
    
    public function updateAlbum($email, $id, $albumTitle, $postTime, $description, $rating, $artist, $imgLink) {
        $das = new DataAccessService();
        
        $conn = $das->getConnection();
        
        $query = "UPDATE `albums` SET ALBUM_TITLE = ?, POST_TIME = ?, DESCRIPTION = ?, RATING = ?, ARTIST =  ?, IMG_LINK = ? WHERE USER_EMAIL = ? AND ID = ?";
        
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('sssssssi', $albumTitle, $postTime, $description, $rating, $artist, $imgLink, $email, $id);
            $stmt->execute();
            $result = $stmt->affected_rows;
            $stmt->close();
        }
        if ($result > 0) { //successful entry
            $conn->close();
            return true;
        }
        else { //failed attempt to register.
            $conn->close();
            return false;
        }
    }
    
    public function deleteUser($email, $id) {
        $das = new DataAccessService();
        
        $conn = $das->getConnection();
        
        $query = "DELETE FROM `ablums` WHERE USER_EMAIL = ? AND ID = ?";
        
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('si', $email, $id);
            $stmt->execute();
            $result = $stmt->affected_rows;
            $stmt->close();
        }
        if ($result > 0) { //successful entry
            $conn->close();
            return true;
        }
        else { //failed attempt to register.
            $conn->close();
            return false;
        }
    }
    
}