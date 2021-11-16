<?php
require_once 'functions.php';
require_once 'data.php';
session_start();
date_default_timezone_set('Europe/Kaliningrad');
$tomorrow = strtotime("tomorrow");


$page = renderTemplate($path_index,['lots' => $lots, 'time' => $time_left]);

if (isset($_SESSION['user'])) {
  $layout_page = renderTemplate($path_layout, ['content' => $page, 'categories' => $categories, 'username' => $_SESSION['user']['name'], 'user_avatar' => $_SESSION['user']['user_avatar'], 'title' => 'Главная']);
} else {
  $layout_page = renderTemplate($path_layout, ['content' => $page, 'categories' => $categories, 'title' => 'Главная']);
}
print $layout_page;
print_r($_SESSION);
?>

