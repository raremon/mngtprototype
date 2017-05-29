<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Route Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="route-message"></div>
          <?php echo form_open('welcome', array('id'=>'route')); ?>


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
            <button type="button" class="btn btn-primary save" onclick="save_Route()">Save</button>
          <?php echo form_close(); ?>
        </div>
      </div> 
  </div>
  <div class="box-footer">
  </div>
</div>
<script type="text/javascript">
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
      $('.save').prop('disabled', true);
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
      $('.save').prop('disabled', true);
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
      $('.save')
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
      $('.save')
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
    $('.save').prop('disabled', false);
    filterCityTo();
    filterLocationTo();

    var tempFrom = $( "#location_from" ).val();
    filterLocationFrom();
    $("#location_from").val(tempFrom);
  });

  $( "#city_to" ).change(function() {
    $('.save').prop('disabled', false);
    filterLocationTo();

    var tempFrom = $( "#location_from" ).val();
    filterLocationFrom();
    $("#location_from").val(tempFrom);
  });

  $( "#location_to" ).change(function() {
    $('.save').prop('disabled', false);
    var tempTo = $( "#location_to" ).val();
    filterLocationTo();
    $("#location_to").val(tempTo);

    var tempFrom = $( "#location_from" ).val();
    filterLocationFrom();
    $("#location_from").val(tempFrom);
  });

  $( "#region_from" ).change(function() {
    $('.save').prop('disabled', false);
    filterCityFrom();
    filterLocationFrom();

    var tempTo = $( "#location_to" ).val();
    filterLocationTo();
    $("#location_to").val(tempTo);
  });

  $( "#city_from" ).change(function() {
    $('.save').prop('disabled', false);
    filterLocationFrom();

    var tempTo = $( "#location_to" ).val();
    filterLocationTo();
    $("#location_to").val(tempTo);
  });

  $( "#location_from" ).change(function() {
    $('.save').prop('disabled', false);
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
  // C R E A T E
  function save_Route() {
    if($("#location_to").val() == 0 || $("#location_from").val() == 0)
    {
      $(window).scrollTop(0);
      $("#route-message").fadeIn("slow");
      $('#route-message').html("Please select a valid city").addClass('alert alert-danger');
      setTimeout(function() {
          $('#route-message').fadeOut('slow');
      }, 3000);
    }
    else
    {
      $.ajax({
        url: "<?php echo site_url('routes/saveRoute') ?>",
        type: 'POST',
        dataType: 'json',
        data: $('#route').serialize(),
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#route-message").fadeIn("slow");
              $('#route-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#route-message').fadeOut('slow');
              }, 3000);
            }
          }else {
            $('#message-text').html(data.message);
            $('#successModal').modal('show');
          }
        }
      })
    }
  }
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////

  // END OF REGION ADD JAVASCRIPT
</script>