<?php

if ($_REQUEST['id']) {
    $id = $_REQUEST['id'];
    $db = DB::getInstance();
    $db->getJoinArquivoRelatorio($id);

    $resultados = $db->results();

} else {
    header('Location: index.php');
}

?>
<h4 class="text-center" style="margin-bottom: 50px;">Relatório/Arquivo <span class="badge badge-secondary"><i class="fa fa-file-text-o"></i></span></h4>
<div class="container">

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Cliente</th>
      <th scope="col">Liquido</th>
      <th scope="col">Lucro</th>
    </tr>
  </thead>
  <tbody>
    <?php $x = 1;
$lucro_tot = 0;?>
        <?php foreach ($resultados as $cliente): ?>
        <?php $lucro_tot += $cliente->lucro;?>
            <tr>
                <th scope="row"><?php echo $x; ?></th>
                <td><?php echo escape($cliente->nome); ?></td>
                <td><?php echo escape($db->formatMoney($cliente->liquido_cliente, 'real')); ?></td>
                <td><?php echo escape($db->formatMoney($cliente->lucro, 'real')); ?></td>
            </tr>
    <?php $x++;?>
        <?php endforeach;?>
        <thead class="thead-light">
            <th scope="row">Total</th>
            <th></th>
            <th></th>
            <th scope="row"><?php echo escape($db->formatMoney($lucro_tot, 'real')); ?></th>
        </thead>
  </tbody>
</table>


</div>
