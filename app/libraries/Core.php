<?php

    /**
     * App Core Class
     * Creates URL and loads Core controller
     * URL FOMART: /controller/method/params
     */

     class Core{

        /**
         * The default controller
         * @string
         */
        protected $current_controller = 'Pages';

        /**
         * The default method
         * @string
         */
        protected $current_method = 'index';

        /**
         * The default parameters
         * @array
         */
        protected $params = [];

        public function __construct(){
            $url = $this->getUrl();

            //Checks controller for first index
            if(isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
                $this->current_controller = ucwords($url[0]);
                unset($url[0]);
            }

            require_once '../app/controllers/' . $this->current_controller . '.php';
            $this->current_controller = new $this->current_controller;

            //Check for method parameter
            if(isset($url[1])){
                //Check to see if method exists in controller
                if(method_exists($this->current_controller, $url[1])){
                    $this->current_method = $url[1];
                    unset($url[1]);
                }
            }

            //Get parameters
            $this->params = $url ? array_values($url) : [];

            //Call a callback array of params
            call_user_func_array([$this->current_controller, $this->current_method], $this->params);
        }

        /**
         * Gets the url passed in to use in the main controller
         */
        public function getUrl(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }

     }

