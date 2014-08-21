<?php
    include('../flickr_api/flickr.php');    

    // include db handler
    require_once '../include/DB_Functions.php';
    $db = new DB_Functions();

    $params = array(
       'method' => 'flickr.cameras.getBrands'
    );
    
    $result = Flickr::makeCall($params);
    $brands = unserialize($result);
    
    $cameras = $db->updateBrands($brands);
    if(!$cameras){
        echo "Camera brands update is fucked up!<br>";
    }
    else{
        echo "Camera brands updated correctly!<br>";
    }
    
    //update models table
    $brands = $db->getBrands();
    $db->truncateTable('models');
    
    while($row = mysql_fetch_array($brands)) {

        $params = array(
           'method' => 'flickr.cameras.getBrandModels',
           'brand' => $row['brand']
        );

        $result = Flickr::makeCall($params);
        //echo $result;
        $result = unserialize($result);

        $models = $db->updateModels($result, $row['id']);
        if(!$models){
            echo 'Model update failed for brand: ' .$row['name'] .'<br>';
        }
        else{
            echo 'Model update completed for brand: ' .$row['name'] .'<br>';
        }
    }

?>