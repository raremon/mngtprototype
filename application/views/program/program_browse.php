<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Browse Program Schedule</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->

  <div class="box-body">

    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">By Advertiser</a></li>
        <li><a href="#tab_2" data-toggle="tab">By Route</a></li>
        <li><a href="#tab_3" data-toggle="tab">By Schedule Type</a></li>
        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
      </ul>
      <div class="tab-content">

        <div class="tab-pane active" id="tab_1">
          <div class="form-group">
            <label>Select Advertiser:</label>
            <select id="advertiser_id" class="form-control">
              <?php 
                foreach($advertiser as $row)
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
          <div class="col-md-12">
            <table id="advertiserTable" class="table table-hover table-bordered" width="100%">
              <thead>
                <tr>
                  <th></th>
                  <th>ROUTE</th>
                  <th>STARTING DATE</th>
                  <th>ENDING DATE</th>
                  <th>SCHEDULE TYPE</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>

        <div class="tab-pane" id="tab_2">
          <div class="form-group">
            <label for="route_list">Select Route:</label>
            <select id="route_id" class="form-control">
              <?php 
                foreach($route as $row)
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
          <div class="col-md-12">
            <table id="routeTable" class="table table-hover table-bordered" width="100%">
              <thead>
                <tr>
                  <th></th>
                  <th>ADVERTISER</th>
                  <th>STARTING DATE</th>
                  <th>ENDING DATE</th>
                  <th>SCHEDULE TYPE</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>

        <div class="tab-pane" id="tab_3">
          <div class="form-group">
            <label for="type_list">Select Schedule Type:</label>
            <select id="type_id" class="form-control">
              <option value="1">Regular</option>
              <option value="2">Scheduled</option>
              <option value="3">Block</option>
            </select>
          </div>
          <div class="col-md-12">
            <table id="typeTable" class="table table-hover table-bordered" width="100%">
              <thead>
                <tr>
                  <th></th>
                  <th>ADVERTISER</th>
                  <th>ROUTE</th>
                  <th>STARTING DATE</th>
                  <th>ENDING DATE</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>

        </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->

  </div><!-- /.box-body -->
    
  <div class="box-footer">
  </div><!-- box-footer -->
</div><!-- /.box -->

<script type="text/javascript">
  $( document ).ready(function() {
    var selectedAdvertiser = $('#advertiser_id').val();
    $("#advertiserTable").DataTable({
      ajax:{
        url:"<?php echo site_url('program/advertiser_Table/" + selectedAdvertiser + "') ?>",
        type:"POST",
      },
      "columns": [
        null,
        null,
        null,
        null,
        null,
      ]
    })
  });

  $("#advertiser_id").change(function() {
    var advertiser = $('#advertiser_id').val();
    $.get("<?php echo site_url('program/advertiser_Table/" + advertiser + "') ?>", function(data){
      var ads_tbl = $.map(data, function(el) { return el; });
      $('#advertiserTable').dataTable().fnClearTable();
      if(ads_tbl.length > 0)
      {
        $('#advertiserTable').dataTable().fnAddData(ads_tbl);
      }
    });     
  });

  $( document ).ready(function() {
    var selectedRoute = $('#route_id').val();
    $("#routeTable").DataTable({
      ajax:{
        url:"<?php echo site_url('program/route_Table/" + selectedRoute + "') ?>",
        type:"POST",
      },
      "columns": [
        null,
        null,
        null,
        null,
        null,
      ]
    })
  });

  $("#route_id").change(function() {
    var route = $('#route_id').val();
    $.get("<?php echo site_url('program/route_Table/" + route + "') ?>", function(data){
      var ads_tbl = $.map(data, function(el) { return el; });
      $('#routeTable').dataTable().fnClearTable();
      if(ads_tbl.length > 0)
      {
        $('#routeTable').dataTable().fnAddData(ads_tbl);
      }
    });     
  });

  $( document ).ready(function() {
    var selectedType = $('#type_id').val();
    $("#typeTable").DataTable({
      ajax:{
        url:"<?php echo site_url('program/type_Table/" + selectedType + "') ?>",
        type:"POST",
      },
      "columns": [
        null,
        null,
        null,
        null,
        null,
      ]
    })
  });

  $("#type_id").change(function() {
    var type = $('#type_id').val();
    $.get("<?php echo site_url('program/type_Table/" + type + "') ?>", function(data){
      var ads_tbl = $.map(data, function(el) { return el; });
      $('#typeTable').dataTable().fnClearTable();
      if(ads_tbl.length > 0)
      {
        $('#typeTable').dataTable().fnAddData(ads_tbl);
      }
    });     
  });

</script>