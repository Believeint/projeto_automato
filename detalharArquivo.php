<?php

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $db = DB::getInstance();

    $db->getJoinTransacaoArquivo($id);

    $resultados = $db->results();

    foreach ($resultados as $resultado) {
        $resultado->valor_bruto = $db->formatMoney($resultado->valor_bruto, 'real');
        $resultado->valor_recebido = $db->formatMoney($resultado->valor_recebido, 'real');
    }

    $group = [];
    foreach ($resultados as $resultado) {
        $clientes[$resultado->serial_leitor][] = $resultado;
    }

} else {
    header('Location: index.php');
}

?>

<div>
<h4 class="text-center">Detalhar arquivo <span class="badge badge-secondary"><i class="fa fa-search"></i></span></h4>
<p class="text-center" style="margin-bottom: 50px;"><?php echo escape($db->count()); ?> Resultado(s)</p>
</div>
<?php foreach ($clientes as $cliente): ?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Serial Leitor</th>
      <th scope="col">Debito/Crédito</th>
      <th scope="col">Tipo Pagamento</th>
      <th scope="col">Parcelas</th>
      <th scope="col">Valor Bruto</th>
      <th scope="col">Valor Recebido</th>
      <th scope="col">Taxa ISS</th>
      <th>Ações</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($cliente as $resultado): ?>
        <tr>
            <th><?php echo escape($resultado->serial_leitor); ?></th>
            <td><?php echo escape($resultado->debito_credito); ?></td>
            <td><?php echo escape($resultado->tipo_pagamento); ?></td>
            <td><?php echo escape($resultado->parcelas); ?></td>
            <td><?php echo escape($resultado->valor_bruto); ?></td>
            <td><?php echo escape($resultado->valor_recebido); ?></td>
            <td>

            <?php
switch ($resultado) {
    case $resultado->parcelas == 1:
        $resultado->valor_bruto = number_format(str_replace(',', '.', str_replace('.', '', str_replace('R$', '', $resultado->valor_bruto))), 2, '.', '');
        echo $db->formatMoney($resultado->valor_bruto * 0.005, 'real');
        break;
    case $resultado->parcelas > 1 && $resultado->parcelas <= 7:
        $resultado->valor_bruto = number_format(str_replace(',', '.', str_replace('.', '', str_replace('R$', '', $resultado->valor_bruto))), 2, '.', '');
        echo $db->formatMoney($resultado->valor_bruto * 0.01, 'real');
        break;
    case $resultado->parcelas > 7 && $resultado->parcelas <= 12:
        $resultado->valor_bruto = number_format(str_replace(',', '.', str_replace('.', '', str_replace('R$', '', $resultado->valor_bruto))), 2, '.', '');
        echo $db->formatMoney($resultado->valor_bruto * 0.015, 'real');
        break;
    default:
        echo "N/A";
        break;
}
?>
            </td>
            <td><a href="index.php?page=det-transacao&id=<?php echo $resultado->transacao_id; ?>" title="Detalhes"><i class="fa fa-info-circle"></i></a></td>
        </tr>
    <?php endforeach;?>
  </tbody>
</table>
<hr/>
    <?php endforeach;?>
