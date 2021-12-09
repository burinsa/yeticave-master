<?php 
require_once 'data.php';
require_once 'functions.php';
require_once 'init.php';
require_once 'vendor/autoload.php';
session_start();

if(!isset($_SESSION['user'])) {
    http_response_code(403);
    header("Location: /index.php");
    exit();
}


if (!$link) {

    $error = mysqli_connect_error();
    $page = renderTemplate($page_error,['erorr' => $error]);

  } else {
    //  получение категорий
    $sql = 'SELECT `cat_id`, `cat_name` FROM categories
    ORDER BY `cat_id`';
    $result = mysqli_query($link, $sql);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    // получение данных лота
    $sql = 'SELECT `lot_id`, l.lot_name AS `title`, c.cat_name AS `category`, l.lot_price AS `price`, l.lot_img AS `img`, l.lot_desc AS `description`,  l.lot_date AS `lot-date`, l.lot_step AS step, l.user_id AS user  FROM lots AS l 
    JOIN categories AS c ON l.cat_id = c.cat_id
    ORDER  BY l.dt_add DESC;';
  
    $res = mysqli_query($link, $sql);
    $lots = mysqli_fetch_all($res, MYSQLI_ASSOC);
    // print_r($lots);
}

if (isset($_COOKIE['history'])) {
    $id_lots = json_decode($_COOKIE['history']);

    // print_r($id_lots);

    foreach($lots as $key => $lot) {
        foreach($id_lots as $value) {
            if($lot['lot_id'] == $value) {
            $new_lots[] = $lot;
            }
        }
    }
    

    // print_r($new_lots);
    

    $history_page = renderTemplate($path_history,['new_lots' => $new_lots, 'time' => $time_left]);

} else {
    $history_page = renderTemplate($path_history,[]);
}


$layout_page = renderTemplate($path_layout, ['content' => $history_page, 'categories' => $categories, 'username' => $_SESSION['user']['name'], 'user_avatar' => $_SESSION['user']['user_avatar'], 'title' => 'История посещения']);
print $layout_page;


?>
