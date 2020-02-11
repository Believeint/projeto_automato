<?php

switch ($_REQUEST['page']) {
    case 'imp-arquivo':
        include 'importCsv.php';
        break;

    case 'cons-arquivo':
        include 'pesqArquivo.php';
        break;

    default:
        include 'dashboard.php';
        break;
}
