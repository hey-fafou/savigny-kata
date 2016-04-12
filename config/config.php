<?php

class Config {

  static $debug = 1;

  static $databases = array(
    'default' => array(
      'host'      =>  'localhost',
      'database'  =>  'savigny-kata',
      'login'     =>  'root',
      'password'  =>  '')
    );    
}

$url = $_SERVER['REQUEST_URI'];

// expected url: /savigny-kata/controller/action/param1/param2/
// Route 1: BASE_URL => /savigny-kata
Router::connect('([a-z\-]+)', $url);

// Route 2: Controller
Router::connect('(^[a-z]+$)', $url);

// Route 3: Action
Router::connect('(^[a-z]+$)', $url);

// Route 4: Parameters
Router::connect('(^[a-zA-Z0-9/]+$)', $url);
