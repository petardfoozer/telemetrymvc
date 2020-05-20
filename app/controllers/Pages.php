<?php

    class Pages extends Controller{
        public function __construct(){
        }

        public function index(){
            $data = ['title' => 'Welcome'];
            $this->renderView('pages/index', $data);
        }

        public function about(){
            $this->renderView('pages/about');
        }
    }