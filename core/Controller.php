<?php
/**
 * Class Controller
 * @brief Renders the view and gives it all needed variables
 */
class Controller {

  public $_request;
  private $_vars = array();   // Variable to pass to the view
  public $_layout = 'default';   // Layout
  private $_isRendered = false;   // If view has been rendered

  /**
   * Ctor
   * @param [in] $request request get in dispatcher for further
   * use of it hereby
   */
  function __construct($request) {
    $this->_request = $request;
    if ($this->_request->prefix == 'admin') {
      $this->_layout = 'admin';
    }
  }

  /**
   * @param [in] Name of the view to render
   * @return a view
   */
  public function render($viewName) {
    // Child controller class methods might not have
    // to render the view. They can just initialize
    // some variable.
    // But if the view has been rendered, we must avoid
    // to render it twice.
    if ($this->_isRendered) {
      return false;
    } else {
      // Import variable inside vars so they can be used in the view
      extract($this->_vars);
      // If path of the view starts with '/' we send directly the viewName
      // strpos return false if occurence not found, or the position of
      // occurence in tab.
      // Need === to avoid conflict between false and pos 0.
      if (strpos($viewName,'/') === 0) {
        $view = ROOT.DS.'view'.$viewName.'.php';
      } else {
        $view = ROOT.DS.'view'.DS.$this->_request->controller.DS.$viewName.'.php';
      }

      // Recording content to be rendered
      ob_start();
      require $view;
      // Saving all recorded content into variable
      // that will be printed within the layout wrapper
      $content_for_layout = ob_get_clean();
      require ROOT.DS.'view'.DS.'layout'.DS.$this->_layout.'.php';
      $this->_isRendered = true;
    }
  }

  /**
   * Handle error 404
   * @param [in] $msg error message to print
   */
  function e404($msg) {
    header("HTTP/1.0 404 Not Found");
    $this->set('errMsg', $msg);
    $this->render('/errors/404');
    die();
  }

  /**
   * Add a variable into $_vars
   * @param [in] $key the variable name (can be an array)
   * @param [in] $value value of the variable
   */
  public function set($key, $value = null) {
    // If $key is an array we directly add it to $_vars
    if (is_array($key)) {
      $this->_vars += $key;
    } else {  // Else we add the $key and its associated $value
      $this->_vars[$key] = $value;
    }
  }

  /**
   * Allow to load a model.
   * @param [in] $modelName name of the model to be loaded
   */
  public function loadModel($modelName) {
    $file = ROOT.DS.'model'.DS.$modelName.'.php';
    require_once($file);
    if (!isset($this->$modelName)) {
      $this->$modelName = new $modelName();
    }
  }

  function redirect($url, $code = NULL) {
    if ($code == 301) {
      header("HTTP/1.1 301 Moved Permanently");
    }
    header("Location: ".$url);
  } 
}
