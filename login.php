<?php 
// require_once 'userdata.php';
require_once 'functions.php';
require_once 'data.php';
require_once 'init.php';

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
    // print_r($errors);
    // print_r($form);

    if (!$link) {
      $error = mysqli_connect_error();
      $page_content = renderTemplate($page_error,['erorr' => $error]);
      $layout_page = renderTemplate($path_layout, ['content' => $page_content, 'categories' => $categories, 'title' => 'Вход']);
    } else {
      $sql = 'SELECT `user_email` AS `email`, `user_name` AS `name`, `user_pass` AS `password`, `user_avatar` FROM users';
      $res = mysqli_query($link, $sql);
      $users = mysqli_fetch_all($res, MYSQLI_ASSOC);
      // print_r($rows);
      print_r($users);

      if(!count($errors) and $user = searchUserByEmail($form['email'], $users)) {
        if(password_verify($form['password'], $user['password'])) {
          $_SESSION['user'] = $user;
        } else {
          $errors['password'] = 'Неверный пароль';
        }
      } elseif (!count($errors) and !$user = searchUserByEmail($form['email'], $users)) {
        $errors['email'] = 'Такой пользователь не найден';
      } 
      // print_r($errors);
  
      if (count($errors)) {
        $page_content = renderTemplate($path_login, ['form' => $form, 'errors' => $errors]);
        $layout_page = renderTemplate($path_layout, ['content' => $page_content, 'categories' => $categories, 'title' => 'Вход']);
    
      } else {
        header('Location: /index.php');
        exit();
      }

    }

    
  }
   else {

    if (isset($_SESSION['user'])) {
      $page_content = renderTemplate($path_index, [ 'lots' => $lots, 'time' => $time_left]);
      $layout_page = renderTemplate($path_layout, ['content' => $page_content, 'categories' => $categories, 'username' => $_SESSION['user']['name'], 'user_avatar' => $_SESSION['user']['user_avatar'], 'title' => 'Главная']);
    }
     else {
      $page_content = renderTemplate($path_login, []);
      $layout_page = renderTemplate($path_layout, ['content' => $page_content, 'categories' => $categories, 'title' => 'Вход']);
    }
    
  }

  print $layout_page;

  // print_r($_SESSION);

?>