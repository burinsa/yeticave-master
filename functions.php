<?php

date_default_timezone_set('Europe/Kaliningrad');

// отрисовка шаблона

function renderTemplate ($name, $data) {
    $path = 'templates' . $name;
    if (!file_exists($path)) {
        return $result = '';
    }
    ob_start();
    extract($data);
    include $path;
    $result = ob_get_clean();
    return $result;    
}

// округление цены

function format_price ($number) {
    $price = ceil($number);
    if ($price <= 1000) {
        return $price . '<b class="rub">р</b>';
    } else {
        return number_format($price) . ' ₽';
    }
};

$time_left = date('G:i' ,(strtotime("tomorrow") - time()));

function timer ($time) {
    $day = (strtotime($time) - strtotime("today")) / 86400;
    if ($day < 1) {
        return date('Gч : iм' ,(strtotime("tomorrow") - time()));
    } else {
        return "Дней: {$day},  " . date('Gч : iм' ,(strtotime("tomorrow") - time()));
    }
}

// поиск пользователя по email

function searchUserByEmail ($email, $users) {
    $result = null;
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            $result = $user;
            break;
        }
    }
    return $result;
}
