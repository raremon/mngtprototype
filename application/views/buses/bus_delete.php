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
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Delete Bus Data</h3>
        <div class="box-tools pull-right">
          <!-- Buttons, labels, and many other things can be placed here! -->
        </div><!-- /.box-tools -->
      </div><!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="container-fluid">

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
      </div><!-- /.box-body -->
      <div class="box-footer">
      </div><!-- box-footer -->
    </div><!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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
              $('#bus-message').html(data.errors).addClass('alert alert-danger');
            }
          }else {
            $('#bus-message').html(data.message).addClass('alert alert-success').removeClass('alert alert-danger');
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

  // END OF BUS ADD JAVASCRIPT
</script>