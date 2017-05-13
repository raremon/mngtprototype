<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Mediabox Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="box-message"></div>
          <?php echo form_open('welcome', array('id'=>'box')); ?>
          <div class="form-group">
            <label>Box Tag</label>
            <input type="text" name="box_tag" class="form-control" placeholder="Enter Mediabox Tag"/>
          </div>
          <button type="button" class="btn btn-primary save" onclick="save_Box()">Save</button>
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
  function save_Box() {
    $.ajax({
      url: "<?php echo site_url('mediaboxes/saveBox') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#box').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $(window).scrollTop(0);
            $("#box-message").fadeIn("slow");
            $('#box-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#box-message').fadeOut('slow');
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
  // END OF MEDIABOX ADD JAVASCRIPT
</script>