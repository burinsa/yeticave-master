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

  if ($result) {
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
  } else {
    $error = mysqli_error($link);
    $page = renderTemplate($page_error,['erorr' => $error]);
  }
    

  $cur_page = $_GET['page'] ?? 1;
  $page_items = 6;  
  $offset = ($cur_page - 1) * $page_items;

  if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $sql = "SELECT `lot_id`, l.lot_name AS `title`, c.cat_name AS `category`, l.lot_price AS `price`, l.lot_img AS `img`, l.lot_desc AS `description`, l.dt_add AS `lot-date` FROM lots AS l 
    JOIN categories AS c ON l.cat_id = c.cat_id 
    WHERE c.cat_id =" . $category . ' LIMIT ' . $page_items . ' OFFSET ' . $offset;

    $result = mysqli_query($link, "SELECT COUNT(*) as cnt FROM lots  WHERE cat_id =" . $category);
   
    // var_dump(mysqli_error($link));

  } else {
    $sql = 'SELECT `lot_id`, l.lot_name AS `title`, c.cat_name AS `category`, l.lot_price AS `price`, l.lot_img AS `img`, l.lot_desc AS `description`, l.dt_add AS `lot-date` FROM lots AS l 
    JOIN categories AS c ON l.cat_id = c.cat_id
    ORDER  BY l.dt_add DESC LIMIT ' . $page_items . ' OFFSET ' . $offset;
    $result = mysqli_query($link, "SELECT COUNT(*) as cnt FROM lots");
    
  }
  
  
  $items_count = mysqli_fetch_assoc($result)['cnt'];
  $res = mysqli_query($link, $sql);
  $lots = mysqli_fetch_all($res, MYSQLI_ASSOC);
  $pages_count = ceil($items_count/$page_items);
  $pages = range(1, $pages_count);

  // var_dump(mysqli_error($link));
  // print_r($items_count);
  $page = renderTemplate($path_index,['lots' => $lots, 'time' => $time_left, 'pages' => $pages, 'pages_count' => $pages_count,
  'cur_page' => $cur_page]);
}



if (isset($_SESSION['user'])) {
  $layout_page = renderTemplate($path_layout, ['content' => $page, 'categories' => $categories, 'username' => $_SESSION['user']['name'], 'user_avatar' => $_SESSION['user']['user_avatar'], 'title' => 'Главная']);
} else {
  $layout_page = renderTemplate($path_layout, ['content' => $page, 'categories' => $categories, 'title' => 'Главная']);
}
print $layout_page;
var_dump(isset($_GET['category']));
?>

