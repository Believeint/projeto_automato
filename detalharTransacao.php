<?php

if (isset($_REQUEST['id'])) {
    $db = DB::getInstance();
    $id = $_REQUEST['id'];

    $db->get("Transacao", array('Transacao_ID', '=', $id));

    $resultados = $db->results();

    foreach ($resultados as $resultado) {
        $resultado->valor_bruto = $db->formatMoney($resultado->valor_bruto, 'real');
        $resultado->valor_desconto = $db->formatMoney($resultado->valor_desconto, 'real');
        $resultado->valor_taxa = $db->formatMoney($resultado->valor_taxa, 'real');
        $resultado->valor_liquido = $db->formatMoney($resultado->valor_liquido, 'real');
        $resultado->valor_recebido = $db->formatMoney($resultado->valor_recebido, 'real');
        $resultado->valor_tarifa_intermediacao = $db->formatMoney($resultado->valor_tarifa_intermediacao, 'real');
        $resultado->valor_taxa_intermediacao = $db->formatMoney($resultado->valor_taxa_intermediacao, 'real');
        $resultado->valor_taxa_parcelamento = $db->formatMoney($resultado->valor_taxa_parcelamento, 'real');
        $resultado->valor_tarifa_boleto = $db->formatMoney($resultado->valor_tarifa_boleto, 'real');

    }

} else {
    header("Location: index.php");
}

?>
<div class="container">
<h4 class="text-center" style="margin-bottom: 50px;">Detalhar transação <span class="badge badge-secondary"><i class="fa fa-info-circle"></i></span></h4>

<?php foreach ($resultados as $resultado): ?>
    <?php foreach ($resultado as $key => $value): ?>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center h5 text-capitalize">
                <?php echo escape($key); ?>
                <span class="badge badge-primary badge-pill">  <?php echo escape($value); ?></span>
            </li>
        </ul>
    <?php endforeach;?>
<?php endforeach;?>




</div>
