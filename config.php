<?php 
require_once 'vendor/autoload.php';

$mainPage = ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php');
define('MAIN_PAGE', $mainPage);

const DB_CONFIG = [
  'host' => 'yeticave-master',
  'user' => 'root',
  'password' => '',
  'port' => 3306,
  'database' => 'yeticave'
];