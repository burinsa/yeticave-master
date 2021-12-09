<?php
require_once 'functions.php';
require_once 'init.php';
require_once 'vendor/autoload.php';
session_start();

if(!isset($_SESSION['user'])) {
    http_response_code(403);
    exit();
}

function selected ($option, $val) {
    return ($option == $val) ? 'selected' : '';
}


if (!$link) {
    $error = mysqli_connect_error();
    $page_content = renderTemplate($page_error,['erorr' => $error]);
    $layout_page = renderTemplate($path_layout, ['content' => $page_content, 'categories' => $categories, 'title' => 'Вход']);
  }
  else {
    $sql = 'SELECT `cat_id`, `cat_name` FROM categories
    ORDER BY `cat_id`';
    $result = mysqli_query($link, $sql);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
   
    // print_r($_SESSION['user']['user_id']);
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
    
    
        if (!empty($_FILES['photo2']['name'])) {
            $file_name = $_FILES['photo2']['name'];
            $file_path = __DIR__ . 'img/';
            $file_url = 'img/' . $file_name;
            $file_type = $_FILES['photo2']['type'];
            
    
            if ($file_type !== 'image/png' && $file_type !== 'image/jpeg') {
                $errors['file'] = 'Загрузите изображение в формате "jpeg", "jpg", "png"';
            } else {
                move_uploaded_file($_FILES['photo2']['tmp_name'], $file_url);
                $lot['img'] = $file_url;
            }
        } else {
            $lot['img'] = null;
        }
        
        
    
        if($_POST['category'] == 'Выберите категорию') {
            $errors[$dest['category']] = 'Выберите категорию';
        }
        
        if (count($errors)) {
            $page_add = renderTemplate($path_add, ['errors' => $errors, 'lot' => $lot]);
        } else {
            foreach ($categories as $key => $value) {
                if ($lot['category'] == $value['cat_name']) {
                    $category = $value['cat_id'];
                }
            }
            $name = $lot['title'];
            $description = $lot['description'];
            $img = $lot['img'];
            $price = $lot['price'];
            $step = $lot['lot-step'];
            $date = $lot['lot-date'];
            $user_id = $_SESSION['user']['user_id'];

            $sql = 'INSERT INTO lots(dt_add, lot_name, lot_desc, lot_img, lot_price, lot_date, lot_step, `user_id`, `cat_id`)
            VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, 'sssisiii', $name, $description, $img, $price, $date, $step, $user_id, $category);
            $res = mysqli_stmt_execute($stmt);


            if ($res) {
                $id_lot = mysqli_insert_id($link);
                $sql = 'SELECT `lot_id`, l.lot_name AS `title`, c.cat_name AS `category`, l.lot_price AS `price`, l.lot_img AS `img`, l.lot_desc AS `description`,  l.lot_date AS `lot-date`, l.lot_step AS step, l.user_id AS user  FROM lots AS l 
                JOIN categories AS c ON l.cat_id = c.cat_id
                WHERE l.lot_id = ' . $id_lot;
                $result = mysqli_query($link, $sql);
                $lot = mysqli_fetch_assoc($result);
                $page_add = renderTemplate($path_lot,['lot' => $lot, 'title' => $lot['title'], 'time' => $time_left, 'rates' => null ]);
            }
            // var_dump(mysqli_error($link));
            
        }
        
        // print(($_FILES['photo2']['name']));
        // var_dump(isset($_FILES['photo2']['name']));
        // var_dump(empty($_FILES['photo2']['name']));
        
    } else {
        $page_add = renderTemplate($path_add, []);
        
    }

  }


$layout_add = renderTemplate($path_layout, ['content' => $page_add, 'categories' => $categories, 'username' => $_SESSION['user']['name'], 'user_avatar' => $_SESSION['user']['user_avatar'], 'title' => 'Добавление лота']);

print $layout_add;
?>