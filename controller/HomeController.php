<?php
/**
 * class PagesController
 * @brief handles controller for pages
 */
class HomeController extends Controller {
  /**
   * Loads appropriate model and request to database
   * for rendering home page
   */
  function index() {
    $this->loadModel('PostsModel');
    $var['posts'] = $this->PostsModel->find(array(
                    'filters' => array('type' => 'news')));
    $this->set($var);
  }
}
