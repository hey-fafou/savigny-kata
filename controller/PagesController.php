<?php
class PagesController extends Controller {
  
  function home() {
    $this->loadModel('PostsModel');
    $posts = $this->PostsModel->find(array(
      'conditions' => 'id=1'
    ));
  }
}
