<?php
class UsersController extends Controller {
  function login() {
    // If login form has been filled.
    if (!empty($_POST)) {
      $login = $_POST['login'];
      $password = sha1($_POST['password']);

      $this->loadModel('UsersModel');
      $filters = array('users' => array('login' => $login,
                                        'password' => $password)); 
      $user = $this->UsersModel->findFirst(array(
        'filters' => $filters));

      // If login and password are correct, this mean
      // that we found a user in the database.
      if ($user) {
      } 
    }
  }

  function logout() {
  }
}
