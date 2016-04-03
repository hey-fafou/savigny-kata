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
    $news_per_page = 3;
    $this->loadModel('PostsModel');
    $filters = array('type' => 'news');
    $fields = array('*', 'DATE_FORMAT(date, \'%d/%m/%Y à %Hh%i\') AS date_fr');
    $sort = 'STR_TO_DATE(date, \'%Y-%m-%d %H:%i:%s\') DESC';
    $var['news_posts'] = $this->PostsModel->find(array(
      'filters' => $filters,
      'fields' => $fields,
      'sort' => $sort,
      'limit' => array($news_per_page*($this->_request->_page - 1), $news_per_page)));
    $var['page'] = ceil(($this->PostsModel->findCount($filters))/$news_per_page);
    $this->set($var);
  }

  function view($id = 0) {
    $this->loadModel('PostsModel');
    $filters = array('type' => 'news',
                     'id' => $id);
    $fields = array('*', 'DATE_FORMAT(date, \'%d/%m/%Y à %Hh%i\') AS date_fr');
    $sort = 'STR_TO_DATE(date, \'%Y-%m-%d %H:%i:%s\') DESC';
    $var['news_post'] = $this->PostsModel->findFirst(array(
      'filters' => $filters,
      'fields' => $fields,
      'sort' => $sort));
    if (empty($var['news_post'])) {
      $this->e404("Page introuvable.");
    }
    $this->set($var);
  }
}
