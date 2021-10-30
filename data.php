<?php
// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

/////////////////////////////////////////

$path_page = '\inpex.php';
$path_layout = '\layout.php';
$path_lot = '\lot.php';
$path_add = '\add-lot.php';

///////////////////////////////////////

$is_auth = (bool) rand(0, 1);
$categories = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];
$lots = [
    ['title' => '2014 Rossignol District Snowboard', 'category' => 'Доски и лыжи', 'price' => '10999', 'img' => 'img/lot-1.jpg', 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum praesentium dolorum minima quae excepturi veniam maiores temporibus reiciendis, aliquam iure. Ut nulla, culpa necessitatibus eaque nemo libero! Nemo, dolores repudiandae.
    Optio deserunt expedita eius fugiat odit ab tempora laborum omnis, quis enim modi? Veniam repellendus officia eligendi expedita eaque minus dolore at fugit similique nesciunt, aperiam itaque. Nemo, repudiandae dolorum.', 'lot-date' => '10-11-2021'],
    ['title' => 'DC Ply Mens 2016/2017 Snowboard', 'category' => 'Доски и лыжи', 'price' => '159999', 'img' => 'img/lot-2.jpg', 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum praesentium dolorum minima quae excepturi veniam maiores temporibus reiciendis, aliquam iure. Ut nulla, culpa necessitatibus eaque nemo libero! Nemo, dolores repudiandae.
    Optio deserunt expedita eius fugiat odit ab tempora laborum omnis, quis enim modi? Veniam repellendus officia eligendi expedita eaque minus dolore at fugit similique nesciunt, aperiam itaque. Nemo, repudiandae dolorum.', 'lot-date' => '10-11-2021'],
    ['title' => 'Крепления Union Contact Pro 2015 года размер L/XL', 'category' => 'Крепления', 'price' => '8000', 'img' => 'img/lot-3.jpg', 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum praesentium dolorum minima quae excepturi veniam maiores temporibus reiciendis, aliquam iure. Ut nulla, culpa necessitatibus eaque nemo libero! Nemo, dolores repudiandae.
    Optio deserunt expedita eius fugiat odit ab tempora laborum omnis, quis enim modi? Veniam repellendus officia eligendi expedita eaque minus dolore at fugit similique nesciunt, aperiam itaque. Nemo, repudiandae dolorum.', 'lot-date' => '10-11-2021'],
    ['title' => 'Ботинки для сноуборда DC Mutiny Charocal', 'category' => 'Ботинки', 'price' => '10999', 'img' => 'img/lot-4.jpg', 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum praesentium dolorum minima quae excepturi veniam maiores temporibus reiciendis, aliquam iure. Ut nulla, culpa necessitatibus eaque nemo libero! Nemo, dolores repudiandae.
    Optio deserunt expedita eius fugiat odit ab tempora laborum omnis, quis enim modi? Veniam repellendus officia eligendi expedita eaque minus dolore at fugit similique nesciunt, aperiam itaque. Nemo, repudiandae dolorum.', 'lot-date' => '10-11-2021'],
    ['title' => 'Куртка для сноуборда DC Mutiny Charocal', 'category' => 'Одежда', 'price' => '7500', 'img' => 'img/lot-5.jpg', 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum praesentium dolorum minima quae excepturi veniam maiores temporibus reiciendis, aliquam iure. Ut nulla, culpa necessitatibus eaque nemo libero! Nemo, dolores repudiandae.
    Optio deserunt expedita eius fugiat odit ab tempora laborum omnis, quis enim modi? Veniam repellendus officia eligendi expedita eaque minus dolore at fugit similique nesciunt, aperiam itaque. Nemo, repudiandae dolorum.', 'lot-date' => '10-11-2021'],
    ['title' => 'Маска Oakley Canopy', 'category' => 'Разное', 'price' => '5400', 'img' => 'img/lot-6.jpg', 'discription' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum praesentium dolorum minima quae excepturi veniam maiores temporibus reiciendis, aliquam iure. Ut nulla, culpa necessitatibus eaque nemo libero! Nemo, dolores repudiandae.
    Optio deserunt expedita eius fugiat odit ab tempora laborum omnis, quis enim modi? Veniam repellendus officia eligendi expedita eaque minus dolore at fugit similique nesciunt, aperiam itaque. Nemo, repudiandae dolorum.', 'lot-date' => '10-11-2021']
];
$user_name = 'Константин';
$user_avatar = 'img/user.jpg';


