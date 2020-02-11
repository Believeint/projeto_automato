<?php

require_once "Core/init.php";

$db = DB::getInstance();

?>

<!DOCTYPE html>
<html>
    <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" Content="IE-edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Sistema | Automato</title>
            <link rel="stylesheet" href="css/font-awesome.min.css">
            <link rel="stylesheet" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="js/bootstrap.min.js">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom:50px;">
            <a class="navbar-brand text-monospace" href="#">AUTOMATO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?page=imp-arquivo"><i class="fa fa-download"></i>&nbsp;&nbsp;IMPORTAR NOVO CSV <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=cons-arquivo">CONSULTAR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
                </ul>
            </div>
        </nav>

        <?php
include 'config.php';
?>

        <script src="js/jquery3.4.min.js">
        <script src="js/popper116.min.js">
    </body>

</html>
