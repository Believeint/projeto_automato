<?php

$db = DB::getInstance();

$db->selectDistinctIdRelatorio();

$arquivos = $db->results();

if (count($arquivos) > 0) {
    if (isset($_POST['Relatorio'])) {
        header('Location: index.php?page=rel-arquivo&id=' . $_POST['selected']);
    }
}

?>
<h4 class="text-center" style="margin-bottom: 50px;">Relatório/Arquivo <span class="badge badge-secondary"><i class="fa fa-file-text-o"></i></span></h4>
<div class="container">
    <form action="" method="post">
        <div class="input-group">
            <select class="custom-select" name="selected" id="inputGroupSelect04" required>
                <?php if ($db->count() > 0): ?>
                    <?php $x = 1;?>
                    <?php foreach ($arquivos as $arquivo): ?>
                        <option value="<?php echo $arquivo->id_arquivo; ?>">Arquivo <?php echo escape($x); ?></option>
                        <?php $x++;?>
                    <?php endforeach;?>
                <?php else: ?>
                    <option value="none" selected disabled hidden>Nenhum Resultado encontrado...<option>
                <?php endif;?>
            </select>
            <div class="input-group-append">
                <button class="btn btn-outline-success" name="Relatorio" type="submit">Consultar</button>
            </div>
        </div>
    </form>
</div>

