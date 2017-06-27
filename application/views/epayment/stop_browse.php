<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJAq_K8XorLcD2nKKsrmB7BserF3Wh3Ss&libraries=places" type="text/javascript"></script>

<div class="box box-success">
    <div class="row">
      <div class="container-fluid">
        <?php echo $route_details; ?>
      </div>
    </div>
  <div style='margin-top:20px' class="box-header with-border">
    <h3 class="box-title">Stops Data</h3>
    <div class="box-tools pull-right">
        <a href="javascript:void(0)" class="btn btn-primary add-link" onclick="fare_matrix(<?php echo $_GET['id']; ?>)"><i class="fa fa-table">&nbsp;</i>Fare Matrix</a>
        <a class="btn btn-link add-link" href="<?php echo base_url('stops/add?id='.$_GET['id']) ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New Stop</a>
    </div>
  </div>
  <div class="box-body">
    <div id="route-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="stop_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>STOP NAME</th>
                <th>STOP DESCRIPTION</th>
                <th>LOCATION</th>
                <th>MAP</th>
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


<div id="fareMatrix" class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="text-align: center" class="modal-title"><b>Fare Matrix</b><br>(<?php echo $page_description; ?>)</h4>
            </div>
            <div class="modal-body">
                <h4 style="text-align: center"><b>PUBLIC UTILITY BUS</b></h4>
                <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="head"></thead>
                    <tbody id="PUB"></tbody>
                </table>
                </div>
                <div class="table-responsive">
                <h4 style="text-align: center"><b>PUBLIC UTILITY JEEP</b></h4>
                <table class="table table-hover table-bordered">
                    <thead class="head">
                        
                    </thead>
                    <tbody id="PUJ">
                        
                    </tbody>
                </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="editStop" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Stop Details</h4>
            </div>
            <div class="modal-body">
                <div id="route-message"></div>
                <form method="POST" id="stopEditForm" accept-charset="utf-8">
                    <input type="hidden" name='stop_id'>
                    <div class="form-group">
            <label>Region</label>
            <select data-placeholder="No regions on the data" id="region" class="select2 form-control">
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
              <label>City</label>
              <select data-placeholder="No cities in that region" id="city" name="city" class="select2 form-control">
              </select>
              <a class="btn btn-link pull-right" href="<?php echo site_url('cities/add') ?>">Add City</a>
            </div>
          <div class="form-group">
              <label>Location</label>
              <select data-placeholder="No locations in that city" id="location" name="location" class="select2 form-control">
              </select>
              <a class="btn btn-link pull-right" href="<?php echo site_url('locations/add') ?>">Add Location</a>
            </div>
            <div class="form-group">
              <label>Stop Name</label>
              <input type="text" name="stop_name" class="form-control" placeholder="Enter Stop Name"/>
            </div>
            <div class="form-group">
              <label>Stop Description</label>
              <textarea name="stop_description" class="form-control" cols="30" rows="7" placeholder="Enter Stop Description"></textarea>
            </div>
            <input type="hidden" value="<?php echo $_GET['id']; ?>" name="route"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Fare()">Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$("#stop_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('stops/showStops?id='.$_GET['id']) ?>",
      "type":"POST"
    }
  })
  
  
  function fare_matrix(id) {
    $('#fareMatrix').modal('show');
    $.ajax({
      url: "<?php echo site_url('stops/PUBFareMatrix?id='.$_GET['id']) ?>",
      type: 'POST',
      success:function (data) {
        $("#PUB").html(data);
      }
    });
    $.ajax({
      url: "<?php echo site_url('stops/PUJFareMatrix?id='.$_GET['id']) ?>",
      type: 'POST',
      success:function (data) {
        $("#PUJ").html(data);
      }
    });
    $.ajax({
      url: "<?php echo site_url('stops/FareMatrixHead?id='.$_GET['id']) ?>",
      type: 'POST',
      success:function (data) {
        $(".head").html(data);
      }
    });
  }
  
  function edit_stop(stop_id) {
    $('#editStop').modal('show');
    $.ajax({
      url: "<?php echo site_url('stops/editStop') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'stop_id='+stop_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="stop_id"]').val(data.stop_id);
        $('input[name="stop_name"]').val(data.stop_name);
        $('textarea[name="stop_description"]').val(data.stop_description);

        $('select[id="region"]').val(data[0]['region']).trigger('change');

        $('select[name="city"]').val(data[0]['city']).trigger('change');

        $('select[name="location"]').val(data.location).trigger('change');
      }
    });
  }
  function update_Fare() {
    $.ajax({
      url: "<?php echo site_url('stops/updateStop') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#stopEditForm').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#route-message").fadeIn("slow");
            $('#route-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#route-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#editStop').modal('hide'); 
          $('#successModal').modal('show');
        }
      }
    });
  }
  
  function delete_stop(stop_id) {
    swal({
      title: 'Are you sure you want to delete?',
      text: "You cannot revert this action!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Delete',
      cancelButtonText: 'Cancel',
      confirmButtonClass: 'btn btn-success btn-fix',
      cancelButtonClass: 'btn btn-default',
      animation: false,
      customClass: 'animated fadeInDown',
      buttonsStyling: false
    }).then(function () {
      $.ajax({
        url: "<?php echo site_url('stops/delete_Stop') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'stop_id='+stop_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#route-delete-message").fadeIn("slow");
              $('#route-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#route-delete-message').fadeOut('slow');
              }, 3000);
            }
          }else {
//            $('#message-text').html(data.message);
//            $('#successModal').modal('show');
            swal({
             //pede to ilagay sa success modal di ko mahanap kung saan
              title: data.message,
              type: 'success',
              confirmButtonText: 'Okay',
              confirmButtonClass: 'btn btn-success btn-fix',
              buttonsStyling: false
            }).then(
              function () {
                window.location.reload();
              }
            );
          }
        }
      });
    }, function (dismiss) {
      if (dismiss === 'cancel') {
        swal({
          title: 'Cancelled',
          type: 'error',
          confirmButtonText: 'Okay',
          confirmButtonClass: 'btn btn-default btn-fix',
          buttonsStyling: false,
          timer: 3000
          
        });
      }
    });
  }  
  
  $(".select2").select2();
  $('.select2-selection__rendered').removeAttr('title');
    
  var cities = [];
  var city = [];
  city.push([
    "all",
    "All Cities",
    0,
  ]);
  <?php 
    foreach($city as $row)
    {
  ?>
    city.push([
      <?php echo $row[0]; ?>,
      "<?php echo $row[1]; ?>",
      <?php echo $row[2]; ?>,
    ]);
  <?php 
    }
  ?>

  var locations = [];
  <?php 
    foreach($location as $row)
    {
  ?>
    locations.push([
      <?php echo $row[0]; ?>,
      "<?php echo $row[1]; ?>",
      <?php echo $row[2]; ?>,
    ]);
  <?php 
    }
  ?>

  var filteredCity = [];
  var filteredLocation = [];

  $( document ).ready(function() {
    filterCity();
    filterLocation();
  });

  function filterCity() {
    filteredCity=[];
    for(var a = 0 ; a < city.length ; a++)
    {
      if($('#region').val() == "all")
      {
        filteredCity.push([
          city[a][0],
          city[a][1],
        ]);
      }
      else if(city[a][2] == $('#region').val())
      {
        filteredCity.push([
          city[a][0],
          city[a][1],
        ]);
      }
      else
      {
      }
    }
    $('#city')
      .find('option')
      .remove()
      .end()
    ;
    if(filteredCity.length<1)
    {
      $('.save').prop('disabled', true);
    }
    else
    {
      $.each(filteredCity, function(key, value) {   
        $('#city')
          .append($('<option>', { value : value[0] })
          .text(value[1])); 
      });
    }
  }

  function filterLocation() {
    filteredLocation=[];
    for(var a = 0 ; a < locations.length ; a++)
    {
      if($('#city').val() == "all")
      {
        filteredLocation.push([
          locations[a][0],
          locations[a][1],
        ]);
      }
      else if(locations[a][2] == $('#city').val())
      {
        filteredLocation.push([
          locations[a][0],
          locations[a][1],
        ]);
      }
      else
      {
      }
    }
    $('#location')
      .find('option')
      .remove()
      .end()
    ;
    locationTrim();
    if(filteredLocation.length<1)
    {
      $('.save').prop('disabled', true);
    }
    else
    {
      $.each(filteredLocation, function(key, value) {   
        $('#location')
          .append($('<option>', { value : value[0] })
          .text(value[1])); 
      });
    }
  }
  
  $( "#region" ).change(function() {
    $('.save').prop('disabled', false);
    filterCity();
    filterLocation();

    var temp = $( "#location" ).val();
    filterLocation();
    $("#location").val(temp);
  });

  $( "#city" ).change(function() {
    $('.save').prop('disabled', false);
    filterLocation();

    var temp = $( "#location" ).val();
    filterLocation();
    $("#location").val(temp);
  });
  
  function locationTrim() {
    for(var a = 0 ; a < filteredLocation.length ; a++)
    {
      if($("#location").val() == filteredLocation[a][0])
      {
        filteredLocation.splice(a, 1);
      }
    }
  }
</script>