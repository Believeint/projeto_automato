<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    function myFunction() {
   $('#alerta').fadeIn(100);
   setTimeout(function() {
       $('#alerta').fadeOut(100);
   }, 100);
}
</script>
<?php

include 'Models/Csv.php';

if (isset($_POST['Import'])) {
    try {

        $n_arquivo = $_FILES['arq_csv']['tmp_name'];
        $csv = new Csv($n_arquivo);
        // Mapeia CSV
        $map = array(
            "Transacao_ID" => "transacao_id",
            "Cliente_Nome" => "cliente_nome",
            "Cliente_Email" => "cliente_email",
            "Debito_Credito" => "debito_credito",
            "Tipo_Transacao" => "tipo_transacao",
            "Status" => "status",
            "Tipo_Pagamento" => "tipo_pagamento",
            "Valor_Bruto" => "valor_bruto",
            "Valor_Desconto" => "valor_desconto",
            "Valor_Taxa" => "valor_taxa",
            "Valor_Liquido" => "valor_liquido",
            "Transportadora" => "transportadora",
            "Num_Envio" => "num_envio",
            "Data_Transacao" => "data_transacao",
            "Data_Compensacao" => "data_compensacao",
            "Ref_Transacao" => "ref_transacao",
            "Parcelas" => "parcelas",
            "Codigo_Usuario" => "codigo_usuario",
            "Codigo_Venda" => "codigo_venda",
            "Serial_Leitor" => "serial_leitor",
            "Recebimentos" => "recebimentos",
            "Recebidos" => "recebidos",
            "Valor_Recebido" => "valor_recebido",
            "Valor_Tarifa_Intermediacao" => "valor_tarifa_intermediacao",
            "Valor_Taxa_Intermediacao" => "valor_taxa_intermediacao",
            "Valor_Taxa_Parcelamento" => "valor_taxa_parcelamento",
            "Valor_Tarifa_Boleto" => "valor_tarifa_boleto",
            "Bandeira_Cartao_Credito" => "bandeira_cartao_credito",
        );

        $csv->setAssociations($map);
        $rows = $csv->getRows();

        // Armazena arquivo
        $db = DB::getInstance();
        $dbh = $db->pdo();
        $dbh->beginTransaction();

        $arquivo = array(
            "data_envio" => date('Y-m-d H:i:s'),
        );
        $db->insert("Arquivo", $arquivo);
        $id_arq = $db->lastid();

        foreach ($rows as $row) {
            $transacao = array(
                'transacao_id' => $row['transacao_id'],
                'cliente_nome' => $row['cliente_nome'],
                'cliente_email' => $row['cliente_email'],
                'debito_credito' => $row['debito_credito'],
                'tipo_transacao' => $row['tipo_transacao'],
                'status' => $row['status'],
                'tipo_pagamento' => $row['tipo_pagamento'],
                'valor_bruto' => $row['valor_bruto'],
                'valor_desconto' => $row['valor_desconto'],
                'valor_taxa' => $row['valor_taxa'],
                'valor_liquido' => $row['valor_liquido'],
                'transportadora' => $row['transportadora'],
                'num_envio' => $row['num_envio'],
                'data_transacao' => $row['data_transacao'],
                'data_compensacao' => $row['data_compensacao'],
                'ref_transacao' => $row['ref_transacao'],
                'parcelas' => $row['parcelas'],
                'codigo_usuario' => $row['codigo_usuario'],
                'codigo_venda' => $row['codigo_venda'],
                'serial_leitor' => $row['serial_leitor'],
                'recebimentos' => $row['recebimentos'],
                'recebidos' => $row['recebidos'],
                'valor_recebido' => $row['valor_recebido'],
                'valor_tarifa_intermediacao' => $row['valor_tarifa_intermediacao'],
                'valor_taxa_intermediacao' => $row['valor_taxa_intermediacao'],
                'valor_taxa_parcelamento' => $row['valor_taxa_parcelamento'],
                'valor_tarifa_boleto' => $row['valor_tarifa_boleto'],
                'bandeira_cartao_credito' => $row['bandeira_cartao_credito'],
            );

            // Armazena transacao
            $db->insert("Transacao", $transacao);

            $arquivo_transacao = array(
                "arquivo_id" => $id_arq,
                "transacao_id" => $row['transacao_id'],
            );
            // Armazena arquivo_transacao
            $db->insert("arquivo_transacao", $arquivo_transacao);

        }

        $dbh->commit();

        echo "Arquivo importado com sucesso!";

    } catch (PDOException $e) {
        echo "<div id='alerta' class='alert alert-danger text-center' role='alert'>Não foi possível importar: Transação_ID duplicado.</div>";
        $dbh->rollBack();
    }

}
?>

<div class="container">
<h3>Importar Arquivo</h3>
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" style="margin:auto;">
        <div class="input-group">
             <div class="input-group-prepend">
                <button type="submit" name="Import" onclick="myFunction()" class="btn btn-primary mb-2">Upload</button>
            </div>
            <div class="custom-file">
                <input type="file" name="arq_csv" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
                <label class="custom-file-label" for="inputGroupFile01">Escolher arquivo...</label>
            </div>
        </div>
    </form>

</div>


