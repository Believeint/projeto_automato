<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Modal Events - show.bs.modal</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-primary" id="myBtn" data-id="aaaa">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modal Header</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>The <strong>show.bs.modal</strong> event occurs when the modal is about to be shown.</p>
          <p id="valor"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
</div>

<script>


$(document).ready(function(){
  $("#myBtn").click(function(){

    $("#myModal").modal("show");
    $(document).on("click", "#myBtn", function () {
     var myID = $(this).data('id');
     $("#valor").val(myID);
});
  });
  $("#myModal").on('show.bs.modal', function () {
    //var id = $(this).data('modal-id');
    alert($(this).data('modal-id'));
  });
});
</script>

</body>
</html>
