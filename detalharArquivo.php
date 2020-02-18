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

    $grupos = [];
    foreach ($resultados as $resultado) {
        $grupos[$resultado->serial_leitor][] = $resultado;
    }

} else {
    header('Location: index.php');
}

var_dump($resultados);

?>

<div>
<h4 class="text-center">Detalhar arquivo <span class="badge badge-secondary"><i class="fa fa-search"></i></span></h4>
<p class="text-center" style="margin-bottom: 50px;"><?php echo escape($db->count()); ?> Resultado(s)</p>
</div>
<?php foreach ($grupos as $transacoes): ?>
<table class="table">
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
        <tr>
            <th><?php if ($transacao->nome != null) {echo escape($transacao->nome);} else {echo escape($transacao->serial_leitor);}?></th>
            <td><?php echo escape($transacao->debito_credito); ?></td>
            <td><?php echo escape($transacao->codigo_venda); ?></td>
            <td><?php echo escape($transacao->tipo_pagamento); ?></td>
            <td><?php echo escape($transacao->parcelas); ?></td>
            <td><?php echo escape($transacao->valor_bruto); ?></td>
            <td><?php echo escape($transacao->valor_recebido); ?></td>
            <td>
            <?php
switch ($transacao) {
    case $transacao->parcelas == 1:
        $transacao->valor_bruto = number_format(str_replace(',', '.', str_replace('.', '', str_replace('R$', '', $transacao->valor_bruto))), 2, '.', '');
        echo $db->formatMoney($transacao->valor_bruto * 0.005, 'real');
        break;
    case $transacao->parcelas > 1 && $transacao->parcelas <= 7:
        $transacao->valor_bruto = number_format(str_replace(',', '.', str_replace('.', '', str_replace('R$', '', $transacao->valor_bruto))), 2, '.', '');
        echo $db->formatMoney($transacao->valor_bruto * 0.01, 'real');
        break;
    case $transacao->parcelas > 7 && $transacao->parcelas <= 12:
        $transacao->valor_bruto = number_format(str_replace(',', '.', str_replace('.', '', str_replace('R$', '', $transacao->valor_bruto))), 2, '.', '');
        echo $db->formatMoney($transacao->valor_bruto * 0.015, 'real');
        break;
    default:
        echo "N/A";
        break;
}
?>
            </td>
            <td><?php switch ($transacao) {
    case $transacao->parcelas == 10:
        $transacao->valor_bruto = number_format(str_replace(',', '.', str_replace('.', '', str_replace('R$', '', $transacao->valor_bruto))), 2, '.', '');
        $calculo = $transacao->valor_bruto * $transacao->taxa_cred_10x / 100;
        echo $db->formatMoney($calculo, 'real');
        break;

    default:
        # code...
        break;
}?></td>
            <td><a href="index.php?page=det-transacao&id=<?php echo $transacao->transacao_id; ?>" title="Detalhes"><i class="fa fa-info-circle"></i></a></td>
        </tr>
    <?php endforeach;?>
  </tbody>
</table>
<hr/>
    <?php endforeach;?>
