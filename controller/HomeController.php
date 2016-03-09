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
    $var['news_posts'] = $this->PostsModel->find(array(
                    'filters' => array('type' => 'news')));
    $this->set($var);
  }

  function view($id = 0) {
    $this->loadModel('PostsModel');
    $var['news_post'] = $this->PostsModel->findFirst(array(
      'filters' => array('type' => 'news',
                         'id' => $id)));
    if (empty($var['news_post'])) {
      $this->e404("Page introuvable.");
    }
    $this->set($var);
  }
}
