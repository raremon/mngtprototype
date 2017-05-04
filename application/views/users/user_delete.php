<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title">User List</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-ban"></i> Alert!</h4>
      This action will permanently delete the user and will no longer have access to the site.
    </div>
    <div class="row">
      <div class="container-fluid">
        <div id="user-message"></div>
        <div class="col-md-12">
          <table id="user_data" class="table table-hover table-bordered">
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
  </div>
  <div class="box-footer">
  </div>
</div>
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
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF USER DELETE JAVASCRIPT
</script>