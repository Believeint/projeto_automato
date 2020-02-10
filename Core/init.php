<?php

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'automato'
    ),
    'SITE_ROOT' => __DIR__
);

spl_autoload_register(function ($class) {
    require_once  ("Models/" . $class . ".php");
});


require_once 'Functions/sanitize.php';