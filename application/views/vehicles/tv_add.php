<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">TV Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="tv-message"></div>
          <?php echo form_open('welcome', array('id'=>'tv')); ?>
          <div class="form-group">
            <label>TV Serial</label>
            <input type="text" name="tv_serial" class="form-control" placeholder="Enter Television's Serial"/>
          </div>
          <div class="form-group">
            <label>TV Description</label>
            <textarea name="tv_description" class="form-control" cols="30" rows="7" placeholder="Enter Television's Description"></textarea>
          </div>
          <button type="button" class="btn btn-primary save" onclick="save_Tv()">Save</button>
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
  function save_Tv() {
    $.ajax({
      url: "<?php echo site_url('tvs/saveTv') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#tv').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $(window).scrollTop(0);
            $("#tv-message").fadeIn("slow");
            $('#tv-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#tv-message').fadeOut('slow');
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
  // END OF TV ADD JAVASCRIPT
</script>