<?php
require_once 'init.php';
require_once 'functions.php';
require_once 'data.php';

if (!$link) {
  $error = mysqli_connect_error();
  $page_content = renderTemplate($page_error,['erorr' => $error]);
}
else {
  $sql = 'SELECT `cat_id`, `cat_name` FROM categories
  ORDER BY `cat_id`';
  $result = mysqli_query($link, $sql);
  $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;

    $required = ['email', 'password', 'name', 'message'];
    $errors = [];

    foreach ($required as $value) {
      if (empty($form[$value])) {
        $errors[$value] = 'Это поле нужно заполнить!';
      } else {
        if ($value == 'email') {
          if (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[$value] = 'Введите корректный email!';
          }
        }
      }
    }

    if (count($errors)) {
      $page_content = renderTemplate($path_sign_up, ['form' => $form, 'errors' => $errors]);
    
    } else { 
      $email = $form['email'];
      $name = $form['name'];
      $message = $form['message'];
      $password = password_hash($form['password'], PASSWORD_DEFAULT);

      if (!empty($_FILES['photo2']['name'])) {
        $file_name = $_FILES['photo2']['name'];
        $file_path = __DIR__ . 'img/';
        $file_url = 'img/' . $file_name;
        move_uploaded_file($_FILES['photo2']['tmp_name'], $file_url);
        $avatar = $file_url;
      } else {
        $avatar = null;
      }

      $sql = 'INSERT INTO users(`data_add`, `user_email`, `user_name`, `user_pass`, `user_avatar`, `user_contacts`) VALUES (NOW(), ?, ?, ?, ?, ?)';
      $stmt = mysqli_prepare($link, $sql);
      
      mysqli_stmt_bind_param($stmt, 'sssss', $email, $name, $password, $avatar, $message);
      $res = mysqli_stmt_execute($stmt);

      if ($res) {
        header('Location: /login.php');
      }
      // var_dump(mysqli_error($link));
    }
  }
    else {
      $page_content = renderTemplate($path_sign_up, []);     
    }
} 



$layout_page = renderTemplate($path_layout, ['content' => $page_content, 'categories' => $categories, 'title' => 'Регистрация']);

print $layout_page;