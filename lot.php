<?php
require_once 'functions.php';
require_once 'init.php';
require_once 'vendor/autoload.php';
require_once 'Database.php';
session_start();
$dbHelper = new Database();

// добавление в историю
$counter_name = 'history'; 
$id_lots = array();
$id_lots[] = $_GET['id_lot'];
$id_encode = json_encode($id_lots);
$expire = strtotime("+30 days");
$path = "/";

if (isset($_COOKIE['history'])) {
    $id_lots = json_decode($_COOKIE['history']);
    if (!in_array($_GET['id_lot'], $id_lots)) {
        $id_lots[] = $_GET['id_lot'];
    }
    $id_encode = json_encode($id_lots);
}

setcookie($counter_name, $id_encode, $expire, $path);

if ($dbHelper->getLastError()) {
    $page = renderTemplate($page_error, $dbHelper->getLastError());
  } else {
    //  получение категорий
    $sql = 'SELECT `cat_id`, `cat_name` FROM categories
    ORDER BY `cat_id`';
    $dbHelper->mysqliQuery($sql);
  
    if (!$dbHelper->getLastError()) {
      $categories = $dbHelper->getResultsAsArray();
    } else {
      $page = renderTemplate($page_error,$dbHelper->getLastError());
    }

    if (isset($_GET['id_lot'])) {
        $lot_id = $_GET['id_lot'];
        // получение лота по id
        $sql = 'SELECT `lot_id`, l.lot_name AS `title`, c.cat_name AS `category`, l.lot_price AS `price`, l.lot_img AS `img`, l.lot_desc AS `description`,  l.lot_date AS `lot-date`, l.lot_step AS step, l.user_id AS user  FROM lots AS l 
        JOIN categories AS c ON l.cat_id = c.cat_id
        WHERE l.lot_id = ' . $lot_id;
    
        $dbHelper->mysqliQuery($sql);
        $lot = $dbHelper->getResultAsArray();

        // получение ставок по id лота
        $sql = "SELECT `rate_date` AS `date`, `rate_amount` AS `price`, `user_name` AS `name`, `lot_id` FROM `rate`".
        " JOIN users ON users.user_id = rate.user_id ".
        "WHERE rate.lot_id = " . $lot_id . 
        " ORDER BY `rate_date` DESC";
        
        $dbHelper->mysqliQuery($sql);
        $rates = $dbHelper->getResultsAsArray();
        
    } else {
        $lot = null;
    }

    if (!$lot) {
        http_response_code(404);
    } 

    $page_lot = renderTemplate($path_lot,['lot' => $lot, 'rates' => $rates ]);

}         

if (isset($_SESSION['user'])) {
    $layout_lot = renderTemplate($path_layout, ['content' => $page_lot, 'categories' => $categories, 'username' => $_SESSION['user']['name'], 'user_avatar' => $_SESSION['user']['user_avatar'], 'title' => $lot['title']]);
} else {
    $layout_lot = renderTemplate($path_layout, ['content' => $page_lot, 'categories' => $categories, 'title' => $lot['title']]);
}
print $layout_lot;
// print_r($_SESSION['user']);
?>