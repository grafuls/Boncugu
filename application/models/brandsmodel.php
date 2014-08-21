<?php

class BrandsModel
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
     * Get all camera brands from database
     */
    public function getAllBrands()
    {
        $sql = "SELECT * FROM vw_cameras";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    /**
     * Returns stored camera brands
     */
    public function getBrands($brand=null,$top=null) {
        $sql = sprintf('SELECT * FROM cameras ');
        if($brand!=null){
            $sql = $sql .sprintf('WHERE brand = "%s" ', $brand);
        }
        if($top!=null){
            $sql = $sql .sprintf('LIMIT %s', $top);
        }
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    /**
     * Storing new camera brands
     * returns stored camera brands
     */
    public function updateBrands($brands) {
        $this->truncateTable('cameras');
        
        $sql = 'INSERT INTO cameras(brand,name,last_updated) VALUES ';
        $count = count($brands['brands']['brand']);
        $i = 0;
        foreach ($brands['brands']['brand'] as $brand) {
            $id = $brand["id"];
            $name = $brand["name"];
            $last_updated = date('Y-m-d');
            $sql = $sql ."('$id','$name','$last_updated')";
            if(++$i !== $count){
                $sql = $sql .",";
            }
        }
        $query = $this->db->prepare($sql);
        $query->execute();
    }
    
    /**
     * Truncates a table
     * Returns result from mysql_query
     */
    public function truncateTable($table) {
        $result = mysql_query("TRUNCATE TABLE {$table};");
        //echo $result;
        if ($result){
            return $result;
        }
        else{
            echo mysql_errno() . ": " . mysql_error(). "\n";
            return false;
        }
    }

    ///**
    // * Add a song to database
    // * @param string $artist Artist
    // * @param string $track Track
    // * @param string $link Link
    // */
    //public function addSong($artist, $track, $link)
    //{
    //    // clean the input from javascript code for example
    //    $artist = strip_tags($artist);
    //    $track = strip_tags($track);
    //    $link = strip_tags($link);
    //
    //    $sql = "INSERT INTO song (artist, track, link) VALUES (:artist, :track, :link)";
    //    $query = $this->db->prepare($sql);
    //    $query->execute(array(':artist' => $artist, ':track' => $track, ':link' => $link));
    //}

    ///**
    // * Delete a song in the database
    // * Please note: this is just an example! In a real application you would not simply let everybody
    // * add/update/delete stuff!
    // * @param int $song_id Id of song
    // */
    //public function deleteSong($song_id)
    //{
    //    $sql = "DELETE FROM song WHERE id = :song_id";
    //    $query = $this->db->prepare($sql);
    //    $query->execute(array(':song_id' => $song_id));
    //}
}
