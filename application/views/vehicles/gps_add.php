<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">GPS Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="gps-message"></div>
          <?php echo form_open('welcome', array('id'=>'gps')); ?>
          <div class="form-group">
            <label>GPS Serial</label>
            <input type="text" name="gps_serial" class="form-control" placeholder="Enter GPS' Serial"/>
          </div>
          <div class="form-group">
            <label>GPS Description</label>
            <textarea name="gps_description" class="form-control" cols="30" rows="7" placeholder="Enter GPS' Description"></textarea>
          </div>
          <button type="button" class="btn btn-primary save" onclick="save_Gps()">Save</button>
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
  function save_Gps() {
    $.ajax({
      url: "<?php echo site_url('gps/save') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#gps').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $(window).scrollTop(0);
            $("#gps-message").fadeIn("slow");
            $('#gps-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#gps-message').fadeOut('slow');
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
  // END OF GPS ADD JAVASCRIPT
</script>