<?php

class FlickrModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }
    
    /**
     * Returns photos by model
     */
    public function getPhotosByModel($model,$page=null) {
        $search_params = array(
           'method' => 'flickr.photos.search',
           'camera' => $model,
           'per_page' => 25,
           'content_type' => 1,
           'safe_search' => 1,
           'page' => $page
        );

        $result = Flickr::makeCall($search_params);
        return unserialize($result);
    }
    
    /**
     * Returns photos by model
     */
    public function getPhotosByModelAndTag($model,$tag,$page=null) {
        $search_params = array(
           'method' => 'flickr.photos.search',
           'camera' => $model,
           'tags' => $tag,
           'per_page' => 25,
           'content_type' => 1,
           'safe_search' => 1,
           'page' => $page
        );

        $result = Flickr::makeCall($search_params);
        return unserialize($result);
    }
    
    /**
     * Returns photos by lense
     */
    public function getPhotosByLense($lense,$page=null) {
        $search_params = array(
           'method' => 'flickr.photos.search',
           'tags' => $lense,
           'per_page' => 25,
           'content_type' => 1,
           'safe_search' => 1,
           'page' => $page
        );

        $result = Flickr::makeCall($search_params);
        return unserialize($result);
    }
    
    /**
     * Returns photos by lense
     */
    public function getPhotosByLenseAndTag($lense,$tag,$page=null) {
        $search_params = array(
           'method' => 'flickr.photos.search',
           'tags' => $lense .'+' .$tag,
           'per_page' => 25,
           'content_type' => 1,
           'safe_search' => 1,
           'page' => $page
        );

        $result = Flickr::makeCall($search_params);
        return unserialize($result);
    }
    
    
    
    
    
}
