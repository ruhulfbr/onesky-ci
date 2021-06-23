<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $host = 'localhost';
    $userName = 'root';
    $password = '';
    $database = 'onesky_db';
} else {
    $host = 'localhost';
    $userName = 'oneskyco_main';
    $password = 'o%K#e{N)=HXW';
    $database = 'oneskyco_main';
}

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'dsn' => '',
    'hostname' => $host,
    'username' => $userName,
    'password' => $password,
    'database' => $database,
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
