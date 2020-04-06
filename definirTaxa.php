<?php

$db = DB::getInstance();

$db->getAll('TaxaISS');

$resultados = $db->first();

if (isset($_POST['Definir'])) {

    try {

        $taxa = array(
            'deb_cred_1x' => clean(Input::get('deb_cred_1x')),
            'cred_2a6x' => clean(Input::get('cred_2a6x')),
            'cred_7a12x' => clean(Input::get('cred_7a12x'))
        );


        $db->update("TaxaISS", 1, $taxa);


        Session::flash('home', 'Taxa definida com sucesso');

        header('Location: index.php');

    } catch (Exception $e) {

        //echo "<div class='alert alert-danger text-center' role='alert'>Não foi definir taxa</div>";

        echo $e->getMessage();

    }



}


?>
<h4 class="text-center" style="margin-bottom: 50px;">Definir Taxa <span class="badge badge-secondary"><i class="fa fa-usd"></i></span></h4>

<div class="container">

    <form action="" method="post">

        <div class="container" style="width: 65%;">

            <div class="row">

                <div class="col-sm-4">

                    <div class="form-group">

                        <label for="deb_cred_1x">Debito/Crédito 1x</label>

                        <input type="text" class="form-control" name="deb_cred_1x" required maxlength="7" id="deb_cred_1x" autocomplete="off" value="<?php echo escape($resultados->deb_cred_1x); ?>">

                    </div>

                </div>

                <div class="col-sm-4">

                    <div class="form-group">

                        <label for="cred_2a6x">Crédito 2 a 6x</label>

                        <input type="text" class="form-control" name="cred_2a6x" required maxlength="7" id="cred_2a6x" autocomplete="off" value="<?php echo escape($resultados->cred_2a6x); ?>">

                    </div>

                </div>

                <div class="col-sm-4">

                    <div class="form-group">

                        <label for="cred_7a12x">Crédito 7 a 12x</label>

                        <input type="text" class="form-control" name="cred_7a12x" required maxlength="7" id="cred_7a12x" autocomplete="off" value="<?php echo escape($resultados->cred_7a12x); ?>">

                    </div>

                </div>
            </div>

            <div class="row">

                <div class="col-sm-12">

                    <div class="pull-right" style="margin-bottom: 20px;">

                        <button type="submit" name="Definir" class="btn btn-success"><i class="fa fa-plus"></i> DEFINIR</button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>



<script type="text/javascript">

    $("#deb_cred_1x").mask('##0.00%', {reverse: true});

    $("#cred_2a6x").mask('##0.00%', {reverse: true});

    $("#cred_7a12x").mask('##0.00%', {reverse: true});

</script>

