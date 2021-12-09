<?php
require_once 'functions.php';
require_once 'data.php';
require_once 'init.php';
require_once 'vendor/autoload.php';
session_start();

if (!$link) {
  $error = mysqli_connect_error();
  $page_content = renderTemplate($page_error,['erorr' => $error]);
  $layout_page = renderTemplate($path_layout, ['content' => $page_content, 'categories' => $categories, 'title' => 'Вход']);
}
else {
  $lot_id = $_GET['id_lot'];
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bet = $_POST;
    $required = 'cost';
    if (filter_var($bet['cost'], FILTER_VALIDATE_INT)) {
    
      if(isset($bet['cost']) && $_SESSION['user']) {
        $user_id = $_SESSION['user']['user_id'];
        $bet_amount = intval($bet['cost']);        
        $sql = "INSERT INTO rate (`rate_date`, `rate_amount`, `user_id`, `lot_id`) VALUES (NOW(), $bet_amount, $user_id, $lot_id)";
        $res = mysqli_query($link, $sql);
        if($res) {
        header("location: lot.php?id_lot=" . $lot_id);
        }
      }
    } else {
      header("location: lot.php?id_lot=" . $lot_id);
    }


}  
  
}