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
    case 'pes-cliente':
        include 'pesquisarCliente.php';
        break;
    case 'edi-cliente':
        include 'editarCliente.php';
        break;
    case 'ger-arquivo':
        include 'gerarRelatorio.php';
        break;
    case 'rel-arquivo':
        include 'relatorioArquivo.php';
        break;
    default:
        include 'importarArquivo.php';
        break;
}
