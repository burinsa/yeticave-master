<?php
// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

/////////////////////////////////////////

$path_index = '\inpex.php';
$path_layout = '\layout.php';
$path_lot = '\lot.php';
$path_add = '\add-lot.php';
$path_history = '\history-lots.php';
$path_login = '\login.php';
$path_sign_up = '\sign-up.php';
$page_error = '\error.php';
$page_search = '\search.php';
$page_pagination = '\pagination.php';

///////////////////////////////////////

// $is_auth = (bool) rand(0, 1);
// $categories = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];

// $user_name = 'Константин';
// $user_avatar = 'img/user.jpg';


