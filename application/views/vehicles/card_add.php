<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Card Reader Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="card-message"></div>
          <?php echo form_open('welcome', array('id'=>'card')); ?>
          <div class="form-group">
            <label>Card Reader Serial</label>
            <input type="text" name="card_serial" class="form-control" placeholder="Enter Card Reader's Serial"/>
          </div>
          <div class="form-group">
            <label>Card Reader Description</label>
            <textarea name="card_description" class="form-control" cols="30" rows="7" placeholder="Enter Card Reader's Description"></textarea>
          </div>
          <button type="button" class="btn btn-primary save" onclick="save_Card()">Save</button>
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
  function save_Card() {
    $.ajax({
      url: "<?php echo site_url('card_readers/save') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#card').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $(window).scrollTop(0);
            $("#card-message").fadeIn("slow");
            $('#card-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#card-message').fadeOut('slow');
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
  // END OF CARD READER ADD JAVASCRIPT
</script>