<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Cashier Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="route-message"></div>
          <?php echo form_open('welcome', array('id'=>'cashierAddForm')); ?>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" placeholder="Enter First Name"/>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name"/>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="************"/>
            </div>
            <div class="form-group">
                <label>Card ID</label>
                <input type="text" name="card_id" class="form-control" placeholder="Enter Card ID"/>
            </div>
            <button type="button" class="btn btn-primary save" onclick="save_Cashier()">Save</button>
          <?php echo form_close(); ?>
        </div>
      </div> 
  </div>
  <div class="box-footer">
  </div>
</div>

<script type="text/javascript">
function save_Cashier() {
      $.ajax({
        url: "<?php echo site_url('cashiers/saveCashier') ?>",
        type: 'POST',
        dataType: 'json',
        data: $('#cashierAddForm').serialize(),
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#route-message").fadeIn("slow");
              $('#route-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#route-message').fadeOut('slow');
              }, 3000);
            }
          }else {
            $('#message-text').html(data.message);
            $('#successModal').modal('show');
          }
        }
      });
  }
</script>