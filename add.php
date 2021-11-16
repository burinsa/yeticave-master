<?php
require_once 'functions.php';
require_once 'data.php';
session_start();

if(!isset($_SESSION['user'])) {
    http_response_code(403);
    exit();
}

function selected ($option, $val) {
    return ($option == $val) ? 'selected' : '';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot = $_POST;

    $required = ['title', 'category', 'description', 'price', 'lot-step', 'lot-date'];
    $dest = ['title' => 'Наименование', 'category' => 'Категория', 'description' => 'Описание', 'price' => 'Начальная цена', 'lot-step' => 'Шаг ставки', 'lot-date' => 'Дата окончания торгов'];
    $errors = [];
    foreach ($required as $value) {
        if (empty($_POST[$value])) {
            $errors[$dest[$value]] = "Это поле нужно заполнить";
        }  else {
            if ($value == 'price') {
                if (!filter_var($_POST['price'], FILTER_VALIDATE_INT)) {
                    $errors[$dest[$value]] = "Допускается ввод только чисел";
                }
            } elseif ($value == 'lot-step') {
                if (!filter_var($_POST['lot-step'], FILTER_VALIDATE_INT)) {
                    $errors[$dest[$value]] = "Допускается ввод только чисел";
                }
            }
        }

    }

    if (isset($_FILES['photo2'])) {
        $file_name = $_FILES['photo2']['name'];
        $file_path = __DIR__ . 'img/';
        $file_url = 'img/' . $file_name;
        move_uploaded_file($_FILES['photo2']['tmp_name'], $file_url);

        $lot['img'] = $file_url;
    }
    
    

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
    // print_r ($_FILES['photo2']);
    
} else {
    $page_add = renderTemplate($path_add, []);
    
}


$layout_add = renderTemplate($path_layout, ['content' => $page_add, 'categories' => $categories, 'username' => $_SESSION['user']['name'], 'user_avatar' => $_SESSION['user']['user_avatar'], 'title' => 'Добавление лота']);

print $layout_add;

?>