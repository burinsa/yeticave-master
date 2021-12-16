<?php
require_once 'functions.php';
require_once 'init.php';
// require_once 'mysql_helper.php';
require_once 'vendor/autoload.php';
require_once 'Database.php';

session_start();
$dbHelper = new Database();
date_default_timezone_set('Europe/Kaliningrad');
$tomorrow = strtotime("tomorrow");

if ($dbHelper->getLastError()) {
  $page = renderTemplate($page_error, $dbHelper->getLastError());
} else {
  $sql = 'SELECT `cat_id`, `cat_name` FROM categories
  ORDER BY `cat_id`';
  // $dbHelper->executeQuery($sql);
  $dbHelper->mysqliQuery($sql);

  if (!$dbHelper->getLastError()) {
    $categories = $dbHelper->getResultsAsArray();
  } else {
    $page = renderTemplate($page_error,$dbHelper->getLastError());
  }
    
  $cur_page = $_GET['page'] ?? 1;
  $page_items = 6;  
  $offset = ($cur_page - 1) * $page_items;

  if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $sql = "SELECT `lot_id`, l.lot_name AS `title`, c.cat_name AS `category`, l.lot_price AS `price`, l.lot_img AS `img`, l.lot_desc AS `description`, l.dt_add AS `lot-date` FROM lots AS l 
    JOIN categories AS c ON l.cat_id = c.cat_id 
    WHERE c.cat_id =" . $category . ' LIMIT ' . $page_items . ' OFFSET ' . $offset;

   $result = $dbHelper->mysqliQuery("SELECT COUNT(*) as cnt FROM lots  WHERE cat_id =" . $category);

  } else {
    $sql = 'SELECT `lot_id`, l.lot_name AS `title`, c.cat_name AS `category`, l.lot_price AS `price`, l.lot_img AS `img`, l.lot_desc AS `description`, l.dt_add AS `lot-date` FROM lots AS l 
    JOIN categories AS c ON l.cat_id = c.cat_id
    ORDER  BY l.dt_add DESC LIMIT ' . $page_items . ' OFFSET ' . $offset;

    $result = $dbHelper->mysqliQuery("SELECT COUNT(*) as cnt FROM lots");
  }
  
  $items_count = $dbHelper->getResultAsArray()['cnt'];
  $dbHelper->mysqliQuery($sql);
  $lots = $dbHelper->getResultsAsArray();
  $pages_count = ceil($items_count/$page_items);
  $pages = range(1, $pages_count);

  $page = renderTemplate($path_index,['lots' => $lots, 'time' => $time_left, 'pages' => $pages, 'pages_count' => $pages_count,
  'cur_page' => $cur_page]);
}



if (isset($_SESSION['user'])) {
  $layout_page = renderTemplate($path_layout, ['content' => $page, 'categories' => $categories, 'username' => $_SESSION['user']['name'], 'user_avatar' => $_SESSION['user']['user_avatar'], 'title' => 'Главная']);
} else {
  $layout_page = renderTemplate($path_layout, ['content' => $page, 'categories' => $categories, 'title' => 'Главная']);
}
print $layout_page;

?>

