<?php

/**
 * Class Brand
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Brand extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index($brand)
    {
        // if we have GET data to search for models
        if (isset($brand)) {
            // load model, perform an action on the model
            $models_model = $this->loadModel('ModelsModel');
            $models = $models_model->getModels($brand);
        }

        // echo 'Message from Controller: You are in the controller home, using the method index()';
        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/_templates/header.php';
        require 'application/views/brand/index.php';
        require 'application/views/_templates/footer.php';
    }
}
