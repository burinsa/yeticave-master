<?php 
require_once 'data.php';
require_once 'functions.php';
session_start();

if (isset($_COOKIE['history'])) {
    $id_lots = json_decode($_COOKIE['history']);

    foreach($id_lots as $value) {
        $new_lots[$value - 1] = $lots[$value - 1];
    }
    

    $history_page = renderTemplate($path_history,['lots' => $lots, 'new_lots' => $new_lots, 'time' => $time_left]);

} else {
    $history_page = renderTemplate($path_history,[]);
}


$layout_page = renderTemplate($path_layout, ['content' => $history_page, 'categories' => $categories, 'username' => $_SESSION['user']['name'], 'user_avatar' => $user_avatar, 'title' => 'История посещения']);
print $layout_page;


?>
