<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title">Delete Bus Data</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="container-fluid">
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-ban"></i> Alert!</h4>
          This action will permanently delete the user and will no longer have access to the site.
        </div>
        <div class="col-md-12">
          <div id="bus-message"></div>
          <table id="bus_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>BUS ID</th>
                <th>BUS NAME</th>
                <th>PLATE NUMBER</th>
                <th>BUS DESCRIPTION</th>
                <th>BUS TYPE</th>
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
  $("#bus_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('buses/show_Bus_Delete') ?>",
      "type":"POST"
    }
  })
  // D E L E T E
  function delete_bus(bus_id) {
    if(confirm('Do you really want to delete this Bus Record ??')){
      $.ajax({
        url: "<?php echo site_url('buses/delete_Bus/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'bus_id='+bus_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#bus-message").fadeIn("slow");
              $('#bus-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#bus-message').fadeOut('slow');
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
  // END OF BUS ADD JAVASCRIPT
</script>