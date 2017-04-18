<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $title; ?>
      <small><?php echo $page_description; ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $title; ?></a></li>
      <li class="active">Here</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="container-fluid">
        <div id="user-message"></div>
        <div class="col-md-12">
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

  // R E A D
  $("#user_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('users/showUserDelete') ?>",
      "type":"POST"
    }
  })

  // D E L E T E
  function delete_user(user_id) {
    if(confirm('Do you really want to delete this User Record ??')){
      $.ajax({
        url: "<?php echo site_url('users/delete_User/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'user_id='+user_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $('#user-message').html(data.errors).addClass('alert alert-danger');
            }
          }else {
            $('#user-message').html(data.message).addClass('alert alert-success').removeClass('alert alert-danger');
            setTimeout(function() {
              window.location.reload();
            }, 1000);
          }
        }
      });
    }
  }

  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////

  // END OF ROLE JAVASCRIPT
</script>