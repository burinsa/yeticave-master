<?php 

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

print_r($id_lots);


?>