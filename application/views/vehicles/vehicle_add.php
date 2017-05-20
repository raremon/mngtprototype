<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Vehicle Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="vehicle-message"></div>
          <?php echo form_open('welcome', array('id'=>'vehicle')); ?>
          <div class="form-group">
            <label>Vehicle Name</label>
            <input type="text" name="vehicle_name" class="form-control" placeholder="Enter Vehicle Name"/>
          </div>
          <div class="form-group">
            <label>Plate Number</label>
            <input type="text" name="plate_number" class="form-control" placeholder="Enter Plate Number"/>
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="vehicle_description" class="form-control" cols="30" rows="7" placeholder="Enter Short Description"></textarea>
          </div>
          <div class="form-group">
            <label>Vehicle Type</label>
            <select name="vehicle_type" class="form-control">
              <?php 
                foreach($type as $row)
                {
              ?>
                <option value= <?php echo $row[0];?> >
                  <?php echo $row[1]; ?>
                </option>
              <?php 
                }
              ?>
            </select>
            <a class="btn btn-link pull-right" href="<?php echo site_url('vehicles/browse_type') ?>">Browse Vehicle Types</a>
          </div>
          <button type="button" class="btn btn-primary save" onclick="save_Vehicle()">Save</button>
          <?php echo form_close(); ?>
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
  function save_Vehicle() {
    $.ajax({
      url: "<?php echo site_url('vehicles/saveVehicle') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#vehicle').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $(window).scrollTop(0);
            $("#vehicle-message").fadeIn("slow");
            $('#vehicle-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#vehicle-message').fadeOut('slow');
            }, 3000);
          }
        }else {
          $('#message-text').html(data.message);
          $('#successModal').modal('show');
        }
      }
    })
  }
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF VEHICLE ADD JAVASCRIPT
</script>