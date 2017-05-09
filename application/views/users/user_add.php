<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">User Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="user-message"></div>
          <?php echo form_open('welcome', array('id'=>'user')); ?>
          <div class="form-group hidden">
            <input type="text" name="user_id" class="form-control"/>
          </div>
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="user_fname" class="form-control" placeholder="Enter First Name"/>
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="user_lname" class="form-control" placeholder="Enter Last Name"/>
          </div>
          <div class="form-group">
            <label>User Role</label>
            <select name="user_role" class="form-control">
              <?php 
                foreach($roles as $row)
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
            <label>Username</label>
            <input type="text" name="user_name" class="form-control" placeholder="Enter Username"/>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="user_password" class="form-control" placeholder="***********"/>
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" placeholder="***********"/>
          </div>
          <button type="button" class="btn btn-primary save" onclick="save_User()">Save</button>
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
  function save_User() {
    $.ajax({
      url: "<?php echo site_url('users/saveUser') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#user').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $(window).scrollTop(0);
            $("#user-message").fadeIn("slow");
            $('#user-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#user-message').fadeOut('slow');
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

  // END OF USER ADD JAVASCRIPT
</script>