<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJAq_K8XorLcD2nKKsrmB7BserF3Wh3Ss&libraries=places" type="text/javascript"></script>

<div class="modal fade" id="route-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Route Details</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <div class="col-md-12">
              <div id="route-message"></div>
              <?php echo form_open('welcome', array('id'=>'route')); ?>

                <div class="form-group">
                  <input type="text" name="route_id" class="form-control hidden"/>
                </div>

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
        <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Route()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Route Data</h3>
    <div class="box-tools pull-right">
        <a class="btn btn-link add-link" href="<?php echo base_url('routes/add') ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New Route</a>
    </div>
  </div>
  <div class="box-body">
    <div id="route-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="route_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>ROUTE NAME</th>
                <th>ROUTE DESCRIPTION</th>
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

<script type="text/javascript">
  $(".select2").select2();
  $('.select2-selection__rendered').removeAttr('title');
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

  var filteredCityFrom = [];
  var filteredLocationFrom = [];
  var filteredCityTo = [];
  var filteredLocationTo = [];

  $( document ).ready(function() {
    filterCityTo();
    filterCityFrom();
    filterLocationTo();
    filterLocationFrom();
    filterLocationTo();
  });

  function filterCityFrom() {
    filteredCityFrom=[];
    for(var a = 0 ; a < city.length ; a++)
    {
      if($('#region_from').val() == "all")
      {
        filteredCityFrom.push([
          city[a][0],
          city[a][1],
        ]);
      }
      else if(city[a][2] == $('#region_from').val())
      {
        filteredCityFrom.push([
          city[a][0],
          city[a][1],
        ]);
      }
      else
      {
      }
    }
    $('#city_from')
      .find('option')
      .remove()
      .end()
    ;
    if(filteredCityFrom.length<1)
    {
      $('.update').prop('disabled', true);
    }
    else
    {
      $.each(filteredCityFrom, function(key, value) {   
        $('#city_from')
          .append($('<option>', { value : value[0] })
          .text(value[1])); 
      });
    }
  }

  function filterLocationFrom() {
    filteredLocationFrom=[];
    for(var a = 0 ; a < locations.length ; a++)
    {
      if($('#city_from').val() == "all")
      {
        filteredLocationFrom.push([
          locations[a][0],
          locations[a][1],
        ]);
      }
      else if(locations[a][2] == $('#city_from').val())
      {
        filteredLocationFrom.push([
          locations[a][0],
          locations[a][1],
        ]);
      }
      else
      {
      }
    }
    $('#location_from')
      .find('option')
      .remove()
      .end()
    ;
    locationToTrim();
    if(filteredLocationFrom.length<1)
    {
      $('.update').prop('disabled', true);
    }
    else
    {
      $.each(filteredLocationFrom, function(key, value) {   
        $('#location_from')
          .append($('<option>', { value : value[0] })
          .text(value[1])); 
      });
    }
  }

  function filterCityTo() {
    filteredCityTo=[];
    for(var a = 0 ; a < city.length ; a++)
    {
      if($('#region_to').val() == "all")
      {
        filteredCityTo.push([
          city[a][0],
          city[a][1],
        ]);
      }
      else if(city[a][2] == $('#region_to').val())
      {
        filteredCityTo.push([
          city[a][0],
          city[a][1],
        ]);
      }
      else
      {
      }
    }
    $('#city_to')
      .find('option')
      .remove()
      .end()
    ;
    if(filteredCityTo.length<1)
    {
      $('.update')
        .prop('disabled', true)
      ;
    }
    else
    {
      $.each(filteredCityTo, function(key, value) {   
        $('#city_to')
          .append($('<option>', { value : value[0] })
          .text(value[1])); 
      });
    }
  }

  function filterLocationTo() {
    filteredLocationTo=[];
    for(var a = 0 ; a < locations.length ; a++)
    {
      if($('#city_to').val() == "all")
      {
        filteredLocationTo.push([
          locations[a][0],
          locations[a][1],
        ]);
      }
      else if(locations[a][2] == $('#city_to').val())
      {
        filteredLocationTo.push([
          locations[a][0],
          locations[a][1],
        ]);
      }
      else
      {
      }
    }
    $('#location_to')
      .find('option')
      .remove()
      .end()
    ;
    locationFromTrim();
    if(filteredLocationTo.length<1)
    {
      $('.update')
        .prop('disabled', true)
      ;
    }
    else
    {
      $.each(filteredLocationTo, function(key, value) {   
        $('#location_to')
          .append($('<option>', { value : value[0] })
          .text(value[1])); 
      });
    }
  }

  $( "#region_to" ).change(function() {
    $('.update').prop('disabled', false);
    filterCityTo();
    filterLocationTo();

    var tempFrom = $( "#location_from" ).val();
    filterLocationFrom();
    $("#location_from").val(tempFrom);
  });

  $( "#city_to" ).change(function() {
    $('.update').prop('disabled', false);
    filterLocationTo();

    var tempFrom = $( "#location_from" ).val();
    filterLocationFrom();
    $("#location_from").val(tempFrom);
  });

  $( "#location_to" ).change(function() {
    $('.update').prop('disabled', false);
    var tempTo = $( "#location_to" ).val();
    filterLocationTo();
    $("#location_to").val(tempTo);

    var tempFrom = $( "#location_from" ).val();
    filterLocationFrom();
    $("#location_from").val(tempFrom);
  });

  $( "#region_from" ).change(function() {
    $('.update').prop('disabled', false);
    filterCityFrom();
    filterLocationFrom();

    var tempTo = $( "#location_to" ).val();
    filterLocationTo();
    $("#location_to").val(tempTo);
  });

  $( "#city_from" ).change(function() {
    $('.update').prop('disabled', false);
    filterLocationFrom();

    var tempTo = $( "#location_to" ).val();
    filterLocationTo();
    $("#location_to").val(tempTo);
  });

  $( "#location_from" ).change(function() {
    $('.update').prop('disabled', false);
    var tempFrom = $( "#location_from" ).val();
    filterLocationFrom();
    $("#location_from").val(tempFrom);

    var tempTo = $( "#location_to" ).val();
    filterLocationTo();
    $("#location_to").val(tempTo);
  });

  function locationToTrim() {
    for(var a = 0 ; a < filteredLocationFrom.length ; a++)
    {
      if($("#location_to").val() == filteredLocationFrom[a][0])
      {
        filteredLocationFrom.splice(a, 1);
      }
    }
  }

  function locationFromTrim() {
    for(var a = 0 ; a < filteredLocationTo.length ; a++)
    {
      if($("#location_from").val() == filteredLocationTo[a][0])
      {
        filteredLocationTo.splice(a, 1);
      }
    }
  }

  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////
  // O T H E R
  function closebox() {
    $('#form-box').addClass('hidden');
  }
  // R E A D
  $("#route_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('routes/showRoute') ?>",
      "type":"POST"
    }
  })
  // U P D A T E
  function edit_route(route_id) {
    $('#route-box').modal('show');
    $.ajax({
      url: "<?php echo site_url('routes/editRoute') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'route_id='+route_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="route_id"]').val(data.route_id);
        $('input[name="route_name"]').val(data.route_name);
        $('textarea[name="route_description"]').val(data.route_description);

        $('select[id="region_from"]').val(data[0]['region_from']).trigger('change');
        $('select[id="region_to"]').val(data[0]['region_to']).trigger('change');

        $('select[name="city_to"]').val(data[0]['city_to']).trigger('change');
        $('select[name="city_from"]').val(data[0]['city_from']).trigger('change');

        $('select[name="location_to"]').val(data.location_to).trigger('change');
        $('select[name="location_from"]').val(data.location_from).trigger('change');
      }
    })
  }
  function update_Route() {
    $.ajax({
      url: "<?php echo site_url('routes/updateRoute') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#route').serialize(),
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
          $('#route-box').modal('hide'); 
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E

function delete_route(route_id) {
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
        url: "<?php echo site_url('routes/delete_Route') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'route_id='+route_id,
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
            )
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
          
        })
      }
    })
  }    

  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////

  // END OF REGION ADD JAVASCRIPT
</script>