<div class="modal fade" id="city-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">City Details</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <div class="col-md-12">
              <div id="city-message"></div>
              <?php echo form_open('welcome', array('id'=>'city')); ?>
              <div class="form-group hidden">
                <input type="text" name="city_id" class="form-control"/>
              </div>
              <div class="form-group">
                <label>Region</label>
                <select name="region_id" class="form-control select2">
                  <?php 
                    foreach($region as $row)
                    {
                  ?>
                    <option value= <?php echo $row[0];?> >
                      <?php echo $row[1]; ?>
                    </option>
                  <?php 
                    }
                  ?>
                </select>
                <a class="btn btn-link pull-right" href="<?php echo site_url('regions/add') ?>">Add Region</a>
              </div>
              <div class="form-group">
                <label>City Name</label>
                <input type="text" name="city_name" class="form-control" placeholder="Enter City Name"/>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_City()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">City Data</h3>
    <div class="box-tools pull-right">
        <a class="btn btn-link add-link" href="<?php echo base_url('cities/add') ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New City</a>
    </div>
  </div>
  <div class="box-body">
    <div id="city-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="city_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>CITY NAME</th>
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
  $(".select2").select2();
  $('.select2-selection__rendered').removeAttr('title');
  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////
  // O T H E R
  function closebox() {
    $('#form-box').addClass('hidden');
  }
  // R E A D
  $("#city_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('cities/showCity') ?>",
      "type":"POST"
    }
  })
  // U P D A T E
  function edit_city(city_id) {
    $('#city-box').modal('show');
    $.ajax({
      url: "<?php echo site_url('cities/editCity') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'city_id='+city_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="city_id"]').val(data.city_id);
        $('input[name="city_name"]').val(data.city_name);
        $('select[name="region_id"]').val(data.region_id);
      }
    })
  }
  function update_City() {
    $.ajax({
      url: "<?php echo site_url('cities/updateCity') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#city').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#city-message").fadeIn("slow");
            $('#city-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#city-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#city-box').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
  function delete_city(city_id) {
    swal({
      title: 'ARE YOU SURE?',
      text: "You cannot revert this action!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Delete',
      cancelButtonText: 'Cancel',
      confirmButtonClass: 'btn btn-success btn-fix',
      cancelButtonClass: 'btn btn-default',
      animation: false,
      customClass: 'animated fadeInDown',
      buttonsStyling: false
    }).then(function () {
        swal({
         //pede to ilagay sa success modal di ko mahanap kung saan
          title: 'DELETED SUCCESSFULLY',
          type: 'success',
          confirmButtonText: 'Okay',
          confirmButtonClass: 'btn btn-success btn-fix',
          buttonsStyling: false
        })
    }, function (dismiss) {
      if (dismiss === 'cancel') {
        swal({
          title: 'CANCELLED',
          type: 'error',
          confirmButtonText: 'Okay',
          confirmButtonClass: 'btn btn-default btn-fix',
          buttonsStyling: false
        })
      }
    })
    if(confirm('Do you really want to delete this City Record ??')){
      // DITO ILALAGAY YUNG CONDITION NA PAG MAY BUS PANG NAKAASSIGN DUN SA DRIVER, YUN MUNA YUNG IDIDELETE MO
      if(false)
      {
        // $(window).scrollTop(0);
        // $("#user-delete-message").fadeIn("slow");
        // $('#user-delete-message').html("Cannot delete your own account!").addClass('alert alert-danger');
        // setTimeout(function() {
        //     $('#user-delete-message').fadeOut('slow');
        // }, 3000);
      }
      else
      {
        $.ajax({
          url: "<?php echo site_url('cities/delete_City') ?>",
          type: 'POST',
          dataType: 'json',
          data: 'city_id='+city_id,
          encode:true,
          success:function(data) {
            if(!data.success){
              if(data.errors){
                $(window).scrollTop(0);
                $("#city-delete-message").fadeIn("slow");
                $('#city-delete-message').html(data.errors).addClass('alert alert-danger');
                setTimeout(function() {
                    $('#city-delete-message').fadeOut('slow');
                }, 3000);
              }
            }else {
              $('#message-text').html(data.message);
              $('#successModal').modal('show');
            }
          }
        });
      }
    }
  }
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF CITY BROWSE JAVASCRIPT
</script>