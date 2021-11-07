<?php
require_once 'functions.php';
require_once 'data.php';

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


if (isset($_GET['id_lot'])) {
   $lot = $lots[$_GET['id_lot'] - 1];
} else {
    $lot = null;
}

if (!$lot) {
    http_response_code(404);
}

$page_lot = renderTemplate($path_lot,['lot' => $lot]);
$layout_lot = renderTemplate($path_layout, ['content' => $page_lot, 'categories' => $categories, 'is_auth' => $is_auth, 'user_name' => $user_name, 'user_avatar' => $user_avatar, 'title' => $lot['title']]);
print $layout_lot;
?>