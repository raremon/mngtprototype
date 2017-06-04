<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Region Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="region-message"></div>
          <?php echo form_open('welcome', array('id'=>'region')); ?>
          <div class="form-group">
            <label>Region Abbreviation</label>
            <input type="text" name="region_abbr" class="form-control" placeholder="Enter Region Abbreviation"/>
          </div>
          <div class="form-group">
            <label>Region Name</label>
            <input type="text" name="region_name" class="form-control" placeholder="Enter Region Name"/>
          </div>
          <button type="button" class="btn btn-primary save" onclick="save_Region()">Save</button>
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
  function save_Region() {
    $.ajax({
      url: "<?php echo site_url('regions/saveRegion') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#region').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $(window).scrollTop(0);
            $("#region-message").fadeIn("slow");
            $('#region-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#region-message').fadeOut('slow');
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

  // END OF REGION ADD JAVASCRIPT
</script>