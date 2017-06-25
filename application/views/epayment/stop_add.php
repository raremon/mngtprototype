<div class="box box-success">
<?php foreach ($locations as $location){ ?>
<?php echo $location->location_name; ?>
<?php } ?>
  <div class="box-header with-border">
    <h3 class="box-title">Stop Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="route-message"></div>
          <form id='stop' method="POST">
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
            <button type="button" class="btn btn-primary save" onclick="save_Stop()">Save</button>
          </form>
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
  
  function save_Stop() {
    
      $.ajax({
        url: "<?php echo site_url('stops/saveStop') ?>",
        type: 'POST',
        dataType: 'json',
        data: $('#stop').serialize(),
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
      });
    
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