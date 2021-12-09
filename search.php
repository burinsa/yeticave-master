<?php
require_once 'init.php';
require_once 'data.php';
require_once 'functions.php';
require_once 'vendor/autoload.php';

session_start();

if (!$link) {
  $error = mysqli_connect_error();
  $page_content = renderTemplate($page_error,['erorr' => $error]);
  $layout_page = renderTemplate($path_layout, ['content' => $page_content, 'categories' => $categories, 'title' => 'Вход']);
} else {
  $sql = 'SELECT `cat_id`, `cat_name` FROM categories
  ORDER BY `cat_id`';
  $result = mysqli_query($link, $sql);
  $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

  $lots = [];
  $search = $_GET['search'] ?? '';

  // if ($search) {
    $sql = "SELECT lot_id, l.lot_name AS title, c.cat_name AS category, l.lot_price AS price, l.lot_img AS img, l.lot_desc AS `description`, l.dt_add AS `lot-date` FROM lots AS l 
    JOIN categories AS c ON l.cat_id = c.cat_id
    WHERE MATCH (lot_name, lot_desc) AGAINST(?)";

    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 's', $search);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $lots = mysqli_fetch_all($res, MYSQLI_ASSOC);
    // var_dump(mysqli_error($link));
  // }
  
  // var_dump($search);

  $page = renderTemplate($page_search, ['lots' => $lots, 'time' => $time_left]);
}

if (isset($_SESSION['user'])) {
  $layout_page = renderTemplate($path_layout, ['content' => $page, 'categories' => $categories, 'username' => $_SESSION['user']['name'], 'user_avatar' => $_SESSION['user']['user_avatar'], 'title' => 'Поиск']);
} else {
  $layout_page = renderTemplate($path_layout, ['content' => $page, 'categories' => $categories, 'title' => 'Поиск']);
}

print $layout_page;