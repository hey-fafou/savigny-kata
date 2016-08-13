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

$url = "";
if (isset($_GET['url'])) {
  $url = $_GET['url'];
} 

// expected url: controller/action/param1/param2/

// Route 1: Prefix
Router::checkPrefix('(^[a-z]+)', $url);

// Route 2: Controller
Router::connect('(^[a-z]+)', $url, 'controller');

// Route 3: Action
Router::connect('(^[a-z]+)', $url, 'action');

// Route 4: Parameters
Router::connect('(^[a-zA-Z0-9/]+$)', $url, 'parameters');
