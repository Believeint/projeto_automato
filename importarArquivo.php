<?php

include 'Models/Csv.php';

if (isset($_POST['Import'])) {

    $file_extension = pathinfo($_FILES['arq_csv']['name'], PATHINFO_EXTENSION);
    if (!file_exists($_FILES['arq_csv']['tmp_name'])) {
        echo "<div class='alert alert-danger text-center' role='alert'>Erro: Entrada não pode estar vazia</div>";
    } elseif ($file_extension != "csv") {
        echo "<div class='alert alert-danger text-center' role='alert'>Erro: Arquivo precisa ter extensão \".csv\"</div>";
    } elseif ($_FILES['arq_csv']['size'] > 125000) {
        echo "<div class='alert alert-danger text-center' role='alert'>Erro: Arquivo muito grande, Limite 1mb</div>";
    } else {

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
                    'valor_bruto' => number_format(str_replace(',', '.', str_replace('.', '', $row['valor_bruto'])), 2, '.', ''),
                    'valor_desconto' => number_format(str_replace(',', '.', str_replace('.', '', $row['valor_desconto'])), 2, '.', ''),
                    'valor_taxa' => number_format(str_replace(',', '.', str_replace('.', '', $row['valor_taxa'])), 2, '.', ''),
                    'valor_liquido' => number_format(str_replace(',', '.', str_replace('.', '', $row['valor_liquido'])), 2, '.', ''),
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
                    'valor_recebido' => number_format(str_replace(',', '.', str_replace('.', '', $row['valor_recebido'])), 2, '.', ''),
                    'valor_tarifa_intermediacao' => number_format(str_replace(',', '.', str_replace('.', '', $row['valor_tarifa_intermediacao'])), 2, '.', ''),
                    'valor_taxa_intermediacao' => number_format(str_replace(',', '.', str_replace('.', '', $row['valor_taxa_intermediacao'])), 2, '.', ''),
                    'valor_taxa_parcelamento' => number_format(str_replace(',', '.', str_replace('.', '', $row['valor_taxa_parcelamento'])), 2, '.', ''),
                    'valor_tarifa_boleto' => number_format(str_replace(',', '.', str_replace('.', '', $row['valor_tarifa_boleto'])), 2, '.', ''),
                    'bandeira_cartao_credito' => $row['bandeira_cartao_credito'],
                );

                // Armazena transacao
                $db->insert("Transacao", $transacao);

                $arquivo_transacao = array(
                    "id_arquivo" => $id_arq,
                    "id_transacao" => $row['transacao_id'],
                );
                // Armazena arquivo_transacao
                $db->insert("arquivo_transacao", $arquivo_transacao);

            }

            echo "<div class='alert alert-success text-center' role='alert'>Arquivo importado com sucesso</div>";
            $dbh->commit();

        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo "<div class='alert alert-danger text-center' role='alert'>Erro: Não foi possível importar, Já existe uma Transação com o ID/ Ou arquivo Inválido</div>";
            $dbh->rollback();
        }
    }

}
?>

<div class="container">
<h4 class="text-center" style="margin-bottom: 50px;">Importar arquivo <span class="badge badge-secondary"><i class="fa fa-download"></i></i></span></h4>
    <form class="form-horizontal" action="" method="post"  enctype="multipart/form-data" style="margin:auto;">
        <div class="input-group">
            <div class="input-group-prepend">
              <button type="submit" name="Import" class="btn btn-primary">Upload</button>
            </div>
            <div class="custom-file">
                <input type="file" name="arq_csv" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Escolher arquivo...</label>
            </div>
        </div>
    </form>


</div>
<script src="js/jquery-3.1.1.slim.min.js"></script>

<script>
    $('#inputGroupFile01').on('change',function(){
        var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
    })
</script>
