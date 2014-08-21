<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Model extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index($brand, $model)
    {
        if (isset($brand)) {
            $camera = $brand;
        }
        if (isset($model)) {
            $camera = $camera .'/' .$model;
            $models_model = $this->loadModel('ModelsModel');
            $model_name = $models_model->getModelName($model, $brand);
        }

        // if we have GET data to search for models
        if (isset($camera)) {
            // load model, perform an action on the model
            $flickr_model = $this->loadModel('FlickrModel');
            $photos = $flickr_model->getPhotosByModel($camera);
        }

        // debug message to show where you are, just for the demo
        // echo 'Message from Controller: You are in the controller home, using the method index()';
        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/_templates/header.php';
        require 'application/views/model/index.php';
        require 'application/views/_templates/footer.php';
    }
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function search($brand, $model, $tags)
    {
        if (isset($brand)) {
            $camera = $brand;
        }
        if (isset($model)) {
            $camera = $camera .'/' .$model;
            $models_model = $this->loadModel('ModelsModel');
            $model_name = $models_model->getModelName($model, $brand);
        }

        // if we have GET data to search for models
        if (isset($camera)) {
            // load model, perform an action on the model
            $flickr_model = $this->loadModel('FlickrModel');
            $photos = $flickr_model->getPhotosByModelAndTag($camera,$tags);
        }

        // debug message to show where you are, just for the demo
        // echo 'Message from Controller: You are in the controller home, using the method search()';
        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/_templates/header.php';
        require 'application/views/model/index.php';
        require 'application/views/_templates/footer.php';
    }
}
