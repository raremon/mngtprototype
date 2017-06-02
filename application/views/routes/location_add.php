<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJAq_K8XorLcD2nKKsrmB7BserF3Wh3Ss&libraries=places" type="text/javascript"></script>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Location Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="location-message"></div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Search Map</label>
                <input type="text" id="mapsearch" name="mapsearch" class="form-control"/>
              </div>
            </div>
          </div>
          <div id="map-canvas"> </div>
          <?php echo form_open('welcome', array('id'=>'location')); ?>
          <div class="form-group">
            <label>Select a Region</label>
            <select data-placeholder="No regions on the data" id="region_name" class="select2 form-control">
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
            <select data-placeholder="No cities in this region" name="city_id" id="city" class="select2 form-control">
            </select>
            <a class="btn btn-link pull-right" href="<?php echo site_url('cities/add') ?>">Add City</a>
          </div>
          <div class="form-group hidden">
            <input type="text" name="latitude" id="lat" value="14.58738368298855" class="form-control"/>
          </div>
          <div class="form-group hidden">
            <input type="text" name="longitude" id="lng" value="120.98392539999998" class="form-control"/>
          </div>
          <div class="form-group">
            <label>Location Name</label>
            <input type="text" name="location_name" class="form-control" placeholder="Enter Location Name"/>
          </div>
          <button type="button" class="btn btn-primary save" onclick="save_Location()">Save</button>
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
  var city = [];
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

  var filtered = [];

  $( document ).ready(function() {
    filter();

    if($('select[name="city_id"] > option').length == 0 || $('select[name="city_id"] > option').length == 0 || $('select[id="region_name"] > option').length == 0)
    {
      $("#location-message").fadeIn("slow");
      $('#location-message').html("NOT ENOUGH RESOURCES TO SAVE").addClass('alert alert-danger');
      $('.save').prop('disabled', true);
    }
  });

  function filter() {
    filtered=[];
    for(var a = 0 ; a < city.length ; a++)
    {
      if($('#region_name').val() == "all")
      {
        filtered.push([
          city[a][0],
          city[a][1],
        ]);
      }
      else if(city[a][2] == $('#region_name').val())
      {
        filtered.push([
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
    if(filtered.length<1)
    {
      $('.save')
        .prop('disabled', true)
      ;
    }
    else
    {
      $.each(filtered, function(key, value) {   
        $('#city')
          .append($('<option>', { value : value[0] })
          .text(value[1])); 
      });
      $('.save')
        .prop('disabled', false)
      ;
    }
  }

  $( "#region_name" ).change(function() {
    filter();
  });

  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////
  // C R E A T E
  function save_Location() {
    $.ajax({
      url: "<?php echo site_url('locations/save') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#location').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $(window).scrollTop(0);
            $("#location-message").fadeIn("slow");
            $('#location-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#location-message').fadeOut('slow');
            }, 3000);
          }
        }else {
          $('#message-text').html(data.message);
          $('#successModal').modal('show');
        }
      }
    })
  }
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////

  ////////////////////////////////////////////////////////////////
  //        G  O  O  G  L  E    M  A  P  S    A  P  I           //
  ////////////////////////////////////////////////////////////////
  // Zoom Level
  var szoom = 17;
  // Map
  var map = new google.maps.Map( document.getElementById('map-canvas'),{
    center:{
      lat: 14.58738368298855,
      lng: 120.98392539999998
    },
    zoom:szoom
  });
  // Marker
  var marker = new google.maps.Marker({
    position:{
      lat: 14.58738368298855,
      lng: 120.98392539999998
    },
    map:map,
    draggable: true
  });
  // Marker Drag
  google.maps.event.addListener(marker,'dragend',function(){
    setMarker();
  });
  // Search function
  var searchBox = new google.maps.places.SearchBox(document.getElementById('mapsearch'));
  google.maps.event.addListener( searchBox, 'places_changed',function(){
    // console.log(searchBox.getPlaces());
    var places = searchBox.getPlaces();
    //bounds
    var bounds = new google.maps.LatLngBounds();
    var i,place;
    for( i=0; place = places[i]; i++ ){
      bounds.extend(place.geometry.location);
      marker.setPosition(place.geometry.location);
    }
    setMarker();
    map.fitBounds(bounds);
    map.setZoom(szoom);
  });
  // Set Marker function
  function setMarker()
  {
    var xlatitude = marker.getPosition().lat();
    var ylongitude = marker.getPosition().lng();
    $('#lat').val(xlatitude);
    $('#lng').val(ylongitude);
  }
  ////////////////////////////////////////////////////////////////
  //E  N  D    O  F    G  O  O  G  L  E    M  A  P  S    A  P  I//
  ////////////////////////////////////////////////////////////////
  
  // END OF REGION ADD JAVASCRIPT
</script>