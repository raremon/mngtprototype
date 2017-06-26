<div class="box box-success">
  <div style='margin-top:20px' class="box-header with-border">
    <h3 class="box-title">Cashier's Accounts Data</h3>
    <div class="box-tools pull-right">
        <a class="btn btn-link add-link" href="<?php echo base_url('cashiers/add') ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New Cashier</a>
    </div>
  </div>
  <div class="box-body">
    <div id="route-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="cashiers_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th>Username</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="box-footer">
  </div>
</div>

<div id="editCashier" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cashier Details</h4>
            </div>
            <div class="modal-body">
                <div id="route-message"></div>
                <form method="POST" id="cashierEditForm" accept-charset="utf-8">
                    <input type="hidden" name='cashier_id'>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" placeholder="Enter First Name"/>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name"/>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter Username"/>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="************"/>
                    </div>
                    <div class="form-group">
                        <label>Card ID</label>
                        <input type="text" name="card_id" class="form-control" placeholder="Enter Card ID"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Cashier()">Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
$("#cashiers_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('cashiers/showCashiers') ?>",
      "type":"POST"
    }
  });
  
  function edit_cashier(cashier_id) {
    $('#editCashier').modal('show');
    $.ajax({
      url: "<?php echo site_url('cashiers/editCashier') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'cashier_id='+cashier_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="first_name"]').val(data.first_name);
        $('input[name="last_name"]').val(data.last_name);
        $('input[name="username"]').val(data.username);
        $('input[name="card_id"]').val(data.card_id);
        $('input[name="cashier_id"]').val(data.cashier_id);
      }
    });
  }
  function update_Cashier() {
    $.ajax({
      url: "<?php echo site_url('cashiers/updateCashier') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#cashierEditForm').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#route-message").fadeIn("slow");
            $('#route-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#route-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#editCashier').modal('hide'); 
          $('#successModal').modal('show');
        }
      }
    });
  }
  
  function delete_cashier(cashier_id) {
    swal({
      title: 'Are you sure you want to delete?',
      text: "You cannot revert this action!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Delete',
      cancelButtonText: 'Cancel',
      confirmButtonClass: 'btn btn-success btn-fix',
      cancelButtonClass: 'btn btn-default',
      animation: false,
      customClass: 'animated fadeInDown',
      buttonsStyling: false
    }).then(function () {
      $.ajax({
        url: "<?php echo site_url('cashiers/delete_Cashier') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'cashier_id='+cashier_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#route-delete-message").fadeIn("slow");
              $('#route-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#route-delete-message').fadeOut('slow');
              }, 3000);
            }
          }else {
//            $('#message-text').html(data.message);
//            $('#successModal').modal('show');
            swal({
             //pede to ilagay sa success modal di ko mahanap kung saan
              title: data.message,
              type: 'success',
              confirmButtonText: 'Okay',
              confirmButtonClass: 'btn btn-success btn-fix',
              buttonsStyling: false
            }).then(
              function () {
                window.location.reload();
              }
            );
          }
        }
      });
    }, function (dismiss) {
      if (dismiss === 'cancel') {
        swal({
          title: 'Cancelled',
          type: 'error',
          confirmButtonText: 'Okay',
          confirmButtonClass: 'btn btn-default btn-fix',
          buttonsStyling: false,
          timer: 3000
          
        });
      }
    });
  }   
  
  </script>

