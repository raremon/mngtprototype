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
          <div id="bus-message"></div>
          <?php echo form_open('welcome', array('id'=>'bus')); ?>
          <div class="form-group hidden">
            <input type="text" name="bus_id" class="form-control"/>
          </div>
          <div class="form-group">
            <label>Bus Name</label>
            <input type="text" name="bus_name" class="form-control" placeholder="Star-8 Bus 1"/>
          </div>
          <div class="form-group">
            <label>Plate Number</label>
            <input type="text" name="plate_number" class="form-control" placeholder="3D-3382"/>
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="bus_desc" class="form-control" cols="30" rows="7" placeholder="The SunBus carries 30 people (incl. driver) with a range of approx 120km from a single battery charge.  Available with full airconditioning and strong suspension it is designed to give the passenger a smooth, comfortible ride that will greatly enhance the commuting experience."></textarea>
          </div>
          <div class="form-group">
            <label>Bus Type</label>
            <select name="bus_type" class="form-control">
              <?php 
                foreach($bustype as $row)
                {
              ?>
                <option value= <?php echo $row[0];?> >
                  <?php echo $row[1]; ?>
                </option>
              <?php 
                }
              ?>
            </select>
            <a class="btn btn-link pull-right" href="<?php echo site_url('buses/bus_type') ?>">Add Bus Types</a>
          </div>
          <button type="button" class="btn btn-primary save" onclick="save_Bus()">Save</button>
          <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Bus()">Update</button>
          <?php echo form_close(); ?>
        </div>

      </div> 

      <div class="container-fluid">

        <div class="col-md-12">
          <h3 class="page-header">Bus Data</h3>
          <table id="bus_data" class="table table-hover">
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

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">

  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////

  // C R E A T E
  function save_Bus() {
    $.ajax({
      url: "<?php echo site_url('buses/saveBus') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#bus').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $('#bus-message').html(data.errors).addClass('alert alert-danger');
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
  $("#bus_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('buses/show_Bus') ?>",
      "type":"POST"
    }
  })

  // U P D A T E
  function edit_bus(bus_id) {
    $.ajax({
      url: "<?php echo site_url('buses/edit_Bus') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'bus_id='+bus_id,
      encode:true,
      success:function (data) {
        $('.save').attr('disabled', true);
        $('.update').removeAttr('disabled');
        $('input[name="bus_id"]').val(data.bus_id);
        $('input[name="bus_name"]').val(data.bus_name);
        $('input[name="plate_number"]').val(data.plate_number);
        $('textarea[name="bus_desc"]').val(data.bus_desc);
        $('select[name="bus_type"]').val(data.bus_type);
      }
    })
  }

  function update_Bus() {
    $.ajax({
      url: "<?php echo site_url('buses/updateBus') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#bus').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
          $('#bus-message').html(data.errors).addClass('alert alert-danger');
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

  // END OF BUS ADD JAVASCRIPT
</script>