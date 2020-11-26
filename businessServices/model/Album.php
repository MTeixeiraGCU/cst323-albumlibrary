<?php
namespace businessServices\model;

/**
 * Album.php
 * Description: This class is designed to hold information on a single music album
 *
 */
class Album
{
    //properties
    private $albumTitle;
    private $postTime;
    private $description;
    private $rating;
    private $artist;
    private $imgLink;

    //constructor
    public function __construct($albumTitle, $postTime, $description, $rating, $artist, $imgLink)
    {
        $this->albumTitle = $albumTitle;
        $this->postTime = $postTime;
        $this->description = $description;
        $this->rating = $rating;
        $this->artist = $artist;
        $this->imgLink = $imgLink;
    }
    
    //getters / setters
    /**
     * @return mixed
     */
    public function getAlbumTitle()
    {
        return $this->albumTitle;
    }
    
    /**
     * @return mixed
     */
    public function getPostTime()
    {
        return $this->postTime;
    }
    
    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }
    
    /**
     * @return mixed
     */
    public function getArtist()
    {
        return $this->artist;
    }
    
    /**
     * @return mixed
     */
    public function getImgLink()
    {
        return $this->imgLink;
    }
    
    /**
     * @param mixed $albumTitle
     */
    public function setAlbumTitle($albumTitle)
    {
        $this->albumTitle = $albumTitle;
    }
    
    /**
     * @param mixed $postTime
     */
    public function setPostTime($postTime)
    {
        $this->postTime = $postTime;
    }
    
    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }
    
    /**
     * @param mixed $artist
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
    }
    
    /**
     * @param mixed $artist
     */
    public function setImgLink($imgLink)
    {
        $this->imgLink = $imgLink;
    }
    
    
}

?>

