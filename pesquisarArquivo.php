<?php

$db = DB::getInstance();

$db->getAll('Arquivo');

$arquivos = $db->results();

if (count($arquivos) > 0) {
    if (isset($_POST['Consultar'])) {
        header("Location: index.php?page=det-arquivo&id=" . $_POST['selected']);
    }
}

?>
<div class="container">
<h4 class="text-center" style="margin-bottom: 50px;">Pesquisar arquivo <span class="badge badge-secondary"><i class="fa fa-search"></i></span></h4>
<form action="" method="post">
    <div class="input-group">
        <select class="custom-select" name="selected" id="inputGroupSelect04" required>
            <?php if ($db->count() > 0): ?>
                <?php $x = 1;?>
                <?php foreach ($arquivos as $arquivo): ?>
                    <option value="<?php echo $arquivo->id; ?>">Arquivo <?php echo escape($x); ?> / Importado em <?php echo escape(date("d/m/Y h:i:s/a", strtotime($arquivo->data_envio))); ?></option>
                    <?php $x++;?>
                <?php endforeach;?>
            <?php else: ?>
                <option value="none" selected disabled hidden>Nenhum Resultado encontrado...<option>
            <?php endif;?>
        </select>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" name="Consultar" type="submit">Consultar</button>
        </div>
    </div>

</form>
</div>

