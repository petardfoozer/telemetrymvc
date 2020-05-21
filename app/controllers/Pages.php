<?php

    class Pages extends Controller{
        public function __construct(){
        }

        public function index(){
            $data = ['title' => 'Welcome to Telemetry MVC Framework'];
            $this->renderView('pages/index', $data);
        }

        public function about(){
            $data = ['title' => 'About Us'];
            $this->renderView('pages/about', $data);
        }
    }