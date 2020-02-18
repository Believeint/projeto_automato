<?php

require_once "Core/init.php";

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" Content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema | Automatic</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom:50px;">
        <img src="imagens/logo.png" width="70px" alt="">
        <a class="navbar-brand text-monospace font-weight-bold" href="#">AUTOMATIC</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?page=imp-arquivo"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;IMPORTAR NOVO CSV <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-archive"></i>&nbsp;ARQUIVO
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="index.php?page=pes-arquivo">Consultar</a>
                        <a class="dropdown-item disabled" href="#">Disabled</a>
                        <a class="dropdown-item disabled" href="#">Disabled</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa fa-user"></i>&nbsp;CLIENTE
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="index.php?page=cad-cliente">Cadastrar</a>
                        <a class="dropdown-item" href="#">Consultar</a>
                        <a class="dropdown-item disabled" href="#">Disabled</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
        </div>
    </nav>

<?php

if (Session::exists('home')) {
    echo "<div id='alert' class='alert alert-success text-center' role='alert'>" . Session::flash('home') . "</div>";
}

include 'config.php';

?>
    <script type="text/javascript">
        setTimeout(function () {
            $("#alert").fadeOut();
        }, 2000);
    </script>
    <script src="js/jquery.js"></script>
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
