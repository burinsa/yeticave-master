<?php
require_once 'functions.php';
require_once 'data.php';
date_default_timezone_set('Europe/Kaliningrad');
$tomorrow = strtotime("tomorrow");


$page = renderTemplate($path_page,['lots' => $lots, 'time' => $time_left]);
$layout_page = renderTemplate($path_layout, ['content' => $page, 'categories' => $categories, 'is_auth' => $is_auth, 'user_name' => $user_name, 'user_avatar' => $user_avatar, 'title' => 'Главная']);
print $layout_page;

?>

