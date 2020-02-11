<?php

include 'Models/Csv.php';

if (isset($_POST['import'])) {
    $n_arquivo = $_FILES['arq_csv']['tmp_name'];

    $csv = new Csv($n_arquivo);

    // $map = array(
    //     "cliente" => "a",
    //     "idade" => "b",

    // );

    // $csv->setAssociations($map);

    $rows = $csv->getRows();

    var_dump($rows);

}
?>

<div class="container">

    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="input-group">
            <div class="custom-file">
                <input type="file" name="arq_csv" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                <label class="custom-file-label" for="inputGroupFile04">Escolher arquivo</label>
            </div>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" name="import" type="submit" id="inputGroupFileAddon04" data-loading-text="Carregando...">Importar</button>
            </div>
        </div>
    </form>

</div>
