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
    $news_per_page = 2;
    $this->loadModel('PostsModel');
    $filters = array('type' => 'news');
    $fields = array('*', 'DATE_FORMAT(date, \'%d/%m/%Y à %Hh%i\') AS date_fr');
    $sort = 'STR_TO_DATE(date, \'%Y-%m-%d %H:%i:%s\') DESC';
    $var['news_posts'] = $this->PostsModel->find(array(
      'filters' => $filters,
      'fields' => $fields,
      'sort' => $sort,
      'limit' => array($news_per_page*($this->_request->page - 1), $news_per_page)));
    $var['pages'] = ceil(($this->PostsModel->findCount($filters))/$news_per_page);
    $var['page'] = $this->_request->page;
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

  /*__________ ADMIN __________*/

  function admin_index() {
    $news_per_page = 10;
    $this->loadModel('PostsModel');
    $filters = array('type' => 'news');
    $fields = array('id, title');
    $sort = 'STR_TO_DATE(date, \'%Y-%m-%d %H:%i:%s\') DESC';
    $var['news_posts'] = $this->PostsModel->find(array(
      'filters' => $filters,
      'fields' => $fields,
      'sort' => $sort,
      'limit' => array($news_per_page*($this->_request->page - 1), $news_per_page)));
    $var['total_posts'] = $this->PostsModel->findCount($filters);
    $var['pages'] = ceil($var['total_posts']/$news_per_page);
    $var['page'] = $this->_request->page;
    $this->set($var);
  }

  function admin_delete($id) {
    $this->loadModel('PostsModel');
    $this->PostsModel->delete($id);
    $this->redirect(BASE_URL.'/'.array_search('admin', Router::$prefixes).'/home/index');
  }
}
