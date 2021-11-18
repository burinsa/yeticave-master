<?php
require_once 'functions.php';
require_once 'data.php';
require_once 'init.php';
session_start();
date_default_timezone_set('Europe/Kaliningrad');
$tomorrow = strtotime("tomorrow");

if (!$link) {
  $error = mysqli_connect_error();
  $page = renderTemplate($page_error,['erorr' => $error]);
} else {
  $sql = 'SELECT `cat_id`, `cat_name` FROM categories
  ORDER BY `cat_id`';
  $result = mysqli_query($link, $sql);
  $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);


  $sql = 'SELECT `lot_id`, l.lot_name AS `title`, c.cat_name AS `category`, l.lot_price AS `price`, l.lot_img AS `img`, l.lot_desc AS `description`, l.dt_add AS `lot-date` FROM lots AS l 
  JOIN categories AS c ON l.cat_id = c.cat_id
  ORDER  BY l.dt_add DESC;';

  $res = mysqli_query($link, $sql);
  $lots = mysqli_fetch_all($res, MYSQLI_ASSOC);
  // print_r($lots);
  $page = renderTemplate($path_index,['lots' => $lots, 'time' => $time_left]);
}




if (isset($_SESSION['user'])) {
  $layout_page = renderTemplate($path_layout, ['content' => $page, 'categories' => $categories, 'username' => $_SESSION['user']['name'], 'user_avatar' => $_SESSION['user']['user_avatar'], 'title' => 'Главная']);
} else {
  $layout_page = renderTemplate($path_layout, ['content' => $page, 'categories' => $categories, 'title' => 'Главная']);
}
print $layout_page;
print_r($_SESSION);
?>

