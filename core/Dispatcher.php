<?php

require CORE.DS.'Router.php';
require CORE.DS.'Request.php';

class Dispatcher {

  var $_request;

  function __construct() {
    $this->_request = new Request();

    // Parsing URL
    Router::parse($this->_request->getURL(), $this->_request);

    // Getting the requested controller
    $controller = $this->loadController();

    // Check if action matches a method of the requested controller
    if (!in_array($this->_request->action, get_class_methods($controller))) {
      $this->error('Action '.$this->_request->action.' not found within ' 
        .$this->_request->controller.' controller.');
    }

    // Calling the action of the requested controller
    // NB: /ControllerName/ActionName/arg1/arg2/..
    call_user_func_array(array($controller, $this->_request->action), 
                         $this->_request->args);

    // Then render the view corresponding the action
    $controller->render($this->_request->action);
  }

  function error($msg) {
    header("HTTP/1.0 404 Not Found");
    $controller = new Controller($this->_request);
    $controller->set('messageError', $msg);
    $controller->render('/errors/404');
    die();
  }

  /**
   * @return appropriate controller class according to object controller 
   * in $_request
   */
  function loadController() {
    // Upper case the first letter of the controller args in request
    // so it mathes our naming convention
    $name = ucfirst($this->_request->controller).'Controller';

    // Finding and including the controller file
    $file = ROOT.DS.'controller'.DS.$name.'.php';
    require $file;

    // Construct controller object with the request
    return new $name($this->_request);
  }
} 
