<?php
require_once 'functions.php';
require_once 'data.php';


function selected ($option, $val) {
    return ($option == $val) ? 'selected' : '';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot = $_POST;

    $required = ['title', 'category', 'description', 'price', 'lot-step', 'lot-date'];
    $dest = ['title' => 'Наименование', 'category' => 'Категория', 'description' => 'Описание', 'price' => 'Начальная цена', 'lot-step' => 'Шаг ставки', 'lot-date' => 'Дата окончания торгов'];
    $errors = [];
    foreach ($required as $key) {
        if (empty($_POST[$key])) {
            $errors[$dest[$key]] = "Это поле нужно заполнить";
        }

    }
    
    if (filter_var($_POST['price'], FILTER_VALIDATE_INT))

    if($_POST['category'] == 'Выберите категорию') {
        $errors[$dest['category']] = 'Выберите категорию';
    }
    
    if (count($errors)) {
        $page_add = renderTemplate($path_add, ['errors' => $errors, 'lot' => $lot]);
    } else {
        $page_add = renderTemplate($path_lot,['lot' => $lot, 'title' => $lot['title'], 'time' => $time_left]);
    }
    // print_r($errors);
    // print '<br>';
    // print_r($lot);
    
} else {
    $page_add = renderTemplate($path_add, []);
    
}


$layout_add = renderTemplate($path_layout, ['content' => $page_add, 'categories' => $categories, 'is_auth' => $is_auth, 'user_name' => $user_name, 'user_avatar' => $user_avatar, 'title' => 'Добавление лота']);

print $layout_add;

?>