<?php
/**
 * class PagesController
 * @brief handles controller for pages
 */
class PagesController extends Controller {
  
  /**
   * Loads appropriate model and request to database
   * for rendering home page
   */
  function home() {
    $this->loadModel('PostsModel');
    $var['posts'] = $this->PostsModel->find(array());
    $this->set($var);
  }
}
