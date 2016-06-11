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
    $filters = array('type' => 'news', 'id' => $id);
    $fields = array('*', 'DATE_FORMAT(date, \'%d/%m/%Y à %Hh%i\') AS date_fr');
    $var['news_post'] = $this->PostsModel->findFirst(array(
      'filters' => $filters,
      'fields' => $fields));
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
    $fields = array('id, title', 'DATE_FORMAT(date, \'%d/%m/%Y à %Hh%i\') AS date_fr');
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
    // Deleting post content
    $this->loadModel('PostsModel');
    $this->PostsModel->delete($id);
    
    // Checking if media is associated with the post
    $this->loadModel('MediasModel');
    $filters = array('type' => 'news', 'post_id' => $id);
    $var['media'] = $this->MediasModel->findFirst(array('filters' => $filters));

    // If there is a media associated, we delete the media
    if (!empty($var['media'])) {
      $this->MediasModel->delete($var['media']);
      $this->Session->setFlash('Le contenu et l\'image associée ont bien été supprimés.');
    } else {
      $this->Session->setFlash('Le contenu a bien été supprimé.');
    }

    $this->redirect(BASE_URL.'/'.array_search('admin', Router::$prefixes).'/home/index');
  }

  function admin_edit($id = 0) {
    // If a media has been given
    if (!empty($_FILES)) {
      if ($_FILES['img']['error'] == 0) {
        // Building data to insert in medias table
        $data = array('post_id' => $id,
          'title' => $_FILES['img']['name'],
          'file' => $_FILES['img']['tmp_name'],
          'type' => 'news');

        // Load model media to call its methods
        $this->loadModel('MediasModel');

        // Before updating the new image, need to remove the previous one if there
        // was one.
        $filters = array('type' => 'news', 'post_id' => $id);
        $var['media'] = $this->MediasModel->findFirst(array('filters' => $filters));

        // If there is a media associated, we delete the media
        if (!empty($var['media'])) {
          $this->MediasModel->delete($var['media']);
        }

        $this->MediasModel->upload($data);
      }
    }

    $this->loadModel('PostsModel');

    // If method post has been called
    if (!empty($_POST)) {
      // When adding a post, a media can be added. Therefore we had to
      // define MAX_FILE_SIZE input, and we now have to remove it from $_POST
      array_pop($_POST);  

      // Saving post update
      $this->PostsModel->save($_POST);
      $this->Session->setFlash('Le contenu a bien été modifié.');
    }

    // Filter on news post with id $id and field with formated date
    $filters = array('type' => 'news', 'id' => $id);
    $fields = array('*', 'DATE_FORMAT(date, \'%d/%m/%Y à %Hh%i\') AS date_fr');
    // Get post to edit and print them in the appropriate form field when editiing
    $var['news_post'] = $this->PostsModel->findFirst(array(
      'filters' => $filters,
      'fields' => $fields));

    // There is two manner to get in this function :
    // 1) When a post is selected for edition
    // 2) When update is submitted
    // If $id of the post to edit exist, will pre-fill the form, else we redirect.
    if (empty($var['news_post'])) {
      $this->redirect(BASE_URL.'/'.array_search('admin', Router::$prefixes).'/home/index');
    } else {
      $this->set($var);
    }
  }

  function admin_add() {
    $this->loadModel('PostsModel');

    // If method post has been called
    if (!empty($_POST)) {
      // When adding a post, a media can be added. Therefore we had to
      // define MAX_FILE_SIZE input, and we now have to remove it from $_POST
      array_pop($_POST);  

      // Need to save the last post id to join media
      $last_post_id = $this->PostsModel->save($_POST);

      // If a media has been given
      if (!empty($_FILES)) {
        if ($_FILES['img']['error'] == 0) {
          // Building data to insert in medias table
          $data = array('post_id' => $last_post_id,
            'title' => $_FILES['img']['name'],
            'file' => $_FILES['img']['tmp_name'],
            'type' => $_POST['type']);

          // Load model media to call its methods
          $this->loadModel('MediasModel');
          $this->MediasModel->upload($data);
        }
      }

      // After adding the post, we redirect to admin home page
      $this->redirect(BASE_URL.'/'.array_search('admin', Router::$prefixes).'/home/index');
    }
  }
}
