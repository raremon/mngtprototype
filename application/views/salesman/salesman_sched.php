<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title"></h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
    <?php echo form_open('', array('id'=>'sched')); ?>
    <div id="sched_wizard">
        <h3 class="buttons_fix">Select Region<i class="fa fa-angle-double-right" style="float:right;font-size:20px;padding-top:5px;"></i></h3>
        <section>
          <div class="form-group">
          <label>Region</label>
            <select id="region_id" class="form-control select2" style="width:100%;">
              <option value="all">All Regions</option>
              <?php 
                foreach($region as $row)
                {
              ?>
                <option value=<?php echo $row[0];?>><?php echo $row[1]; ?>
                </option>
              <?php 
                }
              ?>
            </select>
            <a class="btn btn-link pull-right" href="<?php echo site_url('regions/add') ?>">Add Region</a>
          </div>
        </section>

        <h3>Select City<i class="fa fa-angle-double-right" style="float:right;font-size:20px;padding-top:5px;"></i></h3>
        <section>
          <div class="form-group">
            <label>Selected Region</label>  
            <input name="" type="text" class="form-control" id="selected_region" readonly></br>
            <label>City/Province</label>
            <select id="city_id" class="form-control select2" style="width:100%;">
            </select>
            <a class="btn btn-link pull-right" href="<?php echo site_url('cities/add') ?>">Add City</a>
          </div> 
        </section>

        <h3>Select Location<i class="fa fa-angle-double-right" style="float:right;font-size:20px;padding-top:5px;"></i></h3>
        <section>
          <div class="form-group">
            <label>Selected Region</label>  
            <input name="" type="text" class="form-control" id="selected_region1" readonly></br>
            <label>Selected City/Province</label>  
            <input name="" type="text" class="form-control" id="selected_city" readonly></br>
            <label>Location:</label>
            <select id="location_id" class="form-control select2" style="width:100%;">
            </select>
          </div>
          <a class="btn btn-link pull-right" href="<?php echo site_url('locations/add') ?>">Add Location</a>
        </section>

        <h3>Select Route<i class="fa fa-angle-double-right" style="float:right;font-size:20px;padding-top:5px;"></i></h3>
        <section>
          <div class="form-group">
            <label>Selected Region</label>  
            <input name="" type="text" class="form-control" id="selected_region2" readonly></br>
            <label>Selected City/Province</label>  
            <input name="" type="text" class="form-control" id="selected_city1" readonly></br>
            <label>Selected Location</label>  
            <input name="" type="text" class="form-control" id="selected_location" readonly></br>
            <label>Route</label>
            <select id="route_id" name="route_id" class="form-control select2" style="width:100%;">
            </select>
            <input type="text" name="route_selected" class="hidden" id="route_selected">
            <a class="btn btn-link pull-right" href="<?php echo site_url('routes/add') ?>">Add Routes</a>
          </div>
        </section>

        <h3>Select Schedule<i class="fa fa-angle-double-right" style="float:right;font-size:20px;padding-top:5px;"></i></h3>
        <section>
          <div class="container-fluid">

            <div class="col-md-12">
               <div class="form-group">
               <label>Select Duration:</label>
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-calendar"></i>
                 </div>
                 <input name="date_reg" type="text" class="form-control pull-left" id="reservation">
                 <input name="date_start" id="date_start" type="text" class="hidden">
                 <input name="date_end" id="date_end" type="text" class="hidden">
               </div>
               </div>     
            </div>

            <div class="col-md-12">
               <label>Select Timeslot:</label>
               <input name="tslots_selected" id="tslots_selected" type="text" class="hidden">
               <div class="form-group text-center">
                </br>
                <label>
                  <input id="all-timeslot-box" type="checkbox" class="flat">
                  All Timeslots
                </label>
               </div>  
            </div>    
            <div class="col-md-4">
                  <table id="morning-table" class="table table-hover" width="100%">
                    <thead>
                      <tr>
                        <th><input id="all-morning-box" type="checkbox" class="flat-grey">Morning</th>
                        <th>Time</th>
                        <th>Availability</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
            </div>  
            <div class="col-md-4">
                  <table id="afternoon-table" class="table table-hover" width="100%">
                    <thead>
                      <tr>
                        <th><input id="all-afternoon-box" type="checkbox" class="flat-grey">Afternoon</th>
                        <th>Time</th>
                        <th>Availability</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
            </div>  
            <div class="col-md-4">
                  <table id="evening-table" class="table table-hover" width="100%">
                    <thead>
                      <tr>
                        <th><input id="all-evening-box" type="checkbox" class="flat-grey">Evening</th>
                        <th>Time</th>
                        <th>Availability</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
            </div>  
        </section>

        <h3>Ad Order<i class="fa fa-check" style="float:right;font-size:20px;padding-top:5px;"></i></h3>
        <section>
          <div class="container-fluid">

            <div class="col-md-12">
              <div id="sched-message"></div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label>Agency/Advertiser:</label>
                <select id="advertiser_id" name="advertiser_id" class="form-control select2" style="width:100%;">
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
                <a class="btn btn-link pull-right" href="<?php echo site_url('advertisers/add') ?>">New Advertiser</a>
              </div>  
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Ad Duration:</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="ad-duration" name="ad_duration">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                </div>
                <span class="help-block"></span>
              </div>
            </div>  

            <div class="col-md-6">
              <div class="form-group">
                <label>Frequency:</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="ad-frequency" name="times_repeat">
                  <div class="input-group-addon">
                    <i class="fa fa-refresh"></i>
                  </div>
                </div>
                <span class="help-block">*Refers on how many times the ad will be played per timeslot.</span>
              </div> 
            </div>  

            <div class="col-md-12">
              <div class="form-group">
                <label>Sales Agent:</label>
                <select id="sales_id" name="sales_id" class="form-control select2" style="width:100%;">
                  <?php 
                    foreach($sales as $row)
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

            <div class="col-md-12">
              <div class="form-group">
                <label>Select Screen Size:</label>
                <input type="text" class="form-control" id="screen-size" readonly>
                <input type="text" class="hidden" id="display_type" name="display_type">
              </div>  
            </div>

            <div class="col-md-6">
                <a id="fullscreen-link" href="#/" onclick="fullscreen();">
                    <div class="form-group fullscreen-div text-center">
                    <label>FULLSCREEN</label>
                    </div>            
                </a>
            </div>  

            <div class="col-md-4">
                <a id="split-main-link" href="#/" onclick="splitMain();">
                    <div class="form-group split-main-div text-center">
                    <label>SPLIT-MAIN</label>
                    </div>   
                </a>
            </div> 

            <div class="col-md-2">
                <a id="split-top-link" href="#/" onclick="splitTop();">
                    <div class="form-group split-top-div text-center">
                    <label>SPLIT-TOP RIGHT</label>
                    </div>            
                </a>
            </div> 

            <div class="col-md-2">
                <a id="split-bottom-link" href="#/" onclick="splitBottom();">
                    <div class="form-group split-bottom-div text-center">
                    <label>SPLIT-BOTTOM</br>RIGHT</label>
                    </div>
                </a>
            </div> 

         </div>
        </section>
      
    </div>
    <?php echo form_close(); ?>
  </div>
  <div class="box-footer">
  </div>
</div>
<script type="text/javascript">
    // PAUL
  $("#sched_wizard").steps({
      headerTag: "h3",
      bodyTag: "section",
      transitionEffect: "fade",
      autoFocus: true,
      onStepChanged: function(event, currentIndex, priorIndex)
      {
        var input_region = document.getElementById('selected_region');
        input_region.value = $( "#region_id option:selected" ).text();
          
        var input_region1 = document.getElementById('selected_region1');
        input_region1.value = $( "#region_id option:selected" ).text();
        var input_city = document.getElementById('selected_city');
        input_city.value = $( "#city_id option:selected" ).text();
          
        var input_region2 = document.getElementById('selected_region2');
        input_region2.value = $( "#region_id option:selected" ).text();
        var input_city1 = document.getElementById('selected_city1');
        input_city1.value = $( "#city_id option:selected" ).text();
        var input_location = document.getElementById('selected_location');
        input_location.value = $( "#location_id option:selected" ).text();
      },
      onFinished: function (event, currentIndex)
      {
        $.ajax({
          url: "<?php echo site_url('salesman/placeOrder') ?>",
          type: 'POST',
          dataType: 'json',
          data: $('#sched').serialize(),
          encode:true,
          success:function(data) {
            if(!data.success){
              if(data.errors){
                $(window).scrollTop(0);
                $("#sched-message").fadeIn("slow");
                $('#sched-message').html(data.errors).addClass('alert alert-danger');
                setTimeout(function() {
                    $('#sched-message').fadeOut('slow');
                }, 3000);
              }
            }else {
              $('#message-text').html(data.message);
              $('#successModal').modal('show');
            }
          }
        })
      }
  });
  $(".select2").select2();
  $('.select2-selection__rendered').removeAttr('title');
  $('input[type="checkbox"].flat, input[type="radio"].flat').iCheck({
    checkboxClass: 'icheckbox_flat',
    radioClass: 'iradio_flat'
  });
  $('input[type="checkbox"].flat-grey, input[type="radio"].flat-grey').iCheck({
    checkboxClass: 'icheckbox_flat-grey',
    radioClass: 'iradio_flat-grey'
  });
  
  $('#all-timeslot-box').on('ifChecked', function (event){
      $('.morning-box').iCheck('check');   
      $('.afternoon-box').iCheck('check');
      $('.evening-box').iCheck('check');
      selectTs();
  });
  $('#all-timeslot-box').on('ifUnchecked', function (event) {
      $('input').iCheck('uncheck');  
      selectTs(); 
  });
  
  $('#all-morning-box').on('ifChecked', function (event){
      $('.morning-box').iCheck('check');   
      $('.afternoon-box').iCheck('uncheck');
      $('.evening-box').iCheck('uncheck');
      selectTs(); 
  });
  $('#all-morning-box').on('ifUnchecked', function (event) {
      $('input').iCheck('uncheck');
      selectTs();
  });
  
  $('#all-afternoon-box').on('ifChecked', function (event){  
      $('.morning-box').iCheck('uncheck');   
      $('.afternoon-box').iCheck('check');
      $('.evening-box').iCheck('uncheck');
      selectTs();
  });
  $('#all-afternoon-box').on('ifUnchecked', function (event) { 
      $('input').iCheck('uncheck');
      selectTs();
  });
  
  $('#all-evening-box').on('ifChecked', function (event){
      $('.morning-box').iCheck('uncheck');   
      $('.afternoon-box').iCheck('uncheck');
      $('.evening-box').iCheck('check');
      selectTs();
  });
  $('#all-evening-box').on('ifUnchecked', function (event) {
      $('input').iCheck('uncheck');
      selectTs();
  });
    
  $('input[id$="ad-duration"]').inputmask("9999", {
    placeholder: "__________", 
    insertMode: false, 
    showMaskOnHover: false,
    });
  $('input[id$="ad-frequency"]').inputmask("99", {
    placeholder: "__________", 
    insertMode: false, 
    showMaskOnHover: false,
    });
    
    function fullscreen() {
        $('#screen-size').attr('value', 'Fullscreen');
        $('#display_type').attr('value', 1);
    }
    function splitMain() {
        $('#screen-size').attr('value', 'Split - Main');
        $('#display_type').attr('value', 2);
    }
    function splitTop() {
        $('#screen-size').attr('value', 'Split - Top Right');
        $('#display_type').attr('value', 4);
    }
    function splitBottom() {
        $('#screen-size').attr('value', 'Split - Bottom Right');
        $('#display_type').attr('value', 5);
    }
  // MINE
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

  var loc = [];
  <?php 
    foreach($location as $row)
    {
  ?>
    loc.push([
      <?php echo $row[0]; ?>,
      "<?php echo $row[1]; ?>",
      <?php echo $row[2]; ?>,
    ]);
  <?php 
    }
  ?>

  var route = [];
  <?php 
    foreach($route as $row)
    {
  ?>
    route.push([
      <?php echo $row[0]; ?>,
      "<?php echo $row[1]; ?>",
      <?php echo $row[2]; ?>,
      <?php echo $row[3]; ?>,
    ]);
  <?php 
    }
  ?>

  // TIMESLOT
  var timeslot = [];
  <?php 
    foreach($timeslot as $row)
    {
  ?>
    timeslot.push([
      <?php echo $row[0]; ?>,
      "<?php echo $row[1]; ?>",
      "<?php echo $row[2]; ?>",
      "<?php echo $row[3]; ?>",
    ]);
  <?php 
    }
  ?>
  // console.log(timeslot);

  $( document ).ready(function() {
    place_init();
    cityfilter();
    timefilter();
    getDates();
    // if($('#vehicle > option').length == 0)
    // {
    //   $("#media-message").fadeIn("slow");
    //   $('#media-message').html("NOT ENOUGH RESOURCES TO SAVE").addClass('alert alert-danger');
    //   $('.save').prop('disabled', true);
    // }
  });

  // ROUTE ASSIGNMENT
  function place_init() {
    $.each(city, function(key, value) {   
      $('#city_id')
        .append($('<option>', { value : value[0] })
        .text(value[1])); 
    });
    $.each(loc, function(key, value) {   
      $('#location_id')
        .append($('<option>', { value : value[0] })
        .text(value[1])); 
    });
    $.each(route, function(key, value) {   
      $('#route_id')
        .append($('<option>', { value : value[0] })
        .text(value[1])); 
    });
  }

  var cityfiltered = [];
  function cityfilter() {
    cityfiltered=[];
    if($('#region_id').val() == 'all')
    {
      cityfiltered.push([
        'all',
        'All Cities',
      ]);
    }
    for(var a = 0 ; a < city.length ; a++)
    {
      if($('#region_id').val() == 'all')
      {
        cityfiltered.push([
          city[a][0],
          city[a][1],
        ]);
      }
      else if(city[a][2] == $('#region_id').val())
      {
        cityfiltered.push([
          city[a][0],
          city[a][1],
        ]);
      }
    }
    $('#city_id')
      .find('option')
      .remove()
      .end()
    ;
    if(cityfiltered.length<1)
    {
      $('#city_id')
        .append('<option value=0>NO CITY IN THAT REGION</option>')
        .val(0)
      ;
      //disable save
    }
    else
    {
      // $('.save').prop('disabled', false);
      $.each(cityfiltered, function(key, value) {   
        $('#city_id')
          .append($('<option>', { value : value[0] })
          .text(value[1])); 
      });
      $('#city_id').trigger('change');
    }
  }
  $("#region_id").change(function() {
    cityfilter();
    // alert();
  });

  var locationfiltered = [];
  function locationfilter() {
    locationfiltered=[];
    if($('#city_id').val() == 'all')
    {
      locationfiltered.push([
        'all',
        'All Location',
      ]);
    }
    for(var a = 0 ; a < loc.length ; a++)
    {
      if($('#city_id').val() == 'all')
      {
        locationfiltered.push([
          loc[a][0],
          loc[a][1],
        ]);
      }
      else if(loc[a][2] == $('#city_id').val())
      {
        locationfiltered.push([
          loc[a][0],
          loc[a][1],
        ]);
      }
    }
    $('#location_id')
      .find('option')
      .remove()
      .end()
    ;
    if(locationfiltered.length<1)
    {
      $('#location_id')
        .append('<option value=0>NO LOCATION IN THAT CITY</option>')
        .val(0)
      ;
      //disable save
    }
    else
    {
      // $('.save').prop('disabled', false);
      $.each(locationfiltered, function(key, value) {   
        $('#location_id')
          .append($('<option>', { value : value[0] })
          .text(value[1])); 
      });
      $('#location_id').trigger('change');
    }
  }
  $("#city_id").change(function() {
    locationfilter();
    // alert();
  });

  var routefiltered = [];
  function routefilter() {
    routefiltered=[];
    if($('#location_id').val() == 'all')
    {
      routefiltered.push([
        'all',
        'All Routes',
      ]);
    }
    for(var a = 0 ; a < route.length ; a++)
    {
      if($('#location_id').val() == 'all')
      {
        routefiltered.push([
          route[a][0],
          route[a][1],
        ]);
      }
      else if(route[a][2] == $('#location_id').val() || route[a][3] == $('#location_id').val())
      {
        routefiltered.push([
          route[a][0],
          route[a][1],
        ]);
      }
    }
    $('#route_id')
      .find('option')
      .remove()
      .end()
    ;
    if(routefiltered.length<1)
    {
      $('#route_id')
        .append('<option value=0>NO ROUTE IN THAT LOCATION</option>')
        .val(0)
      ;
      //disable save
    }
    else
    {
      // $('.save').prop('disabled', false);
      $.each(routefiltered, function(key, value) {   
        $('#route_id')
          .append($('<option>', { value : value[0] })
          .text(value[1])); 
      });
      $('#route_id').trigger('change');
    }
  }
  $("#location_id").change(function() {
    routefilter();
    // alert();
  });

  $("#route_id").change(function() {
    if($('#route_id').val() == 'all')
    {
      var routeValues = [];
      for(var a = 0; a < routefiltered.length; a++)
      {
        if(routefiltered[a][0] != 'all')
        {
          routeValues.push(routefiltered[a][0]);
        }
      }
      $('#route_selected').val(JSON.stringify(routeValues));
    }
    else
    {
      $('#route_selected').val($('#route_id').val());
    }
  });
  //////////////////////

  // DATE ORDER
  function getDates() {
    // alert($('#reservation').val().split(' - '));
    var dates = [];
    dates = $('#reservation').val().split(' - ');
    if(dates[0] == dates[1])
    {
      $('#date_start').val(dates[0]);
      $('#date_end').val("");
    }
    else
    {
      $('#date_start').val(dates[0]);
      $('#date_end').val(dates[1]);
    }
  }
  $("#reservation").change(function() {
    getDates();
  });
  //////////////////////

  // TIMESLOT
  var amcheck = '';
  var pmcheck = '';
  var evecheck = '';
  function  timefilter() {
    for(var a = 0; a < timeslot.length; a++)
    {
      if(timeslot[a][2] == "am")
      {
        amcheck = amcheck + '<tr><td><input name="tslot_id" value="'+timeslot[a][0]+'" type="checkbox" class="flat morning-box" onclick="selectTs()"></td><td>'+timeslot[a][1]+'</td><td>'+timeslot[a][3]+'</td></tr>';
      }
      else if(timeslot[a][2] == "pm")
      {
        pmcheck = pmcheck + '<tr><td><input name="tslot_id" value="'+timeslot[a][0]+'" type="checkbox" class="flat afternoon-box" onclick="selectTs()"></td><td>'+timeslot[a][1]+'</td><td>'+timeslot[a][3]+'</td></tr>';
      }
      else if(timeslot[a][2] == "eve")
      {
        evecheck = evecheck + '<tr><td><input name="tslot_id" value="'+timeslot[a][0]+'" type="checkbox" class="flat evening-box" onclick="selectTs()"></td><td>'+timeslot[a][1]+'</td><td>'+timeslot[a][3]+'</td></tr>';
      }
    }
    $('#morning-table tbody').html(amcheck);
    $('#afternoon-table tbody').html(pmcheck);
    $('#evening-table tbody').html(evecheck);
  }
  var tslotsel = [];
  function selectTs() {
    tslotsel = [];
    $("input:checkbox[name=tslot_id]:checked").each(function(){
      tslotsel.push($(this).val());
    });
    if(tslotsel.length<1)
    {
      $('#tslots_selected').val('');
    }
    else
    {
      $('#tslots_selected').val(JSON.stringify(tslotsel));
    }
  }
</script>