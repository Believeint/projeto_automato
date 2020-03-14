<?php

if ($_REQUEST['id']) {
    $id = $_REQUEST['id'];
    $db = DB::getInstance();

    $db->get('Cliente', array('id', '=', $id));
    $cliente = $db->first();

    $db->getAll('Cliente');

    $clientes = $db->results();
    $cli_serial_leitor = array_column($clientes, 'serial_leitor');

    $db->getDistinct('Transacao', 'serial_leitor');

    $resultados = $db->results();
    $tr_serial_leitor = array_column($resultados, 'serial_leitor');

    $cli_n_cadastrados = array_diff($tr_serial_leitor, $cli_serial_leitor);

    if (isset($_POST['Editar'])) {
        try {
            $nCli = array(
                'nome' => Input::get('nome'),
                'serial_leitor' => Input::get('serial_leitor'),
                'email' => Input::get('email'),
                'contato' => Input::get('contato'),
                'taxa_deb' => Input::get('taxa_deb'),
                'taxa_cred_1x' => Input::get('taxa_cred_1x'),
                'taxa_cred_2x' => Input::get('taxa_cred_2x'),
                'taxa_cred_3x' => Input::get('taxa_cred_3x'),
                'taxa_cred_4x' => Input::get('taxa_cred_4x'),
                'taxa_cred_5x' => Input::get('taxa_cred_5x'),
                'taxa_cred_6x' => Input::get('taxa_cred_6x'),
                'taxa_cred_7x' => Input::get('taxa_cred_7x'),
                'taxa_cred_8x' => Input::get('taxa_cred_8x'),
                'taxa_cred_9x' => Input::get('taxa_cred_9x'),
                'taxa_cred_10x' => Input::get('taxa_cred_10x'),
                'taxa_cred_11x' => Input::get('taxa_cred_11x'),
                'taxa_cred_12x' => Input::get('taxa_cred_12x'),
            );

            $db->update('Cliente', $id, $nCli);

            Session::flash('home', 'Alteração realizada com sucesso');
            header('Location: index.php');

        } catch (Exception $e) {
            //echo "<div class='alert alert-danger text-center' role='alert'>Não foi possivel cadastrar</div>";
            echo $e->getMessage();
        }

    }

} else {
    header('Location: index.php');
}

?>

<div class="container">
<h4 class="text-center" style="margin-bottom: 50px;">Editar Cliente <span class="badge badge-secondary"><i class="fa fa-edit"></i></span></h4>

<form action="" method="post">

<div class="row">

    <div class="col-sm-6">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" required id="nome" autocomplete="off" value="<?php echo escape($cliente->nome); ?>">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="serial_leitor">Serial Leitor</label>
            <select name="serial_leitor" id="serial_leitor" class="form-control" required>
                <option value="<?php echo $cliente->serial_leitor; ?>"><?php echo $cliente->serial_leitor; ?></option>
                <?php if ($cli_n_cadastrados > 0): ?>
                    <?php foreach ($cli_n_cadastrados as $cli_n_cadastrado): ?>
                        <option value="<?php echo $cli_n_cadastrado; ?>"><?php echo $cli_n_cadastrado; ?></option>
                    <?php endforeach;?>
                <?php endif;?>
            </select>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-sm-6">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email" value="<?php echo escape($cliente->email); ?>">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="contato">Contato</label>
            <input type="text" class="form-control" name="contato" id="contato" value="<?php echo escape($cliente->contato); ?>">
        </div>
    </div>

</div>

<fieldset style="border: 1px solid rgba(0,0,0,.1);padding-bottom: 20px;margin-bottom: 20px;">
    <legend style="width: auto; padding: 0 10px; border-bottom: none; ">Taxa&nbsp;<i class="fa fa-money" aria-hidden="true"></i></legend>

    <div style="width: 95%; margin: auto;">
        <div class="row">

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="taxa_deb">Débito</label>
                    <input type="text" class="form-control" name="taxa_deb" id="taxa_deb" maxlength="7" required value="<?php echo escape($cliente->taxa_deb); ?>">
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="taxa_cred_1x">Crédito/1x</label>
                    <input type="text" class="form-control" name="taxa_cred_1x" id="taxa_cred_1x" maxlength="7" required value="<?php echo escape($cliente->taxa_cred_1x); ?>">
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="taxa_cred_2x">Crédito/2x</label>
                    <input type="text" class="form-control" name="taxa_cred_2x" id="taxa_cred_2x" maxlength="7" required value="<?php echo escape($cliente->taxa_cred_2x); ?>">
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="taxa_cred_3x">Crédito/3x</label>
                    <input type="text" class="form-control" name="taxa_cred_3x" id="taxa_cred_3x" maxlength="7" required value="<?php echo escape($cliente->taxa_cred_3x); ?>">
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="taxa_cred_4x">Crédito/4x</label>
                    <input type="text" class="form-control" name="taxa_cred_4x" id="taxa_cred_4x" maxlength="7" required value="<?php echo escape($cliente->taxa_cred_4x); ?>">
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="taxa_cred_5x">Crédito/5x</label>
                    <input type="text" class="form-control" name="taxa_cred_5x" id="taxa_cred_5x" maxlength="7" required value="<?php echo escape($cliente->taxa_cred_5x); ?>">
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="taxa_cred_6x">Crédito/6x</label>
                    <input type="text" class="form-control" name="taxa_cred_6x" id="taxa_cred_6x" maxlength="7" required value="<?php echo escape($cliente->taxa_cred_6x); ?>">
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="taxa_cred_7x">Crédito/7x</label>
                    <input type="text" class="form-control" name="taxa_cred_7x" id="taxa_cred_7x" maxlength="7" required value="<?php echo escape($cliente->taxa_cred_7x); ?>">
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="taxa_cred_8x">Crédito/8x</label>
                    <input type="text" class="form-control" name="taxa_cred_8x" id="taxa_cred_8x" maxlength="7" required value="<?php echo escape($cliente->taxa_cred_8x); ?>">
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="taxa_cred_9x">Crédito/9x</label>
                    <input type="text" class="form-control" name="taxa_cred_9x" id="taxa_cred_9x" maxlength="7" required value="<?php echo escape($cliente->taxa_cred_9x); ?>">
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="taxa_cred_10x">Crédito/10x</label>
                    <input type="text" class="form-control" name="taxa_cred_10x" id="taxa_cred_10x" maxlength="7" required value="<?php echo escape($cliente->taxa_cred_10x); ?>">
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="taxa_cred_11x">Crédito/11x</label>
                    <input type="text" class="form-control" name="taxa_cred_11x" id="taxa_cred_11x" maxlength="7" required value="<?php echo escape($cliente->taxa_cred_11x); ?>">
                </div>
            </div>

        </div>


        <div class="row">
            <dic class="col-sm-2">
                <div class="form-group">
                    <label for="taxa_cred_12x">Crédito/12x</label>
                    <input type="text" class="form-control" name="taxa_cred_12x" id="taxa_cred_12x" maxlength="7" required value="<?php echo escape($cliente->taxa_cred_12x); ?>">
                </div>
            </dic>
        </div>
    </div>
</fieldset>

<div class="input-group" style="margin-bottom:20px;">
    <button type="submit" name="Editar" class="btn btn-success pull-rigt"><i class="fa fa-pencil"></i> Editar</button>
</div>

</form>
</div>

<script type="text/javascript">
    $("#taxa_deb").mask('##0.00%', {reverse: true});
    $("#taxa_cred_1x").mask('##0.00%', {reverse: true});
    $("#taxa_cred_2x").mask('##0.00%', {reverse: true});
    $("#taxa_cred_3x").mask('##0.00%', {reverse: true});
    $("#taxa_cred_4x").mask('##0.00%', {reverse: true});
    $("#taxa_cred_5x").mask('##0.00%', {reverse: true});
    $("#taxa_cred_6x").mask('##0.00%', {reverse: true});
    $("#taxa_cred_7x").mask('##0.00%', {reverse: true});
    $("#taxa_cred_8x").mask('##0.00%', {reverse: true});
    $("#taxa_cred_9x").mask('##0.00%', {reverse: true});
    $("#taxa_cred_10x").mask('##0.00%', {reverse: true});
    $("#taxa_cred_11x").mask('##0.00%', {reverse: true});
    $("#taxa_cred_12x").mask('##0.00%', {reverse: true});
    $("#contato").mask('(00) 00000-0000');
</script>
