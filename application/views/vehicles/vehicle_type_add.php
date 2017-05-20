<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Vehicle Type Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="type-message"></div>
          <?php echo form_open('welcome', array('id'=>'type')); ?>
          <div class="form-group">
            <label>Vehicle Type Name</label>
            <input type="text" name="vehicle_type_name" class="form-control" placeholder="Enter Vehicle Type Name"/>
          </div>
          <button type="button" class="btn btn-primary save" onclick="save_Type()">Save</button>
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
  function save_Type() {
    $.ajax({
      url: "<?php echo site_url('vehicles/saveType') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#type').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $(window).scrollTop(0);
            $("#type-message").fadeIn("slow");
            $('#type-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#type-message').fadeOut('slow');
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
  // END OF VEHICLE TYPE ADD JAVASCRIPT
</script>