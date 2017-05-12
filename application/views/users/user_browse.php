<div class="box box-success hidden" id="form-box">
  <div class="box-header with-border">
    <h3 class="box-title">User Details</h3>
    <div class="box-tools pull-right">
      <button class="btn btn-small btn-danger" onclick="closebox()">x</button>
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
          <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_User()">Update</button>
          <?php echo form_close(); ?>
        </div>
      </div> 
  </div>
  <div class="box-footer">
  </div>
</div>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">User Data</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
    <div id="user-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="user_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>ROLE</th>
                <th>USERNAME</th>
                <th>LAST LOGIN</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
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
  // O T H E R
  function closebox() {
    $('#form-box').addClass('hidden');
  }
  // R E A D
  $("#user_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('users/showUser') ?>",
      "type":"POST"
    }
  })
  // U P D A T E
  function edit_user(user_id) {
    $('#form-box').removeClass('hidden');
    $.ajax({
      url: "<?php echo site_url('users/editUser') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'user_id='+user_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="user_id"]').val(data.user_id);
        $('input[name="user_fname"]').val(data.user_fname);
        $('input[name="user_lname"]').val(data.user_lname);
        $('select[name="user_role"]').val(data.user_role);
        $('input[name="user_name"]').val(data.user_name);
      }
    })
  }
  function update_User() {
    $.ajax({
      url: "<?php echo site_url('users/updateUser') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#user').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#user-message").fadeIn("slow");
            $('#user-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#user-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
  function delete_user(user_id) {
    if(confirm('Do you really want to delete this User Record ??')){
      if(user_id == '<?php echo $this->session->userdata("user_id") ?>')
      {
        $(window).scrollTop(0);
        $("#user-delete-message").fadeIn("slow");
        $('#user-delete-message').html("Cannot delete your own account!").addClass('alert alert-danger');
        setTimeout(function() {
            $('#user-delete-message').fadeOut('slow');
        }, 3000);
      }
      else
      {
        $.ajax({
          url: "<?php echo site_url('users/delete_User/') ?>",
          type: 'POST',
          dataType: 'json',
          data: 'user_id='+user_id,
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
        });
      }
    }
  }
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF USER ADD JAVASCRIPT
</script>