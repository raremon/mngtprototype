<div class="modal fade" id="card-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Card Reader Details</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <div class="col-md-12">
              <div id="card-message"></div>
              <?php echo form_open('welcome', array('id'=>'card')); ?>
              <div class="form-group">
                <input type="text" name="card_id" class="form-control hidden"/>
              </div>
              <div class="form-group">
                <label>Card Reader Serial</label>
                <input type="text" name="card_serial" class="form-control" placeholder="Enter Card Reader's Serial"/>
              </div>
              <div class="form-group">
                <label>Card Reader Description</label>
                <textarea name="card_description" class="form-control" cols="30" rows="7" placeholder="Enter Card Reader's Description"></textarea>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Card()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Card Reader Data</h3>
    <div class="box-tools pull-right">
        <a class="btn btn-link add-link" href="<?php echo base_url('card_readers/add') ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New Card Reader</a>
    </div>
  </div>
  <div class="box-body">
    <div id="card-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="card_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>CARD READER SERIAL</th>
                <th>CARD READER DESCRIPTION</th>
                <th>DATE CREATED</th>
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
  $("#card_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('card_readers/show') ?>",
      "type":"POST"
    }
  })
  // U P D A T E
  function edit_card(card_id) {
    $('#card-box').modal('show');
    $.ajax({
      url: "<?php echo site_url('card_readers/edit') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'card_id='+card_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="card_id"]').val(data.card_id);
        $('input[name="card_serial"]').val(data.card_serial);
        $('textarea[name="card_description"]').val(data.card_description);
      }
    })
  }
  function update_Card() {
    $.ajax({
      url: "<?php echo site_url('card_readers/update') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#card').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#card-message").fadeIn("slow");
            $('#card-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#card-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#card-box').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
function delete_card(card_id) {
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
        url: "<?php echo site_url('card_readers/delete/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'card_id='+card_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#card-delete-message").fadeIn("slow");
              $('#card-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#card-delete-message').fadeOut('slow');
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
  // U N A S S I G N
    
function unassign_card(card_id) {
    swal({
      title: 'Are you sure you want to unassign?',
      text: "You cannot revert this action!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      cancelButtonText: 'Cancel',
      confirmButtonClass: 'btn btn-success btn-fix',
      cancelButtonClass: 'btn btn-default',
      animation: false,
      customClass: 'animated fadeInDown',
      buttonsStyling: false
    }).then(function () {
      $.ajax({
        url: "<?php echo site_url('card_readers/unassign/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'card_id='+card_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#card-delete-message").fadeIn("slow");
              $('#card-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#card-delete-message').fadeOut('slow');
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
  // END OF TV BROWSE JAVASCRIPT
</script>