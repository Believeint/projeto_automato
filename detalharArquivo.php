
<?php

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $db = DB::getInstance();

    $db->getJoinTransacaoArquivo($id);

    $resultados = $db->results();

    $grupos = [];
    foreach ($resultados as $resultado) {
        $grupos[$resultado->serial_leitor][] = $resultado;
    }

} else {
    header('Location: index.php');
}

?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Total <span id="nome_cliente"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Liquido Cliente
                <span id="liquido_cliente" class="badge badge-primary badge-pill"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Lucro Total
                <span id="lucro" class="badge badge-primary badge-pill"></span>
            </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<div>
<h4 class="text-center">Detalhar arquivo <span class="badge badge-secondary"><i class="fa fa-search"></i></span></h4>
<p class="text-center" style="margin-bottom: 50px;"><?php echo escape($db->count()); ?> Resultado(s)</p>
</div>
<?php
$total_bruto = 0;
$total_recebido = 0;
$total_taxa_iss = 0;
$total_taxa_cliente = 0;
$is_client = false;
?>
<?php foreach ($grupos as $transacoes): ?>
			<?php foreach ($transacoes as $transacao) {if ($transacao->id != null) {$is_client = true;} else { $is_client = false;}}?>

				<table class="table <?php if ($is_client) {echo 'table-bordered';}?>">
				  <thead>
				    <tr>
				      <th scope="col">Serial Leitor</th>
				      <th scope="col">Debito/Crédito</th>
				      <th scope="col">Codigo da Venda</th>
				      <th scope="col">Tipo Pagamento</th>
				      <th scope="col">Parcelas</th>
				      <th scope="col">Valor Bruto</th>
				      <th scope="col">Valor Recebido</th>
				      <th scope="col">Taxa ISS</th>
				      <th scope="col">Taxa Cliente</th>
				      <th>Ações</th>

				    </tr>
				  </thead>
				  <tbody>
				    <?php foreach ($transacoes as $transacao): ?>

				<?php
$total_bruto += $transacao->valor_bruto;
$total_recebido += $transacao->valor_bruto - $transacao->valor_taxa;
if ($transacao->id != null) {$is_client = true;} else { $is_client = false;}
?>
				        <tr class="<?php if ($transacao->nome != null) {echo "thead-light";}?>">
				            <th><?php if ($transacao->nome != null) {echo escape($transacao->nome);} else {echo escape($transacao->serial_leitor);}?></th>
				            <td><?php echo escape($transacao->debito_credito); ?></td>
				            <td><?php echo escape($transacao->codigo_venda); ?></td>
				            <td><?php echo escape($transacao->tipo_pagamento); ?></td>
				            <td><?php echo escape($transacao->parcelas); ?></td>
				            <td><?php echo escape($db->formatMoney($transacao->valor_bruto, 'real')); ?></td>
				            <td><?php echo escape($db->formatMoney($transacao->valor_bruto - $transacao->valor_taxa, 'real')); ?></td>
				            <td>
				            <?php
if ($transacao->id != null) {
    switch ($transacao) {
        case $transacao->parcelas == 1:

            $total_taxa_iss += $transacao->valor_bruto * 0.005;
            echo $db->formatMoney($transacao->valor_bruto * 0.005, 'real');
            break;
        case $transacao->parcelas > 1 && $transacao->parcelas <= 7:
            $total_taxa_iss += $transacao->valor_bruto * 0.01;
            echo $db->formatMoney($transacao->valor_bruto * 0.01, 'real');
            break;
        case $transacao->parcelas > 7 && $transacao->parcelas <= 12:
            $total_taxa_iss += $transacao->valor_bruto * 0.015;
            echo $db->formatMoney($transacao->valor_bruto * 0.015, 'real');
            break;
        default:
            echo "N/A";
            break;
    }
} else {
    echo "N/A";
}

?>
				            </td>
				            <td>
				<?php
if ($transacao->id != null) {
    switch ($transacao) {
        case $transacao->parcelas == 1 && $transacao->debito_credito == "Débito":
            $total_taxa_cliente += $transacao->valor_bruto * $transacao->taxa_deb / 100;
            echo escape($db->formatMoney($transacao->valor_bruto * $transacao->taxa_deb / 100, 'real'));
            break;
        case $transacao->parcelas == 1 && $transacao->debito_credito == "Crédito":
            $total_taxa_cliente += $transacao->valor_bruto * $transacao->taxa_cred_1x / 100;
            echo escape($db->formatMoney($transacao->valor_bruto * $transacao->taxa_cred_1x / 100, 'real'));
            break;
        case $transacao->parcelas == 2 && $transacao->debito_credito == "Crédito":
            $total_taxa_cliente += $transacao->valor_bruto * $transacao->taxa_cred_2x / 100;
            echo escape($db->formatMoney($transacao->valor_bruto * $transacao->taxa_cred_2x / 100, 'real'));
            break;
        case $transacao->parcelas == 3 && $transacao->debito_credito == "Crédito":
            $total_taxa_cliente += $transacao->valor_bruto * $transacao->taxa_cred_3x / 100;
            echo escape($db->formatMoney($transacao->valor_bruto * $transacao->taxa_cred_3x / 100, 'real'));
            break;
        case $transacao->parcelas == 4 && $transacao->debito_credito == "Crédito":
            $total_taxa_cliente += $transacao->valor_bruto * $transacao->taxa_cred_4x / 100;
            echo escape($db->formatMoney($transacao->valor_bruto * $transacao->taxa_cred_4x / 100, 'real'));
            break;
        case $transacao->parcelas == 5 && $transacao->debito_credito == "Crédito":
            $total_taxa_cliente += $transacao->valor_bruto * $transacao->taxa_cred_5x / 100;
            echo escape($db->formatMoney($transacao->valor_bruto * $transacao->taxa_cred_5x / 100, 'real'));
            break;
        case $transacao->parcelas == 6 && $transacao->debito_credito == "Crédito":
            $total_taxa_cliente += $transacao->valor_bruto * $transacao->taxa_cred_6x / 100;
            echo escape($db->formatMoney($transacao->valor_bruto * $transacao->taxa_cred_6x / 100, 'real'));
            break;
        case $transacao->parcelas == 7 && $transacao->debito_credito == "Crédito":
            $total_taxa_cliente += $transacao->valor_bruto * $transacao->taxa_cred_7x / 100;
            echo escape($db->formatMoney($transacao->valor_bruto * $transacao->taxa_cred_7x / 100, 'real'));
            break;
        case $transacao->parcelas == 8 && $transacao->debito_credito == "Crédito":
            $total_taxa_cliente += $transacao->valor_bruto * $transacao->taxa_cred_8x / 100;
            echo escape($db->formatMoney($transacao->valor_bruto * $transacao->taxa_cred_8x / 100, 'real'));
            break;
        case $transacao->parcelas == 9 && $transacao->debito_credito == "Crédito":
            $total_taxa_cliente += $transacao->valor_bruto * $transacao->taxa_cred_9x / 100;
            echo escape($db->formatMoney($transacao->valor_bruto * $transacao->taxa_cred_9x / 100, 'real'));
            break;
        case $transacao->parcelas == 10 && $transacao->debito_credito == "Crédito":
            $total_taxa_cliente += $transacao->valor_bruto * $transacao->taxa_cred_10x / 100;
            echo escape($db->formatMoney($transacao->valor_bruto * $transacao->taxa_cred_10x / 100, 'real'));
            break;
        case $transacao->parcelas == 11 && $transacao->debito_credito == "Crédito":
            $total_taxa_cliente += $transacao->valor_bruto * $transacao->taxa_cred_11x / 100;
            echo escape($db->formatMoney($transacao->valor_bruto * $transacao->taxa_cred_11x / 100, 'real'));
            break;
        case $transacao->parcelas == 12 && $transacao->debito_credito == "Crédito":
            $total_taxa_cliente += $transacao->valor_bruto * $transacao->taxa_cred_12x / 100;
            echo escape($db->formatMoney($transacao->valor_bruto * $transacao->taxa_cred_12x / 100, 'real'));
            break;

        default:
            echo "N/A";
            break;
    }
} else {
    echo "N/A";
}
?>
				            </td>
				            <td><a href="index.php?page=det-transacao&id=<?php echo $transacao->transacao_id; ?>" title="Detalhes da Transação"><i class="fa fa-info-circle"></i></a></td>
				        </tr>

				    <?php endforeach;?>
    <tr class="<?php if ($is_client) {echo "thead-light";}?>">
            <th>Total</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>
<?php if ($total_bruto != 0) {echo escape($db->formatMoney($total_bruto, 'real'));
    $total_bruto = 0;} else {echo "N/A";}
?>
            </th>
            <th>
<?php if ($total_recebido != 0) {echo escape($db->formatMoney($total_recebido, 'real'));
} else {echo "N/A";}
?>
            </th>
            <th>
<?php if ($total_taxa_iss != 0) {echo escape($db->formatMoney($total_taxa_iss, 'real'));
} else {echo "N/A";}
?>
            </th>
            <th>
<?php if ($total_taxa_cliente != 0) {echo escape($db->formatMoney($total_taxa_cliente, 'real'));
} else {echo "N/A";}
?>
            </th>
            <th>
<?php

$liquido_cliente = $db->formatMoney($total_recebido - $total_taxa_cliente, 'real');
$lucro = $db->formatMoney($total_recebido - $total_taxa_cliente - $total_taxa_iss, 'real');

if ($is_client) {echo "<a href='#' title='Total Cliente' onclick=\"enviarTotal('$liquido_cliente', '$lucro')\" data-toggle='modal' data-target='#myModal'><i class='fa fa-search-plus' ></i></a>";}
?>
            </th>
        </tr>
  </tbody>
</table>
<hr/>
<?php $is_client = false;?>
<?php
$total_recebido = 0;
$total_taxa_iss = 0;
$total_taxa_cliente = 0;
?>
    <?php endforeach;?>

<script>
    function enviarTotal(liquidoc, lucro) {
        $('#liquido_cliente').html(liquidoc);
        $('#lucro').html(lucro);
        $('#showmodal').modal('show');
    }
</script>

