<?php

//error_reporting(0);

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => 'adm371',
        'db' => 'automato',
    ),
    'SITE_ROOT' => __DIR__,
);

date_default_timezone_set("America/sao_paulo");

spl_autoload_register(function ($class) {
    require_once ("Models/" . $class . ".php");
});

require_once 'Functions/sanitize.php';
