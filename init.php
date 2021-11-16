<?php 

require_once 'config.php';

$link = mysqli_connect(DB_CONFIG['host'], DB_CONFIG['user'], DB_CONFIG['password'], DB_CONFIG['database'], DB_CONFIG['port']);
mysqli_set_charset($link, "utf8");

