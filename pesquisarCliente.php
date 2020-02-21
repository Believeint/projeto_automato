<?php

if (Session::exists('exclusao_sucess')) {
    echo "<div id='alert' class='alert alert-success text-center' role='alert'>" . Session::flash('exclusao_sucess') . "</div>";
}

$db = DB::getInstance();

$db->getAll('Cliente');
$clientes = $db->results();

if (isset($_REQUEST['acao'])) {
    if ($_REQUEST['id']) {
        $id = $_REQUEST['id'];
        if ($db->delete('Cliente', array('id', '=', $id))) {
            Session::flash('exclusao_sucess', "Excluído com sucesso");
            header('Location: index.php?page=pes-cliente');
            echo "<div id='alert' class='alert alert-success text-center' role='alert'>Excluído com sucesso</div>";
        } else {
            echo "<div id='alert' class='alert alert-danger text-center' role='alert'>Não foi possível excluir</div>";
        }
    }
}

?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Detalhes <span id="nome_cliente"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <ul class="list-group">
            <div class="row">
                <div class="col-md-6">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Nome
                        <span id="nome" class="badge badge-primary badge-pill"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Serial Leitor
                        <span id="serial_leitor" class="badge badge-primary badge-pill"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Email
                        <span id="email" class="badge badge-primary badge-pill"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Contato
                        <span id="contato" class="badge badge-primary badge-pill"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Taxa Débito
                        <span id="taxa_deb" class="badge badge-primary badge-pill"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Taxa Crédito 1x
                        <span id="taxa_cred_1x" class="badge badge-primary badge-pill"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Taxa Crédito 2x
                        <span id="taxa_cred_2x" class="badge badge-primary badge-pill"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Taxa Crédito 3x
                        <span id="taxa_cred_3x" class="badge badge-primary badge-pill"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Taxa Crédito 4x
                        <span id="taxa_cred_4x" class="badge badge-primary badge-pill"></span>
                    </li>
                </div>

                <div class="col-md-6">

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Taxa Crédito 5x
                        <span id="taxa_cred_5x" class="badge badge-primary badge-pill"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Taxa Crédito 6x
                        <span id="taxa_cred_6x" class="badge badge-primary badge-pill"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Taxa Crédito 7x
                        <span id="taxa_cred_7x" class="badge badge-primary badge-pill"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Taxa Crédito 8x
                        <span id="taxa_cred_8x" class="badge badge-primary badge-pill"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Taxa Crédito 9x
                        <span id="taxa_cred_9x" class="badge badge-primary badge-pill"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Taxa Crédito 10x
                        <span id="taxa_cred_10x" class="badge badge-primary badge-pill"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Taxa Crédito 11x
                        <span id="taxa_cred_11x" class="badge badge-primary badge-pill"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Taxa Crédito 12x
                        <span id="taxa_cred_12x" class="badge badge-primary badge-pill"></span>
                    </li>
                </div>
                </div>
            </ul>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<div class="container">
<h4 class="text-center" style="margin-bottom: 50px;">Meus Clientes <span class="badge badge-secondary"><i class="fa fa-search"></i></span></h4>
</div>
<?php if (count($clientes) > 0): ?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Serial Leitor</th>
      <th scope="col">Email</th>
      <th scope="col">Contato</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>

<?php foreach ($clientes as $cliente): ?>
    <tr>
      <th scope="row"><?php echo escape($cliente->id); ?></th>
      <td><?php echo escape($cliente->nome); ?></td>
      <td><?php echo escape($cliente->serial_leitor); ?></td>
      <td><?php echo escape($cliente->email); ?></td>
      <td><?php echo escape($cliente->contato); ?></td>
      <td>
        <a href='#' title='Detalhes' onclick="modalDetalhar('<?php echo $cliente->nome; ?>', '<?php echo $cliente->serial_leitor; ?>', '<?php echo $cliente->email; ?>', '<?php echo $cliente->contato; ?>', '<?php echo $cliente->taxa_deb . '%'; ?>', '<?php echo $cliente->taxa_cred_1x . '%'; ?>', '<?php echo $cliente->taxa_cred_2x . '%'; ?>', '<?php echo $cliente->taxa_cred_3x . '%'; ?>', '<?php echo $cliente->taxa_cred_4x . '%'; ?>', '<?php echo $cliente->taxa_cred_5x . '%'; ?>', '<?php echo $cliente->taxa_cred_6x . '%'; ?>', '<?php echo $cliente->taxa_cred_7x . '%'; ?>', '<?php echo $cliente->taxa_cred_8x . '%'; ?>', '<?php echo $cliente->taxa_cred_9x . '%'; ?>', '<?php echo $cliente->taxa_cred_10x . '%'; ?>', '<?php echo $cliente->taxa_cred_11x . '%'; ?>', '<?php echo $cliente->taxa_cred_12x . '%'; ?>')" data-toggle='modal' data-target='#myModal'><i class='fa fa-info-circle' ></i></a>&nbsp;
        <a href="index.php?page=edi-cliente&id=<?php echo $cliente->id; ?>" title="Editar"><i class="fa fa-edit"></i></a>&nbsp;
        <?php echo "<a href='#' title='Excluir' onclick=\"if(confirm('Confirmar Exclusão?')) { location.href='index.php?page=pes-cliente&acao=excluir&id=" . $cliente->id . "' }\"><i class='fa fa-remove'></i></a>"; ?>
      </td>
    </tr>
<?php endforeach;?>

  </tbody>
</table>
<?php else: ?>
 <div id='alert' class='alert alert-warning text-center' role='alert'>Nenhum resultado encontrado...</div>
<?php endif;?>

<script>
     function modalDetalhar(n, s, e, c, td, c1, c2, c3, c4, c5, c6, c7, c8, c9, c10, c11, c12) {
         $('#nome').html(n);
         $('#serial_leitor').html(s);
         $('#email').html(e);
         $('#contato').html(c);
         $('#taxa_deb').html(td);
         $('#taxa_cred_1x').html(c1);
         $('#taxa_cred_2x').html(c2);
         $('#taxa_cred_3x').html(c3);
         $('#taxa_cred_4x').html(c4);
         $('#taxa_cred_5x').html(c5);
         $('#taxa_cred_6x').html(c6);
         $('#taxa_cred_7x').html(c7);
         $('#taxa_cred_8x').html(c8);
         $('#taxa_cred_9x').html(c9);
         $('#taxa_cred_10x').html(c10);
         $('#taxa_cred_11x').html(c11);
         $('#taxa_cred_12x').html(c12);
         $('#showmodal').modal('show');
     }


</script>
