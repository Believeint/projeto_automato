<?php
$db = DB::getInstance();

$db->getAll('Arquivo');

$arquivos = $db->results();

if (isset($_POST['Consultar'])) {
    header("Location: index.php?page=det-arquivo&id=" . $_POST['selectt']);
}

?>
<div class="container">
<h4 class="text-center" style="margin-bottom: 50px;">Pesquisar arquivo <span class="badge badge-secondary"><i class="fa fa-search"></i></span></h4>
<form action="" method="post">
    <div class="input-group">
        <select class="custom-select" name="selectt" id="inputGroupSelect04">
            <?php foreach ($arquivos as $arquivo) {?>
                <option value="<?php echo $arquivo->id; ?>">Arquivo <?php echo escape($arquivo->id); ?> / Importado em <?php echo escape(date("d/m/Y h:m:s", strtotime($arquivo->data_envio))); ?></option>
            <?php }?>
        </select>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" name="Consultar" type="submit">Consultar</button>
        </div>
    </div>

</form>
</div>

