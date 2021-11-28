<?php
require_once 'functions.php';
require_once 'data.php';
require_once 'init.php';
session_start();

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

if (!$link) {

    $error = mysqli_connect_error();
    $page = renderTemplate($page_error,['erorr' => $error]);

  } else {
    //  получение категорий
    $sql = 'SELECT `cat_id`, `cat_name` FROM categories
    ORDER BY `cat_id`';
    $result = mysqli_query($link, $sql);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);   

    if (isset($_GET['id_lot'])) {
        $lot_id = $_GET['id_lot'];
        // получение лота по id
        $sql = 'SELECT `lot_id`, l.lot_name AS `title`, c.cat_name AS `category`, l.lot_price AS `price`, l.lot_img AS `img`, l.lot_desc AS `description`,  l.lot_date AS `lot-date`, l.lot_step AS step, l.user_id AS user  FROM lots AS l 
        JOIN categories AS c ON l.cat_id = c.cat_id
        WHERE l.lot_id = ' . $lot_id;
    
        $res = mysqli_query($link, $sql);
        $lot = mysqli_fetch_assoc($res);

        // получение ставок по id лота
        $sql = "SELECT `rate_date` AS `date`, `rate_amount` AS `price`, `user_name` AS `name`, `lot_id` FROM `rate`".
        " JOIN users ON users.user_id = rate.user_id ".
        "WHERE rate.lot_id = " . $lot_id . 
        " ORDER BY `rate_date` DESC";
        
        $res = mysqli_query($link, $sql);
        $rates = mysqli_fetch_all($res, MYSQLI_ASSOC);
        //    var_dump(mysqli_error($link));
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