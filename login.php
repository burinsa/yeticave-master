<?php 
require_once 'userdata.php';
require_once 'functions.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $form = $_POST;

  $required = ['email', 'password'];
  $errors = [];

  foreach ($required as $value) {
    if (empty($form[$value])) {
      $errors[$value] = ' Это поле нужно заполнить!';
    }
  }

  if(!count($errors) && $user = searchUserByEmail($form['email'], $users)) {
    if(password_verify($form['password'], $user['password'])) {
      $_SESSION['user'] = $user;
    }
  }
}
 ?>