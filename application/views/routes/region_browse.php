<div class="modal fade" id="region-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Region Details</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <div class="col-md-12">
              <div id="region-message"></div>
              <?php echo form_open('welcome', array('id'=>'region')); ?>
              <div class="form-group">
                <input type="text" name="region_id" class="form-control hidden"/>
              </div>
              <div class="form-group">
                <label>Region Abbreviation</label>
                <input type="text" name="region_abbr" class="form-control" placeholder="Enter Region Abbreviation"/>
              </div>
              <div class="form-group">
                <label>Region Name</label>
                <input type="text" name="region_name" class="form-control" placeholder="Enter Region Name"/>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Region()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Region Data</h3>
    <div class="box-tools pull-right">
        <a class="btn btn-link add-link" href="<?php echo base_url('regions/add') ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New Region</a>
    </div>
  </div>
  <div class="box-body">
    <div id="region-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="region_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>REGION ABBREVIATION</th>
                <th>REGION NAME</th>
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
  // C R E A T E
  // O T H E R
  function closebox() {
    $('#form-box').addClass('hidden');
  }
  // R E A D
  $("#region_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('regions/showRegion') ?>",
      "type":"POST"
    }
  })
  // U P D A T E
  function edit_region(region_id) {
    $('#region-box').modal('show');
    $.ajax({
      url: "<?php echo site_url('regions/editRegion') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'region_id='+region_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="region_id"]').val(data.region_id);
        $('input[name="region_abbr"]').val(data.region_abbr);
        $('input[name="region_name"]').val(data.region_name);
      }
    })
  }
  function update_Region() {
    $.ajax({
      url: "<?php echo site_url('regions/updateRegion') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#region').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#region-message").fadeIn("slow");
            $('#region-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#region-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#region-box').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
    
function delete_region(region_id) {
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
        url: "<?php echo site_url('regions/delete_Region') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'region_id='+region_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#region-delete-message").fadeIn("slow");
              $('#region-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#region-delete-message').fadeOut('slow');
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

  // END OF REGION BROWSE JAVASCRIPT
</script>