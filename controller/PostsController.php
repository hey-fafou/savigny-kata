<?php
/**
 * class PostsController
 * @brief handles controller for posts
 */
class PostsController extends Controller {
  private $_post_types = array('news', 'blog');

  /**
   * Loads appropriate model and request to database
   * for rendering page with posts.
   * @param [in] $post_type type of the posts to print.
   */
  function index($post_type = "") {
    // Looking for the post type
    if (!in_array($post_type, $this->_post_types)) {
      $post_type = "";
    }

    $posts_per_page = 2;
    $this->loadModel('PostsModel');
    $filters = array('posts' => array('type' => $post_type));
    $fields = array('posts' => array('id', 'title', 'content', 'type', 'date'),
                    'medias' => array('title', 'file'));
    $joins = array('medias' => 'post_id');
    $sort = 'date DESC';
    $var['posts'] = $this->PostsModel->find(array(
      'filters' => $filters,
      'fields' => $fields,
      'joins' => $joins,
      'sort' => $sort,
      'limit' => array($posts_per_page*($this->_request->page - 1), $posts_per_page)));
    $var['pages'] = ceil(($this->PostsModel->findCount($filters))/$posts_per_page);
    $var['page'] = $this->_request->page;
    $this->set($var);
  }
  
  /**
   * Display view of one post.
   * @param [in] $post_type type of post to print.
   * @param [in] $post_id id of post ot print.
   */
  function view($post_type = "", $post_id = 0) {
    // Looking for the post type
    if (!in_array($post_type, $this->_post_types)) {
      $post_type = "";
    }

    // Checking $post_id
    if (!is_numeric($post_id) || $post_id <= 0) {
      $post_id = 0;
    }

    $this->loadModel('PostsModel');
    $filters = array('posts' => array('type' => $post_type, 
                                      'id' => $post_id));
    $fields = array('posts' => array('id', 'title', 'content', 'date'),
                    'medias' => array('title', 'file'));
    $joins = array('medias' => 'post_id');
    $var['post'] = $this->PostsModel->findFirst(array(
      'filters' => $filters,
      'fields' => $fields,
      'joins' => $joins));
    if (empty($var['post'])) {
      $this->e404("Page introuvable.");
    }
    $this->set($var);
  }

  /*__________ ADMIN __________*/
  
  /**
   * Display all posts to modify.
   * @param [in] $post_type type of posts to print.
   */
  function admin_index($post_type = "") {
    // Looking for the post type
    if (!in_array($post_type, $this->_post_types)) {
      $post_type = "";
    }

    $posts_per_page = 10;
    $this->loadModel('PostsModel');
    $filters = array('posts' => array('type' => $post_type));
    $fields = array('posts' => array('id', 'title', 'type', 'date'));
    $sort = 'date DESC';
    $var['posts'] = $this->PostsModel->find(array(
      'filters' => $filters,
      'fields' => $fields,
      'sort' => $sort,
      'limit' => array($posts_per_page*($this->_request->page - 1), $posts_per_page)));
    $var['total_posts'] = $this->PostsModel->findCount($filters);
    $var['pages'] = ceil($var['total_posts']/$posts_per_page);
    $var['page'] = $this->_request->page;
    $var['post_type'] = $post_type;
    $this->set($var);
  }

  /**
   * Delete a particular post and the media associated.
   * @param [in] $post_type type of the post to delete.
   * @param [in] $post_id id of the post to delete.
   */
  function admin_delete($post_type = "", $post_id = 0) {
    // Looking for the post type
    if (!in_array($post_type, $this->_post_types)) {
      $post_type = "";
    }

    // Checking $post_id
    if (!is_numeric($post_id) || $post_id <= 0) {
      $post_id = 0;
    }

    // Deleting post content
    $this->loadModel('PostsModel');
    $this->PostsModel->delete($post_id);
    
    // Checking if media is associated with the post
    $this->loadModel('MediasModel');
    $filters = array('medias' => array('type' => $post_type, 
                                      'post_id' => $post_id));
    $var['media'] = $this->MediasModel->findFirst(array('filters' => $filters));

    // If there is a media associated, we delete the media
    if (!empty($var['media'])) {
      $this->MediasModel->delete($var['media']);
    }

    $this->redirect(BASE_URL.'/'.array_search('admin', Router::$prefixes).'/posts/index/'.$post_type);
  }

  /**
   * Edit a particular post and the media associated.
   * @param [in] $post_type type of the post to edit.
   * @param [in] $post_id id of the post to edit.
   */
  function admin_edit($post_type = "", $post_id = 0) {
    // Looking for the post type
    if (!in_array($post_type, $this->_post_types)) {
      $post_type = "";
    }

    // Checking $post_id
    if (!is_numeric($post_id) || $post_id <= 0) {
      $post_id = 0;
    }

    // If a media has been given
    if (!empty($_FILES)) {
      if ($_FILES['img']['error'] == 0) {
        // Building data to insert in medias table
        $data = array('post_id' => $post_id,
          'title' => $_FILES['img']['name'],
          'file' => $_FILES['img']['tmp_name'],
          'type' => $post_type);

        // Load model media to call its methods
        $this->loadModel('MediasModel');

        // Before updating the new image, need to remove the previous one if there
        // was one.
        $filters = array('medias' => array('type' => $post_type, 
                                           'post_id' => $post_id));
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
      unset($_POST['MAX_FILE_SIZE']);  

      // Saving post update
      $this->PostsModel->save($_POST);
    }

    // Filter on post with id $post_id and field with formated date
    $filters = array('posts' => array('type' => $post_type, 
                                      'id' => $post_id));
    $fields = array('posts' => array('id', 'title', 'content', 'type'));
    // Get post to edit and print them in the appropriate form field when editiing
    $var['post'] = $this->PostsModel->findFirst(array(
      'filters' => $filters,
      'fields' => $fields));

    // There is two manner to get in this function :
    // 1) When a post is selected for edition
    // 2) When update is submitted
    // If $post_id of the post to edit exist, will pre-fill the form, else we redirect.
    if (empty($var['post'])) {
      $this->redirect(BASE_URL.'/'.array_search('admin', Router::$prefixes).'/posts/index/'.$post_type);
    } else {
      $this->set($var);
    }
  }

  /**
   * Add new post.
   * @param [in] $post_type type of post to add.
   */
  function admin_add($post_type = "") {
    // Looking for the post type
    if (!in_array($post_type, $this->_post_types)) {
      $post_type = "";
    }

    $this->loadModel('PostsModel');

    // If method post has been called
    if (!empty($_POST)) {
      // When adding a post, a media can be added. Therefore we had to
      // define MAX_FILE_SIZE input, and we now have to remove it from $_POST
      unset($_POST['MAX_FILE_SIZE']);  

      // Need to save the last post id to join media
      $last_post_id = $this->PostsModel->save($_POST);

      // If a media has been given
      if (!empty($_FILES)) {
        if ($_FILES['img']['error'] == 0) {
          // Building data to insert in medias table
          $data = array('post_id' => $last_post_id,
            'title' => $_FILES['img']['name'],
            'file' => $_FILES['img']['tmp_name'],
            'type' => $post_type);

          // Load model media to call its methods
          $this->loadModel('MediasModel');
          $this->MediasModel->upload($data);
        }
      }

      // After adding the post, we redirect to admin posts page
      $this->redirect(BASE_URL.'/'.array_search('admin', Router::$prefixes).'/posts/index/'.$post_type);
    }

    // Need to set post type when adding a post
    $var['post_type'] = $post_type;
    $this->set($var);
  }
}
