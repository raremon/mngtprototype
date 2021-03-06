<div class="modal fade" id="add-route-box" role="dialog" style="z-index: 1200 !important;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ad Details</h4>
      </div>
      <div class="modal-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="route-message"></div>
          <?php echo form_open('', array('id'=>'route')); ?>
            <div class="form-group">
              <label>Region From</label>
              <select data-placeholder="No regions on the data" id="region_from" class="select2 form-control">
                <option value="all">All Regions</option>
                <?php 
                  foreach($region as $row)
                  {
                ?>
                  <option value= <?php echo $row[0];?> >
                    <?php echo $row[1]; ?>
                  </option>
                <?php 
                  }
                ?>
              </select>
              <a class="btn btn-link pull-right" href="<?php echo site_url('regions/add') ?>">Add Region</a>
            </div>
            <div class="form-group">
              <label>City From</label>
              <select data-placeholder="No cities in that region" id="city_from" name="city_from" class="select2 form-control">
              </select>
              <a class="btn btn-link pull-right" href="<?php echo site_url('cities/add') ?>">Add City</a>
            </div>
            <div class="form-group">
              <label>Location From</label>
              <select data-placeholder="No locations in that city" id="location_from" name="location_from" class="select2 form-control">
              </select>
              <a class="btn btn-link pull-right" href="<?php echo site_url('locations/add') ?>">Add Location</a>
            </div>


            <div class="form-group">
              <label>Region To</label>
              <select data-placeholder="No regions on the data" id="region_to" class="select2 form-control">
                <option value="all">All Regions</option>
                <?php 
                  foreach($region as $row)
                  {
                ?>
                  <option value= <?php echo $row[0];?> >
                    <?php echo $row[1]; ?>
                  </option>
                <?php 
                  }
                ?>
              </select>
              <a class="btn btn-link pull-right" href="<?php echo site_url('regions/add') ?>">Add Region</a>
            </div>
            <div class="form-group">
              <label>City To</label>
              <select data-placeholder="No cities in that region" id="city_to" name="city_to" class="select2 form-control">
              </select>
              <a class="btn btn-link pull-right" href="<?php echo site_url('cities/add') ?>">Add City</a>
            </div>
            <div class="form-group">
              <label>Location To</label>
              <select data-placeholder="No locations in that city" id="location_to" name="location_to" class="select2 form-control">
              </select>
              <a class="btn btn-link pull-right" href="<?php echo site_url('locations/add') ?>">Add Location</a>
            </div>


            <div class="form-group">
              <label>Route Name</label>
              <input type="text" name="route_name" class="form-control" placeholder="Enter Route Name"/>
            </div>
            <div class="form-group">
              <label>Route Description</label>
              <textarea name="route_description" class="form-control" cols="30" rows="7" placeholder="Enter Route Description"></textarea>
            </div>
          <?php echo form_close(); ?>
        </div>
      </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary save" onclick="save_Route()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="vehicle-assign-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Route List</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <div class="col-md-12">
              <div id="media-message"></div>
              <div class="form-group">
                <label for="route_list">Select Route:</label>
                <select id="route_id" name="route_id" class="form-control select2" style="width:100%;">
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
                <a class="btn btn-link pull-right" href="#/" onclick="addRoute()">Add Routes</a>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <button id="" type="button" class="btn btn-success">Deploy</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Deploy</h3>
    <div class="box-tools pull-right"></div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
            <div id="form-group">
              <div class="col-md-12">
                  <div class="form-group">
                    <label>Select Vehicle Type</label>
                    <select id="vehicle_type" class="form-control select2">
                        <option selected value="def">
                          Vehicle Types...
                        </option>
                      <?php 
                        foreach($types as $row)
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
              </div>

            </div>
          <?php echo form_close(); ?>
        </div>
      </div> 
  </div>
  <div class="box-footer">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="sales_data" class="table table-hover table-bordered hidden-table">
            <thead>
              <tr>
                <th>VEHICLE TYPE</th>
                <th>VEHICLE NAME</th>
                <th>STATUS</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>VEHICLE TYPE</td>
                <td>VEHICLE NAME</td>
                <td><button type="button" class="btn btn-success" onclick="openModal()">Assign</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
  </div>
</div>

<script type="text/javascript">
$(".select2").select2();
$('.select2-selection__rendered').removeAttr('title');
$(".hidden-table").hide();
$("#vehicle_type").change(function () {
        $(".hidden-table").show();
        $("#vehicle_type option[value='def']").remove();
        $('.select2-selection__rendered').removeAttr('title');
    });
  function addRoute() {
      $("#add-route-box").modal('show');
  }
  function openModal(){
    $('#vehicle-assign-box').modal('show');
  }     

  // S E L E C T I O N
  function selectVehicle() {
    $('#vehicle-assign-box').modal('hide');
    $('#vehicle_name').val($('#vehicle option:selected').text());
    $('#vehicle_id').val($('#vehicle').val());

    $.get("<?php echo site_url('media/getVehicleInfo/" + $(\'#vehicle_id\').val() + "') ?>", function(data){
      var info = $.map(data, function(el) { return el; });
      filterDevice(info);
    }); 
  }

  // VEHICLE
  var vehicles = [];
  <?php 
    foreach($vehicles as $row)
    {
  ?>
    vehicles.push([
      <?php echo $row[0]; ?>,
      "<?php echo $row[1]; ?>",
      <?php echo $row[2]; ?>,
    ]);
  <?php 
    }
  ?>
  // VEHICLE SELECTION 
  var filtered = [];
  $( document ).ready(function() {
    filter();
    assign_init();
    if($('#vehicle > option').length == 0)
    {
      $("#media-message").fadeIn("slow");
      $('#media-message').html("NOT ENOUGH RESOURCES TO SAVE").addClass('alert alert-danger');
      $('.save').prop('disabled', true);
    }
  });
  function filter() {
    filtered=[];
    for(var a = 0 ; a < vehicles.length ; a++)
    {
      if(vehicles[a][2] == $('#vehicle_type').val())
      {
        filtered.push([
          vehicles[a][0],
          vehicles[a][1],
        ]);
      }
      else
      {
      }
    }
    $('#vehicle')
      .find('option')
      .remove()
      .end()
    ;
    if(filtered.length<1)
    {
      $('#vehicle')
        .append('<option value=0>NO VEHICLE OF THAT TYPE</option>')
        .val(0)
      ;
    }
    else
    {
      $('.select').prop('disabled', false);
      $.each(filtered, function(key, value) {   
        $('#vehicle')
          .append($('<option>', { value : value[0] })
          .text(value[1])); 
      });
    }
  }
  $( "#vehicle_type" ).change(function() {
    $('.select').prop('disabled', true);
    filter();
  });

  
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////

</script>