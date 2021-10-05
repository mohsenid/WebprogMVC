<?php
/*
* Basic Controller
* Loads the models & views
*/

class Controller{

    // Load model
    public function model($model){
        
        // Require model file
        require_once '../App/Models/' . $model . '.php';

        // Init model file
        return new $model;
    }

    // Load view
    public function view($view, $data = []){

        // Check for view file
        if(file_exists('../App/views/' . $view . '.php')){
            // Load view file
            require_once '../App/views/' . $view . '.php';
        }else{
            // View does not exist
            die('View does not exist');
        }
    }
}