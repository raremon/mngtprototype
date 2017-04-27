<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $title; ?>
      <small><?php echo $page_description; ?></small>
    </h1>
    <ol class="breadcrumb">
      <i class="fa fa-dashboard"></i>&nbsp;
      <?php foreach($breadcrumbs as $row) { ?>
        <li><a href="<?php echo base_url($row[1]) ?>"><?php echo $row[0]; ?></a></li>
      <?php } ?>
      <li class="active">Here</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="container">

        <div class="col-md-12">
          <div id="user-message"></div>
          <?php echo form_open('welcome', array('id'=>'user')); ?>
          <div class="form-group hidden">
            <input type="text" name="user_id" class="form-control"/>
          </div>
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="user_fname" class="form-control" placeholder="Cee Jay"/>
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="user_lname" class="form-control" placeholder="Reyes"/>
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
            <input type="text" name="user_name" class="form-control" placeholder="masterofdeCEEption"/>
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
          <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_User()">Update</button>
          <?php echo form_close(); ?>
        </div>

      </div> 

      <div class="container-fluid">

        <div class="col-md-12">
          <h3 class="page-header">User Data</h3>
          <table id="user_data" class="table table-hover">
            <thead>
              <tr>
                <th>USER ID</th>
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

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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
            $('#user-message').html(data.errors).addClass('alert alert-danger');
          }
        }else {
          alert(data.message);
          setTimeout(function() {
            window.location.reload()
          }, 400);
        }
      }
    })
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
    $.ajax({
      url: "<?php echo site_url('users/editUser') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'user_id='+user_id,
      encode:true,
      success:function (data) {
        $('.save').attr('disabled', true);
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
          $('#user-message').html(data.errors).addClass('alert alert-danger');
        }else {
          alert(data.message);
          setTimeout(function () {
            window.location.reload();
          }, 400);
        }
      }
    })
  }

  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////

  // END OF USER ADD JAVASCRIPT
</script>