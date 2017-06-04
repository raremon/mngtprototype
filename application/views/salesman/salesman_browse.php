<div class="modal fade" id="sales-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Salesman Details</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="col-md-12">
            <div id="sales-message"></div>
            <?php echo form_open('welcome', array('id'=>'sales')); ?>
            <div class="form-group">
              <input type="text" name="sales_id" class="form-control"/>
            </div>
            <div class="form-group">
              <label>First Name</label>
              <input type="text" name="sales_fname" class="form-control" placeholder="Enter First Name"/>
            </div>
            <div class="form-group">
              <label>Last Name</label>
              <input type="text" name="sales_lname" class="form-control" placeholder="Enter Last Name"/>
            </div>
            <div class="form-group">
              <label>Contact Information</label>
              <input type="text" name="sales_contactno" class="form-control" placeholder="Enter Contact Information"/>
            </div>
            <div class="form-group">
              <label>Email Address</label>
              <input type="text" name="sales_email" class="form-control" placeholder="Enter Email Address"/>
            </div>
            <?php echo form_close(); ?>
          </div>
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Sales()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Salesman Data</h3>
    <div class="box-tools pull-right">
        <a class="btn btn-link add-link" href="<?php echo base_url('salesman/add') ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New Salesman</a>
    </div>
  </div>
  <div class="box-body">
    <div id="sales-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="sales_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>SALESMAN NAME</th>
                <th>CONTACT</th>
                <th>EMAIL</th>
                <th>CREATION DATE</th>
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
<script type="text/javascript">
  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////
  // O T H E R
  function closebox() {
    $('#form-box').addClass('hidden');
  }
  // R E A D
  $("#sales_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('salesman/show') ?>",
      "type":"POST"
    }
  })
  // U P D A T E
  function edit_sales(id) {
    $('#sales-box').modal('show');
    $.ajax({
      url: "<?php echo site_url('salesman/edit') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'sales_id='+id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="sales_id"]').val(data.sales_id);
        $('input[name="sales_fname"]').val(data.sales_fname);
        $('input[name="sales_lname"]').val(data.sales_lname);
        $('input[name="sales_contactno"]').val(data.sales_contactno);
        $('input[name="sales_email"]').val(data.sales_email);
      }
    })
  }
  function update_Sales() {
    $.ajax({
      url: "<?php echo site_url('salesman/update') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#sales').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#sales-message").fadeIn("slow");
            $('#sales-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#sales-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#sales-box').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
    
function delete_sales(id) {
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
        url: "<?php echo site_url('salesman/delete/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'sales_id='+id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#sales-delete-message").fadeIn("slow");
              $('#sales-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#sales-delete-message').fadeOut('slow');
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
            )
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
          
        })
      }
    })
  }        
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF SALESMEN BROWSE JAVASCRIPT
</script>