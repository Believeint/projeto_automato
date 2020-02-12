<?php

require 'Core/init.php';

$db = DB::getInstance();

$sql = "INSERT INTO teste2 (nome, nome2) VALUES('elias', 'elias2')";

if ($db->query($sql)) {
    echo "Success!";
} else {
    echo "Fail!";
}

var_dump($db);
?>
<h1>HELLO</h1>
