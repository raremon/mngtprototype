<div class="box box-success">
  <div style='margin-top:20px' class="box-header with-border">
    <h3 class="box-title">Fares Data</h3>
    <div class="box-tools pull-right">
        <a class="btn btn-link add-link" href="<?php echo base_url('fares/add') ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New Fare</a>
    </div>
  </div>
  <div class="box-body">
    <div id="route-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="fares_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>ROUTE</th>
                <th>PUB</th>
                <th>PUJ</th>
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

<div id="editFare" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Fare Details</h4>
            </div>
            <div class="modal-body">
                <div id="route-message"></div>
                <form class="form-horizontal" method="POST" id="fareEditForm" accept-charset="utf-8">
                    <input type="hidden" name='fare_id'>
                    <div style="text-align: center" class="row">
                  <div  class="col-md-12">
                        <label>Public Utility Bus</label><br><br>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Minimum Fare:</label>
                            <div class="col-md-6">
                                <input type="number" name="PUBminimum_fare" class="form-control" placeholder="Enter Minimum Fare"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Minimum Kilometer(s):</label>
                            <div class="col-md-6">
                                <input type="number" name="PUBminimum_km" class="form-control" placeholder="Enter Minimum Kilometer(s)"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Rate/km (After Min):</label>
                            <div class="col-md-6">
                                <input type="number" name="PUBadded_fare" class="form-control" placeholder="Enter Rate/km"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Discount:</label>
                            <div class="col-md-6">
                                <input type="number" name="PUBdiscount" class="form-control" placeholder="Enter Discount"/>
                            </div>
                        </div>
                  </div>
                    </div><br>
                  <div style="text-align: center" class="row">
                  <div class="col-md-12">
                        <label>Public Utility Jeepney</label><br><br>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Minimum Fare:</label>
                            <div class="col-md-6">
                                <input type="number" name="PUJminimum_fare" class="form-control" placeholder="Enter Minimum Fare"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Minimum Kilometer(s):</label>
                            <div class="col-md-6">
                                <input type="number" name="PUJminimum_km" class="form-control" placeholder="Enter Minimum Kilometer(s)"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Rate/km (After Min):</label>
                            <div class="col-md-6">
                                <input type="number" name="PUJadded_fare" class="form-control" placeholder="Enter Rate/km"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Discount:</label>
                            <div class="col-md-6">
                                <input type="number" name="PUJdiscount" class="form-control" placeholder="Enter Discount"/>
                            </div>
                        </div>
                  </div>
              </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Fare()">Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
$("#fares_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('fares/showFares') ?>",
      "type":"POST"
    }
  });
  
  function edit_fare(fare_id) {
    $('#editFare').modal('show');
    $.ajax({
      url: "<?php echo site_url('fares/editFare') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'fare_id='+fare_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="PUBminimum_fare"]').val(data.PUBminimum_fare);
        $('input[name="PUBminimum_km"]').val(data.PUBminimum_km);
        $('input[name="PUBadded_fare"]').val(data.PUBadded_fare);
        $('input[name="PUBdiscount"]').val(data.PUBdiscount);
        $('input[name="PUJminimum_fare"]').val(data.PUJminimum_fare);
        $('input[name="PUJminimum_km"]').val(data.PUJminimum_km);
        $('input[name="PUJadded_fare"]').val(data.PUJadded_fare);
        $('input[name="PUJdiscount"]').val(data.PUJdiscount);
        $('input[name="fare_id"]').val(data.fare_id);
      }
    });
  }
  function update_Fare() {
    $.ajax({
      url: "<?php echo site_url('fares/updateFare') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#fareEditForm').serialize(),
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
          $('#editFare').modal('hide'); 
          $('#successModal').modal('show');
        }
      }
    });
  }
  
  function delete_fare(fare_id) {
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
        url: "<?php echo site_url('fares/delete_Fare') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'fare_id='+fare_id,
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