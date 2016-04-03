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
    $filters = array('type' => 'news');
    $fields = array('*', 'DATE_FORMAT(date, \'%d/%m/%Y à %Hh%i\') AS date_fr');
    $sort = 'STR_TO_DATE(date, \'%Y-%m-%d %H:%i:%s\') DESC';
    $var['news_posts'] = $this->PostsModel->find(array(
      'filters' => $filters,
      'fields' => $fields,
      'sort' => $sort));
    $var['count'] = $this->PostsModel->findCount($filters);
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
