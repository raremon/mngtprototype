<div class="box box-success hidden" id="form-box">
  <div class="box-header with-border">
    <h3 class="box-title">Assign Media</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="media-message"></div>
          <?php echo form_open('welcome', array('id'=>'media')); ?>
          <div class="form-group hidden">
            <input type="text" name="ready_vehicle_id" class="form-control"/>
          </div>
          <div class="form-group">
            <label>Vehicle Type</label>
            <select id="vehicle_type" class="form-control">
              <?php 
                foreach($types as $row)
                {
              ?>
                <option value= <?php echo $row[0];?> >
                  <?php echo $row[1]; ?>
                </option>
              <?php 
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Unassigned Vehicles</label>
            <select name="vehicle_id" id="vehicle" class="form-control">
            </select>
          </div>
          <div class="form-group">
            <label>Unassigned Mediaboxes</label>
            <select name="box_id" class="form-control">
              <?php 
                foreach($boxes as $row)
                {
              ?>
                <option value= <?php echo $row[0];?> >
                  <?php echo $row[1]; ?>
                </option>
              <?php 
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Unassigned TVs</label>
            <select name="tv_id" class="form-control">
              <?php 
                foreach($tvs as $row)
                {
              ?>
                <option value= <?php echo $row[0];?> >
                  <?php echo $row[1]; ?>
                </option>
              <?php 
                }
              ?>
            </select>
          </div>
          <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Media()">Update</button>
          <?php echo form_close(); ?>
        </div>
      </div> 
  </div>
  <div class="box-footer">
  </div>
</div>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Vehicle with Tv and Mediabox</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
    <div id="media-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="media_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>VEHICLE NAME</th>
                <th>MEDIABOX TAG</th>
                <th>TV SERIAL</th>
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
  var vehicles = [];
  <?php 
    foreach($vehicles as $row)
    {
  ?>
    vehicles.push([
      <?php echo $row[0]; ?>,
      "<?php echo $row[1]; ?>",
      <?php echo $row[2]; ?>,
    ]);
  <?php 
    }
  ?>

  var filtered = [];

  $( document ).ready(function() {
    filter();

    if($('select[name="vehicle_id"] > option').length == 0 || $('select[name="vehicle_id"] > option').length == 0 || $('select[name="tv_id"] > option').length == 0)
    {
      $('.save').attr('disabled');
    }
  });

  function findVehicle(vehicle_id) {
    for(var a = 0 ; a < vehicles.length ; a++)
    {
      if(vehicles[a][0] == vehicle_id)
      {
        $('#vehicle_type').val(vehicles[a][2]);
        $('#vehicle_type').change();
      }
    }
  }

  function filter() {
    filtered=[];
    for(var a = 0 ; a < vehicles.length ; a++)
    {
      if(vehicles[a][2] == $('#vehicle_type').val())
      {
        filtered.push([
          vehicles[a][0],
          vehicles[a][1],
        ]);
      }
      else
      {
      }
    }
    $('#vehicle')
      .find('option')
      .remove()
      .end()
    ;
    if(filtered.length<1)
    {
      $('#vehicle')
        .append('<option value=0>NO CITY ON THAT REGION</option>')
        .val(0)
      ;
    }
    else
    {
      $.each(filtered, function(key, value) {   
        $('#vehicle')
          .append($('<option>', { value : value[0] })
          .text(value[1])); 
      });
    }
  }

  $( "#vehicle_type" ).change(function() {
    filter();
  });
  // R E A D
  $("#media_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('media/showMedia') ?>",
      "type":"POST"
    }
  })
  // U P D A T E
  function edit_media(ready_vehicle_id) {
    $('#form-box').removeClass('hidden');
    $.ajax({
      url: "<?php echo site_url('media/editMedia') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'ready_vehicle_id='+ready_vehicle_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="ready_vehicle_id"]').val(data.ready_vehicle_id);
        $('select[name="box_id"]').val(data.box_id);
        $('select[name="tv_id"]').val(data.tv_id);
        findVehicle(data.vehicle_id);
        $('select[name="vehicle_id"]').val(data.vehicle_id);
      }
    })
  }
  function update_Media() {
    $.ajax({
      url: "<?php echo site_url('media/updateMedia') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#media').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#media-message").fadeIn("slow");
            $('#media-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#media-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
  function delete_media(media_id) {
    if(confirm('Do you really want to delete this Media Record ??')){
      $.ajax({
        url: "<?php echo site_url('media/delete_Media/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'ready_vehicle_id='+media_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#media-delete-message").fadeIn("slow");
              $('#media-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#media-delete-message').fadeOut('slow');
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
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF MEDIABOX BROWSE JAVASCRIPT
</script>