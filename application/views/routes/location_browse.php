<div class="modal fade" id="location-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Location Details</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="col-md-12">
            <div id="location-message"></div>
            <?php echo form_open('welcome', array('id'=>'location')); ?>
            <div class="form-group">
              <input type="text" name="location_id" class="form-control hidden"/>
            </div>
            <div class="form-group">
            <label>Select a Region</label>
            <select data-placeholder="No regions on the data" id="region_name" class="select2 form-control">
              <option value="all">All Regions</option>
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
            <label>City</label>
            <select data-placeholder="No cities in this region" name="city_id" id="city" class="select2 form-control">
            </select>
            <a class="btn btn-link pull-right" href="<?php echo site_url('cities/add') ?>">Add City</a>
          </div>
          <div class="form-group">
            <label>Location Name</label>
            <input type="text" name="location_name" class="form-control" placeholder="Enter Location Name"/>
          </div>
          <?php echo form_close(); ?>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Location()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Location Data</h3>
    <div class="box-tools pull-right">
        <a class="btn btn-link add-link" href="<?php echo base_url('locations/add') ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New Location</a>
    </div>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
    <div id="location-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="location_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>LOCATION NAME</th>
                <th>CITY NAME</th>
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
  var city = [];
  <?php 
    foreach($city as $row)
    {
  ?>
    city.push([
      <?php echo $row[0]; ?>,
      "<?php echo $row[1]; ?>",
      <?php echo $row[2]; ?>,
    ]);
  <?php 
    }
  ?>

  var filtered = [];

  $('#location-box').on('shown.bs.modal', function () {
    if($('select[name="city_id"] > option').length == 0 || $('select[name="city_id"] > option').length == 0 || $('select[id="region_name"] > option').length == 0)
    {
      $("#location-message").fadeIn("slow");
      $('#location-message').html("NOT ENOUGH RESOURCES TO SAVE").addClass('alert alert-danger');
      $('.save').prop('disabled', true);
    }
  });

  function find(city_id) {
    for(var a = 0 ; a < city.length ; a++)
    {
      if(city[a][0] == city_id)
      {
        $('#region_name').val(city[a][2]);
        $('#region_name').change();
      }
    }
  }

  function filter() {
    filtered=[];
    for(var a = 0 ; a < city.length ; a++)
    {
      if($('#region_name').val() == "all")
      {
        filtered.push([
          city[a][0],
          city[a][1],
        ]);
      }
      else if(city[a][2] == $('#region_name').val())
      {
        filtered.push([
          city[a][0],
          city[a][1],
        ]);
      }
      else
      {
      }
    }
    $('#city')
      .find('option')
      .remove()
      .end()
    ;
    if(filtered.length<1)
    {
      $('.save')
        .prop('disabled', true)
      ;
    }
    else
    {
      $.each(filtered, function(key, value) {   
        $('#city')
          .append($('<option>', { value : value[0] })
          .text(value[1])); 
      });
      $('.save')
        .prop('disabled', false)
      ;
    }
    $('.chosen-select').chosen("destroy").chosen();
  }

  $( "#region_name" ).change(function() {
    filter();
  });

  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////
  // R E A D
  $("#location_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('locations/show') ?>",
      "type":"POST",        
    }
  })
  // U P D A T E
  function edit_location(id) {
    $('#location-box').modal('show');
    $.ajax({
      url: "<?php echo site_url('locations/edit') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'location_id='+id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="location_id"]').val(data.location_id);
        $('input[name="location_name"]').val(data.location_name);
        find(data.city_id);

        $('select[name="city_id"]').val(data.city_id);
        $('select[name="city_id"]').trigger("chosen:updated");
      }
    })
  }
  function update_Location() {
    $.ajax({
      url: "<?php echo site_url('locations/update') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#location').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#location-message").fadeIn("slow");
            $('#location-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#location-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#location-box').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E

function delete_location(id, name) {
    swal({
      title: 'Are you sure you want to delete '+name+'?',
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
        url: "<?php echo site_url('locations/delete') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'location_id='+id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#location-delete-message").fadeIn("slow");
              $('#location-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#location-delete-message').fadeOut('slow');
              }, 3000);
            }
          }else {
            // $('#message-text').html(data.message);
            // $('#successModal').modal('show');
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
  // END OF LOCATION BROWSE JAVASCRIPT
</script>