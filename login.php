<?php 
require_once 'userdata.php';
require_once 'functions.php';
require_once 'data.php';

session_start();

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;

    $required = ['email', 'password'];
    $errors = [];

    foreach ($required as $value) {
      if (empty($form[$value])) {
        $errors[$value] = 'Это поле нужно заполнить!';
      }
    }
    print_r($errors);

    if(!count($errors) and $user = searchUserByEmail($form['email'], $users)) {
      if(password_verify($form['password'], $user['password'])) {
        $_SESSION['user'] = $user;
      } else {
        $errors['password'] = 'Неверный пароль';
      }
    } else {
      $errors['email'] = 'Такой пользователь не найден';
    }

    if (count($errors)) {
      $page_content = renderTemplate($path_login, ['form' => $form, 'errors' => $errors]);
      
    } else {
      header('Location: /index.php');
      exit();
    }
  }
   else {

    if (isset($_SESSION['user'])) {
      $page_content = renderTemplate($path_index, [ 'lots' => $lots, 'time' => $time_left]);
      $layout_page = renderTemplate($path_layout, ['content' => $page_content, 'categories' => $categories, 'username' => $_SESSION['user']['name'], 'user_avatar' => $user_avatar, 'title' => 'Главная']);
    }
     else {
      $page_content = renderTemplate($path_login, []);
      $layout_page = renderTemplate($path_layout, ['content' => $page_content, 'categories' => $categories, 'title' => 'Главная']);
    }
    
  }

  
  

  print $layout_page;

  print_r($_SESSION);

?>