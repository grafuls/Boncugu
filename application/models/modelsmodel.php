<?php

class ModelsModel
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
    public function getModels($brand=null, $brand_id=null, $top=null) {
        $sql = sprintf('SELECT * FROM vw_models ');
        if($brand!=null){
            $sql = $sql .sprintf('WHERE brand = "%s" ', $brand);
        }
        if($brand_id!=null){
            $sql = $sql .sprintf('WHERE brand_id = "%s" ', $brand_id);
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
     * Returns stored camera models by brand id
     */
    public function getModelName($model, $brand) {
        $sql = sprintf('SELECT * FROM vw_models ');
        $sql = $sql .sprintf('WHERE raw_model = "%s" ', $model);
        
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return str_replace($brand .' ', '', $query->fetch()->name);
    }
    
    /**
     * Returns stored camera models by brand id
     */
    public function getTopModels() {
        $sql = sprintf('SELECT c.id, c.name as brand, c.brand as raw_brand, sub_table.name, sub_table.camera as raw_model, sub_table.large_image_url FROM (SELECT brand_id, name, camera, large_image_url, @rn:=CASE WHEN @var_brand_id = brand_id THEN @rn + 1 ELSE 1 END AS rn, @var_brand_id:=brand_id FROM (SELECT @var_brand_id:=NULL, @rn:=NULL) vars, models WHERE brand_id IN (SELECT id FROM cameras)) as sub_table INNER JOIN cameras c on c.id=sub_table.brand_id WHERE rn <= 3 LIMIT 15');
        
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Storing new camera models
     * returns stored camera models
     */
    public function updateModels($models, $brand_id) {        
        $sql = 'INSERT INTO models(camera,name,megapixels,lcd_screen_size,memory_type,small_image_url,large_image_url,brand_id,last_updated) VALUES ';
        $count = count($models['cameras']['camera']);
        $i = 0;
        foreach ($models['cameras']['camera'] as $model) {
            $camera = mysql_real_escape_string($model["id"]);
            $name = mysql_real_escape_string($model["name"][_content]);
            $megapixels = mysql_real_escape_string($model["details"]["megapixels"][_content]);
            $lcd_screen_size = mysql_real_escape_string($model["details"]["lcd_screen_size"][_content]);
            $memory_type = mysql_real_escape_string($model["details"]["memory_type"][_content]);
            $small_image_url = mysql_real_escape_string($model['images']['small'][_content]);
            $large_image_url = mysql_real_escape_string($model['images']['large'][_content]);
            $last_updated = date('Y-m-d');

            $sql = $sql ."('$camera','$name','$megapixels','$lcd_screen_size','$memory_type','$small_image_url','$large_image_url','$brand_id','$last_updated')";
            if(++$i !== $count){
                $sql = $sql .",";
            }
        }
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
}
