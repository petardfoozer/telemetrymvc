<?php

    /**
     * Base Controller loads the models and views
     */
    class Controller{
        
        /**
         * Loads the model
         */
        public function model(string $model){
            //require model file
            require_once '../app/models/' . $model . '.php';
            return new $model();
        }

        public function renderView(string $view, array $data = []){
            //check for the view file
            if(file_exists('../app/views/' . $view . '.php')){
                require_once '../app/views/' . $view . '.php';
            }
            else{
                //Can load 404 default file here, but die for now
                die('View does not exist');
            }
        }
    }
