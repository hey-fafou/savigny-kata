<?php
class LinksController extends Controller {
  private $_links_types = array('websites', 'documents', 'networks');

  function admin_index() {
    $this->loadModel('LinksModel');
    foreach ($this->_links_types as $k => $v) {
      $filters = array('links' => array('type' => $v));
      $var[$v] = $this->LinksModel->find(array('filters' => $filters));
    }
    $this->set($var);
  }

  function admin_delete($link_type = "", $link_id = 0) {
    // Checking $post_id
    if (!is_numeric($link_id) || $link_id <= 0) {
      $link_id = 0;
    }

    // Deleting post content
    $this->loadModel('LinksModel');

    // Get link with document link
    $filters = array('links' => array('id' => $link_id));
    $var['link'] = $this->LinksModel->findFirst(array('filters' => $filters));
    $this->LinksModel->delete($var['link']);

    $this->redirect(BASE_URL.'/'.array_search('admin', Router::$prefixes).'/links/index');
  }

  function admin_add($link_type = "") {
    $add_links_types = array_slice($this->_links_types, 0, 2);
    $title = "";

    // Looking for the post type
    if (array_search($link_type, $add_links_types) === FALSE) {
      $this->redirect(BASE_URL.'/'.array_search('admin', Router::$prefixes).'/links/index');
    } else {
      if ($link_type == "documents") {
        $title = "document";
      } else if ($link_type == "websites") {
        $title = "lien";
      }
    }

    $this->loadModel('LinksModel');
    if (!empty($_POST)) {
      // When adding a document we have to define MAX_FILE_SIZE input, 
      // and we now have to remove it from $_POST
      unset($_POST['MAX_FILE_SIZE']);  
      $_POST['link'] .= '/'.$_POST['title'];
      $this->LinksModel->save($_POST);

      if (!empty($_FILES)) {
        if ($_FILES['doc']['error'] == 0) {
          $data = array('title' => $_POST['title'],
                        'file' => $_FILES['doc']['tmp_name']);
          $this->LinksModel->upload($data);
        }
      }
      
      // After adding the post, we redirect to admin posts page
      $this->redirect(BASE_URL.'/'.array_search('admin', Router::$prefixes).'/links/index/');
    }
    
    // Need to set post type when adding a post
    $var['title'] = $title;
    $var['link_type'] = $link_type;
    $this->set($var);
  }

  function admin_edit($link_type = "", $link_id = 0) {
    // Checking $post_id
    if (!is_numeric($link_id) || $link_id <= 0) {
      $link_id = 0;
    }
  }
}
