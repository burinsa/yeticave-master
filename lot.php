<?php
require_once 'functions.php';
require_once 'data.php';

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