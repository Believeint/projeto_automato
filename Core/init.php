<?php//error_reporting(E_ALL);session_start();$GLOBALS['config'] = array(    'mysql' => array(        'host' => 'localhost',        'username' => 'root',        'password' => 'adm371',        'db' => 'automatic_db',    ),    'SITE_ROOT' => __DIR__,);date_default_timezone_set("America/sao_paulo");spl_autoload_register(function ($class) {    require_once ("Models/" . $class . ".php");});require_once 'Functions/sanitize.php';require_once 'Functions/formataPorcentagem.php';