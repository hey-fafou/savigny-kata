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
    $var['posts'] = $this->PostsModel->find(array(
                    'filters' => array('type' => 'news',
                                         'id' => 1)));
    $this->set($var);
  }
}
