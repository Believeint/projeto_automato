<?php

$db = DB::getInstance();

$db->getAll('Cliente');

$clientes = $db->results();
$cli_serial_leitor = array_column($clientes, 'serial_leitor');

$db->getDistinct('Transacao', 'serial_leitor');

$resultados = $db->results();
$tr_serial_leitor = array_column($resultados, 'serial_leitor');

$cli_n_cadastrados = array_diff($tr_serial_leitor, $cli_serial_leitor);

if (isset($_POST['Cadastrar'])) {
    try {
        $cliente = array(
            'nome' => Input::get('nome'),
            'serial_leitor' => Input::get('serial_leitor'),
            'email' => Input::get('email'),
            'contato' => Input::get('contato'),
            'taxa_deb_1x' => Input::get('taxa_deb_1x'),
            'taxa_cred_1x' => Input::get('taxa_cred_1x'),
            'taxa_cred_2xa6x' => Input::get('taxa_cred_2x_6x'),
            'taxa_cred_7xa12x' => Input::get('taxa_cred_7x_12x'),
        );
        $db->insert("Cliente", $cliente);
        Session::flash('home', 'Cadastro realizado com sucesso');
        header('Location: index.php');
    } catch (Exception $e) {
        //echo "<div class='alert alert-danger text-center' role='alert'>Não foi possivel cadastrar</div>";
        echo $e->getMessage();
    }

}

?>
<div class="container">
    <h4 class="text-center" style="margin-bottom: 50px;">Cadastrar cliente <span class="badge badge-secondary"><i class="fa fa-user-plus"></i></span></h4>

    <form action="" method="post">

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" required id="nome" autocomplete="off" value="<?php echo escape(Input::get('nome')); ?>">
                </div>
            </div>

        <div class="col-sm-6">
                <div class="form-group">
                    <label for="serial_leitor">Serial Leitor</label>
                    <select name="serial_leitor" id="serial_leitor" class="form-control" required value="<?php echo escape(Input::get('serial_leitor')); ?>">
                        <option value="none" selected disabled hidden>Selecionar</option>
                        <?php foreach ($cli_n_cadastrados as $cliente): ?>
                            <option value="<?php echo escape($cliente); ?>"><?php echo escape($cliente); ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="contato">Contato</label>
                    <input type="text" class="form-control" name="contato" id="contato" value="<?php echo escape(Input::get('contato')); ?>">
                </div>
            </div>

        </div>
        <fieldset style="border: 1px solid rgba(0,0,0,.1);padding-bottom: 20px;margin-bottom: 20px;">
            <legend style="width: auto; padding: 0 10px; border-bottom: none; ">Taxa&nbsp;<i class="fa fa-money" aria-hidden="true"></i></legend>
            <div style="width: 95%; margin: auto;">

        <div class="row">

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="taxa_deb_1x">Taxa Débito 1x</label>
                    <input type="text" class="form-control" name="taxa_deb_1x" id="taxa_deb_1x" maxlength="7" required value="<?php echo escape(Input::get('taxa_deb_1x')); ?>">
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="taxa_cred_1x">Taxa Crédito 1x</label>
                    <input type="text" class="form-control" name="taxa_cred_1x" id="taxa_cred_1x" maxlength="7" required value="<?php echo escape(Input::get('taxa_cred_1x')); ?>">
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="taxa_cred_2x_6x">Taxa Crédito 2x a 6x</label>
                    <input type="text" class="form-control" name="taxa_cred_2x_6x" id="taxa_cred_2x_6x" maxlength="7" required value="<?php echo escape(Input::get('taxa_cred_2x_6x')); ?>">
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="taxa_cred_7x_12x">Taxa Crédito 7x a 12x</label>
                    <input type="text" class="form-control" name="taxa_cred_7x_12x" id="taxa_cred_7x_12x" maxlength="7" required value="<?php echo escape(Input::get('taxa_cred_7x_12x')); ?>">
                </div>
            </div>

        </div>
        </div>
        </fieldset>

        <button type="submit" name="Cadastrar" class="btn btn-success pull-right"><i class="fa fa-plus-square"></i> CADASTRAR</button>

    </form>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script type="text/javascript">
    $("#taxa_deb_1x").mask('##0,00%', {reverse: true});
    $("#taxa_cred_1x").mask('##0,00%', {reverse: true});
    $("#taxa_cred_2x_6x").mask('##0,00%', {reverse: true});
    $("#taxa_cred_7x_12x").mask('##0,00%', {reverse: true});
    $("#contato").mask('(00) 000000000');
</script>