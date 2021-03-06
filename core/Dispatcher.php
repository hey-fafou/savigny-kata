<?php

/**
 * Class Dispatcher
 * @brief Analyse url and loads appropriate component to render the view.
 */
class Dispatcher {

  var $_request;

  /**
   * Ctor,
   * <ul>
   *  <li>Contruct the request by parsing url</li>
   *  <li>Loads the controller</li>
   *  <li>Render the view</li>
   * </ul>
   */
  function __construct() {
    $this->_request = new Request();

    // Parsing URL
    Router::parse($this->_request->getURL(), $this->_request);

    // Getting the requested controller
    $controller = $this->loadController();
    $action = $this->_request->action;
    if ($this->_request->prefix) {
      $action = $this->_request->prefix.'_'.$action;
    }

    // After loading controller, we have to check the action exits within
    // the controller. 
    // WARNING: get_class_methods also gives parents methods
    $controllerMethods = array_diff(get_class_methods($controller), 
                                    get_class_methods('Controller'));

    if (!in_array($action, $controllerMethods)) {
      $this->error('L\'action '.$action.' n\'existe pas.');
    }

    // Calling the action of the requested controller
    // NB: /ControllerName/ActionName/arg1/arg2/..
    call_user_func_array(array($controller, $action), $this->_request->args);

    // Then render the view corresponding the action
    $controller->render($action);
  }

  function error($message) {
      $controller = new Controller($this->_request);
      $controller->e404($message);
  }

  /**
   * @return appropriate controller class according to object controller 
   */
  function loadController() {
    // Lower case controller to invoke then upper case the first letter 
    // of the controller args in request so it mathes our naming convention
    $name = ucfirst(strtolower($this->_request->controller)).'Controller';

    // Finding and including the controller file
    $file = ROOT.DS.'controller'.DS.$name.'.php';
    if (!file_exists($file)) {
      $this->error('Le controleur '.$this->_request->controller.' n\'existe pas.');
    }
    require $file;

    // Construct controller object with the request
    $controller = new $name($this->_request);

    return $controller;
  }
} 
