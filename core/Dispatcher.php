<?php

require CORE.DS.'Router.php';
require CORE.DS.'Request.php';

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

    // After loading controller, we have to check to 
    // action that the controller has to execute
    if (!in_array($this->_request->action, get_class_methods($controller))) {
      $controller = new Controller($this->_request);
      $controller->e404('Action '.$this->_request->action.' introuvable dans '.$this->_request->controller);
    }

    // Calling the action of the requested controller
    // NB: /ControllerName/ActionName/arg1/arg2/..
    call_user_func_array(array($controller, $this->_request->action), 
                         $this->_request->args);

    // Then render the view corresponding the action
    $controller->render($this->_request->action);
  }

  /**
   * @return appropriate controller class according to object controller 
   * in $_request
   */
  function loadController() {
    // Lower case controller to invoke then upper case the first letter 
    // of the controller args in request so it mathes our naming convention
    $name = ucfirst(strtolower($this->_request->controller)).'Controller';

    // Finding and including the controller file
    $file = ROOT.DS.'controller'.DS.$name.'.php';
    require $file;

    // Construct controller object with the request
    return new $name($this->_request);
  }
} 
