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
<h4 class="text-center" style="margin-bottom: 50px;">Relatório/Arquivo <span class="badge badge-secondary"><i class="fa fa-file-text-o"></i></span></h4>
<div class="container">

  <?php foreach ($grupos as $transacoes): ?>
    <?php foreach ($transacoes as $transacao): ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?php echo $transacao->serial_leitor; ?></th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
            </tbody>
            </table>
    <?php endforeach;?>
  <?php endforeach;?>

</div>
