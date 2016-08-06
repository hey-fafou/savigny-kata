<?php
class LinksController extends Controller {
  function admin_index() {
    $this->loadModel('LinksModel');
    $var['links'] = $this->LinksModel->find(array());
    $this->set($var);
  }
}
