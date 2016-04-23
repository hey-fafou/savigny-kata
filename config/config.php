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

// Admin prefix declaration
Router::setPrefix('sudo', 'admin');

$url = $_SERVER['REQUEST_URI'];

// expected url: /savigny-kata/controller/action/param1/param2/
// Route 1: BASE_URL => /savigny-kata
Router::connect('([a-z\-]+)', $url, 'base');

// Route 2: Prefix
Router::checkPrefix('(^[a-z]+)', $url);

// Route 3: Controller
Router::connect('(^[a-z]+)', $url, 'controller');

// Route 4: Action
Router::connect('(^[a-z]+)', $url, 'action');

// Route 5: Parameters
Router::connect('(^[a-zA-Z0-9/]+$)', $url, 'parameters');
