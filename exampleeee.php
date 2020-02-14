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
    <?php foreach ($resultados as $resultado): ?>
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