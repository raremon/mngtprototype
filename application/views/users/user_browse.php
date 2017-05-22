<div class="modal fade" id="user-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">User Details</h4>
      </div>
      <div class="modal-body">
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
                <select name="user_role" class="form-control select2">
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
              <?php echo form_close(); ?>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_User()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">User Data</h3>
    <div class="box-tools pull-right">
        <a class="btn btn-link add-link" href="<?php echo base_url('users/add') ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New User</a>
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
  $(".select2").select2();
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
    $('#user-box').modal('show');
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
          $('#user-box').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
  function delete_user(user_id) {
    swal({
      title: 'ARE YOU SURE?',
      text: "You cannot revert this action!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Delete',
      cancelButtonText: 'Cancel',
      confirmButtonClass: 'btn btn-success btn-fix',
      cancelButtonClass: 'btn btn-default',
      animation: false,
      customClass: 'animated fadeInDown',
      buttonsStyling: false
    }).then(function () {
        swal({
         //pede to ilagay sa success modal di ko mahanap kung saan
          title: 'DELETED SUCCESSFULLY',
          type: 'success',
          confirmButtonText: 'Okay',
          confirmButtonClass: 'btn btn-success btn-fix',
          buttonsStyling: false
        })
    }, function (dismiss) {
      if (dismiss === 'cancel') {
        swal({
          title: 'CANCELLED',
          type: 'error',
          confirmButtonText: 'Okay',
          confirmButtonClass: 'btn btn-default btn-fix',
          buttonsStyling: false
        })
      }
    })
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
  // END OF USER BROWSE JAVASCRIPT
</script>