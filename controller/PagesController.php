<?php
class PagesController extends Controller {
  
  function home() {
    $this->loadModel('PostsModel');
    $var['posts'] = $this->PostsModel->find(array());
    $this->set($var);
  }
}
