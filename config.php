<?php

if (!isset($_REQUEST['page'])) {
    $_REQUEST['page'] = '';
}

switch ($_REQUEST['page']) {
    case 'imp-arquivo':
        include 'importarArquivo.php';
        break;
    case 'pes-arquivo':
        include 'pesquisarArquivo.php';
        break;
    case 'det-arquivo':
        include 'detalharArquivo.php';
        break;
    case 'det-transacao':
        include 'detalharTransacao.php';
        break;
    case 'cad-cliente':
        include 'cadastrarCliente.php';
        break;
    default:
        include 'dashboard.php';
        break;
}
