<?php
class Session {
  public function __construct() {
    if (!isset($_SESSION)) {
      session_start();
    }
  }

  public function setFlash($msg, $type = 'success') {
    $_SESSION['flash'] = array(
      'message' => $msg,
      'type' => $type
    );
  }

  public function flash() {
    if (isset($_SESSION['flash']['message'])) {
      $html = '<div class="flash '.$_SESSION['flash']['type'].'">
                <p>'.$_SESSION['flash']['message'].'</p>
              </div>';
      $_SESSION['flash'] = array();
      return $html;
    }
  }

  public function write($key, $value) {
    $_SESSION[$key] = $value;
  }

  public function read($key = NULL) {
    if ($key) {
      if (isset($_SESSION[$key])) {
        return $_SESSION[$key];
      } else {
        return false;
      } 
    } else {
      return $_SESSION;
    }
  }

  public function isLogged() {
    return isset($_SESSION['user']->id);
  }
}
