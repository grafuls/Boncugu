<?php

class LensesModel
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
     * Returns stored camera models by brand id
     */
    public function getLenses($lense=null, $top=null) {
        $sql = sprintf('SELECT * FROM lenses ');
        if($lense!=null){
            $sql = $sql .sprintf('WHERE name = "%s" ', $lense);
        }
        if($top!=null){
            $sql = $sql .sprintf('LIMIT %s', $top);
        }
        $sql = $sql .sprintf('ORDER BY COUNT DESC ');
        $sql = $sql .sprintf('LIMIT 250');
        //echo $sql;
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
}
