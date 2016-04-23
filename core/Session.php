<?php
class Session {
  public function __construct() {
    session_start();
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
}
