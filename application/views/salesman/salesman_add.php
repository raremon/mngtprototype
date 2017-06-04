<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Salesman Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="sales-message"></div>
          <?php echo form_open('welcome', array('id'=>'sales')); ?>
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="sales_fname" class="form-control" placeholder="Enter First Name"/>
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="sales_lname" class="form-control" placeholder="Enter Last Name"/>
          </div>
          <div class="form-group">
            <label>Contact Information</label>
            <input type="text" name="sales_contactno" class="form-control" placeholder="Enter Contact Information"/>
          </div>
          <div class="form-group">
            <label>Email Address</label>
            <input type="text" name="sales_email" class="form-control" placeholder="Enter Email Address"/>
          </div>
          <button type="button" class="btn btn-primary save" onclick="save_Sales()">Save</button>
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
  function save_Sales() {
    $.ajax({
      url: "<?php echo site_url('salesman/save') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#sales').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $(window).scrollTop(0);
            $("#sales-message").fadeIn("slow");
            $('#sales-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#sales-message').fadeOut('slow');
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
  // END OF SALESMEN ADD JAVASCRIPT
</script>