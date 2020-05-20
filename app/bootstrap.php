<?php

//Load config.php
require_once 'config/config.php';

//Autoload core libraries
spl_autoload_register(function($class_name){
    require_once 'libraries/' . $class_name . '.php';
});