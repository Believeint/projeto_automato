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

if (count($cli_n_cadastrados) == 0) {
    echo "<div class='alert alert-warning text-center' role='alert'>Atenção, Importar novo serial leitor para cadastrar novos clientes</div>";
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
                            <?php if (count($cli_n_cadastrados) > 0): ?>
                                <?php foreach ($cli_n_cadastrados as $cliente): ?>
                                    <option value="<?php echo escape($cliente); ?>"><?php echo escape($cliente); ?></option>
                                <?php endforeach;?>
                            <?php else: ?>
                                <option value="none" selected disabled hidden>Nenhum Resultado encontrado...<option>
                            <?php endif;?>
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

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="taxa_deb">Débito</label>
                            <input type="text" class="form-control" name="taxa_deb" id="taxa_deb" maxlength="7" required value="<?php echo escape(Input::get('taxa_deb_1x')); ?>">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="taxa_cred_1x">Crédito/1x</label>
                            <input type="text" class="form-control" name="taxa_cred_1x" id="taxa_cred_1x" maxlength="7" required value="<?php echo escape(Input::get('taxa_cred_1x')); ?>">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="taxa_cred_2x">Crédito/2x</label>
                            <input type="text" class="form-control" name="taxa_cred_2x" id="taxa_cred_2x" maxlength="7" required value="<?php echo escape(Input::get('taxa_cred_2x')); ?>">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="taxa_cred_3x">Crédito/3x</label>
                            <input type="text" class="form-control" name="taxa_cred_3x" id="taxa_cred_3x" maxlength="7" required value="<?php echo escape(Input::get('taxa_cred_3x')); ?>">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="taxa_cred_4x">Crédito/4x</label>
                            <input type="text" class="form-control" name="taxa_cred_4x" id="taxa_cred_4x" maxlength="7" required value="<?php echo escape(Input::get('taxa_cred_4x')); ?>">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="taxa_cred_5x">Crédito/5x</label>
                            <input type="text" class="form-control" name="taxa_cred_5x" id="taxa_cred_5x" maxlength="7" required value="<?php echo escape(Input::get('taxa_cred_5x')); ?>">
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="taxa_cred_6x">Crédito/6x</label>
                            <input type="text" class="form-control" name="taxa_cred_6x" id="taxa_cred_6x" maxlength="7" required value="<?php echo escape(Input::get('taxa_cred_6x')); ?>">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="taxa_cred_7x">Crédito/7x</label>
                            <input type="text" class="form-control" name="taxa_cred_7x" id="taxa_cred_7x" maxlength="7" required value="<?php echo escape(Input::get('taxa_cred_7x')); ?>">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="taxa_cred_8x">Crédito/8x</label>
                            <input type="text" class="form-control" name="taxa_cred_8x" id="taxa_cred_8x" maxlength="7" required value="<?php echo escape(Input::get('taxa_cred_8x')); ?>">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="taxa_cred_9x">Crédito/9x</label>
                            <input type="text" class="form-control" name="taxa_cred_9x" id="taxa_cred_9x" maxlength="7" required value="<?php echo escape(Input::get('taxa_cred_9x')); ?>">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="taxa_cred_10x">Crédito/10x</label>
                            <input type="text" class="form-control" name="taxa_cred_10x" id="taxa_cred_10x" maxlength="7" required value="<?php echo escape(Input::get('taxa_cred_10x')); ?>">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="taxa_cred_11x">Crédito/11x</label>
                            <input type="text" class="form-control" name="taxa_cred_11x" id="taxa_cred_11x" maxlength="7" required value="<?php echo escape(Input::get('taxa_cred_11x')); ?>">
                        </div>
                    </div>

                </div>


                <div class="row">
                    <dic class="col-sm-2">
                        <div class="form-group">
                            <label for="taxa_cred_12x">Crédito/12x</label>
                            <input type="text" class="form-control" name="form-control" id="taxa_cred_12x" maxlength="7" required value="<?php echo escape(Input::get('taxa_cred_12x')) ?>">
                        </div>
                    </dic>
                </div>
            </div>
        </fieldset>

        <div class="input-group">
            <button type="submit" name="Cadastrar" class="btn btn-success pull-right"><i class="fa fa-plus-square"></i> CADASTRAR</button>
        </div>

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