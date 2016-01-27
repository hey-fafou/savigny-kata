<?php
class Controller {

  public $_request;
  private $_vars = array();   // Variable to pass to the view
  public $_layout = 'default';   // Layout
  private $_isRendered = false;   // If view has been rendered

  function __construct($_request) {
    $this->_request = $_request;
  }

  /**
   * @return a view
   */
  public function render($viewName) {
    if ($this->_isRendered) {
      return false;
    } else {
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
        ob_start();
        require $view;
        $content_for_layout = ob_get_clean();
        require ROOT.DS.'view'.DS.'layout'.DS.$this->_layout.'.php';
        $this->_isRendered = true;
    }
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
}
?>
