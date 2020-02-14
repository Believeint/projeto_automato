<?php

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $db = DB::getInstance();

    $db->getJoinTransacaoArquivo($id);

    $resultados = $db->results();

    $group = [];
    foreach ($resultados as $resultado) {
        $clientes[$resultado->serial_leitor][] = $resultado;
    }

} else {
    header('Location: index.php');
}

?>

<h4 class="text-center" style="margin-bottom: 50px;">Detalhar arquivo <span class="badge badge-secondary"><i class="fa fa-search"></i></span></h4>
<?php foreach ($clientes as $cliente): ?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Serial Leitor</th>
      <th scope="col">Debito/Crédito</th>
      <th scope="col">Tipo Pagamento</th>
      <th scope="col">Valor Bruto</th>
      <th scope="col">Valor Taxa</th>
      <th scope="col">Parcelas</th>
      <th scope="col">Data Transação</th>
      <th scope="col">Valor Recebido</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($cliente as $resultado): ?>
        <tr>
            <th><?php echo escape($resultado->serial_leitor); ?></th>
            <td><?php echo escape($resultado->debito_credito); ?></td>
            <td><?php echo escape($resultado->tipo_pagamento); ?></td>
            <td><?php echo escape($resultado->valor_bruto); ?></td>
            <td><?php echo escape($resultado->valor_taxa); ?></td>
            <td><?php echo escape($resultado->parcelas); ?></td>
            <td><?php echo escape($resultado->data_transacao); ?></td>
            <td><?php echo escape($resultado->valor_recebido); ?></td>
        </tr>
    <?php endforeach;?>
  </tbody>
</table>
<hr/>
    <?php endforeach;?>
