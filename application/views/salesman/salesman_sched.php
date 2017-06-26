<div class="modal fade" id="add-route-box" role="dialog">
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
<div class="modal fade" id="advertiser-add" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open_multipart('advertisers/saveAdvertiser', array('id'=>'advertiser-add-form')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertiser Details</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="container-fluid">
            <div class="col-md-12">
              <div id="advertiser-message-add"></div>
                <div class="form-group">
                  <label>Agency</label>
                  <select name="agency_id-add" class="form-control select2">
                    <?php 
                      foreach($agency as $row)
                      {
                    ?>
                      <option value= <?php echo $row[0];?> >
                        <?php echo $row[1]; ?>
                      </option>
                    <?php 
                      }
                    ?>
                  </select>
                  <a class="btn btn-link pull-right" href="<?php echo site_url('agencies/browse') ?>">Browse Agencies</a>
                </div>
                <div class="form-group">
                  <label>Advertiser Name</label>
                  <input type="text" name="advertiser_name-add" class="form-control" placeholder="Enter Name"/>
                </div>
                <div class="form-group">
                  <label>Company Address</label>
                  <input type="text" name="advertiser_address-add" class="form-control" placeholder="Enter Address"/>
                </div>
                <div class="form-group">
                  <label>Contact Information</label>
                  <input type="text" name="advertiser_contact-add" class="form-control" placeholder="Enter Contact Information"/>
                </div>
                <div class="form-group">
                  <label>Email Address</label>
                  <input type="text" name="advertiser_email-add" class="form-control" placeholder="Enter Email Address"/>
                </div>
                <div class="form-group">
                  <label>Company Website</label>
                  <input type="text" name="advertiser_website-add" class="form-control" placeholder="Enter Company Website"/>
                </div>
                <div class="form-group">
                  <label>Company Logo</label>
                  <input name="image_file" id="image_file" type="file" class="file">
                  <div class="input-group col-xs-12">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-camera"></i></span>
                    <input type="text" class="form-control input-md" disabled placeholder="Upload Image">
                    <input name="advertiser_image-add" type="text" class="form-control input-md hidden">
                    <span class="input-group-btn">
                      <button class="browse btn btn-success input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                    </span>
                  </div>
                  <img id="loading_img" src="<?php echo base_url('assets/public/loading.gif') ?>" class="hidden">
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea name="advertiser_description-add" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
                </div>
            </div>
          </div> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary save">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>

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
          </div> 
        </section>

        <!-- DITO MAG AADD NUNG ROUTE -->
        <h3>Select Route<i class="fa fa-angle-double-right" style="float:right;font-size:20px;padding-top:5px;"></i></h3>
        <section>
          <div class="form-group">
            <label>Selected Region</label>  
            <input name="" type="text" class="form-control" id="selected_region1" readonly></br>
            <label>Selected City/Province</label>  
            <input name="" type="text" class="form-control" id="selected_city" readonly></br>
            <label>Route</label>
            <select id="route_id" name="route_id" class="form-control select2" style="width:100%;">
            </select>
            <input type="text" name="route_selected" class="hidden" id="route_selected">
            <a class="btn btn-link pull-right" href="#/" onclick="addRoute()">Add Routes</a>
          </div>
        </section>

        <!-- DITO ILALAGAY YUNG CHECKBOXES -->
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
                    <th><input id="all-morning-box" type="checkbox" class="flat-grey">AM</th>
                    <th>Time</th>
                    <th>Availability</th>
                    <th>Times Repeat</th>
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
                    <th><input id="all-afternoon-box" type="checkbox" class="flat-grey">PM</th>
                    <th>Time</th>
                    <th>Availability</th>
                    <th>Times Repeat</th>
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
                    <th><input id="all-evening-box" type="checkbox" class="flat-grey">EVE</th>
                    <th>Time</th>
                    <th>Availability</th>
                    <th>Times Repeat</th>
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
                <a class="btn btn-link pull-right" href="javascript:void(0);" data-toggle="modal" data-target="#advertiser-add">New Advertiser</a>
              </div>  
            </div>

            <div class="col-md-12">
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
  function addRoute() {
      $("#add-route-box").modal('show');
  }
  $(document).on('click', '.browse', function(){
    var file = $(this).parent().parent().parent().find('.file');
    file.trigger('click');
  });
  $(document).on('change', '.file', function(){
    $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
  });
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
      var selected = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18];
      for(var a = 0; a < selected.length; a++)
      {
        selectTs(selected[a]);
      }
  });
  $('#all-timeslot-box').on('ifUnchecked', function (event) {
      $('input').iCheck('uncheck');  
      var selected = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18];
      for(var a = 0; a < selected.length; a++)
      {
        selectTs(selected[a]);
      } 
  });
  
  $('#all-morning-box').on('ifChecked', function (event){
      $('.morning-box').iCheck('check');   
      $('.afternoon-box').iCheck('uncheck');
      $('.evening-box').iCheck('uncheck');
      var selected = [1, 2, 3, 4, 5, 6, 7, 8];
      for(var a = 0; a < selected.length; a++)
      {
        selectTs(selected[a]);
      }
  });
  $('#all-morning-box').on('ifUnchecked', function (event) {
      $('input').iCheck('uncheck');
      var selected = [1, 2, 3, 4, 5, 6, 7, 8];
      for(var a = 0; a < selected.length; a++)
      {
        selectTs(selected[a]);
      }
  });
  
  $('#all-afternoon-box').on('ifChecked', function (event){  
      $('.morning-box').iCheck('uncheck');   
      $('.afternoon-box').iCheck('check');
      $('.evening-box').iCheck('uncheck');
      var selected = [9, 10, 11, 12, 13, 14];
      for(var a = 0; a < selected.length; a++)
      {
        selectTs(selected[a]);
      }
  });
  $('#all-afternoon-box').on('ifUnchecked', function (event) { 
      $('input').iCheck('uncheck');
      var selected = [9, 10, 11, 12, 13, 14];
      for(var a = 0; a < selected.length; a++)
      {
        selectTs(selected[a]);
      }
  });
  
  $('#all-evening-box').on('ifChecked', function (event){
      $('.morning-box').iCheck('uncheck');   
      $('.afternoon-box').iCheck('uncheck');
      $('.evening-box').iCheck('check');
      var selected = [15, 16, 17, 18];
      for(var a = 0; a < selected.length; a++)
      {
        selectTs(selected[a]);
      }
  });
  $('#all-evening-box').on('ifUnchecked', function (event) {
      $('input').iCheck('uncheck');
      var selected = [15, 16, 17, 18];
      for(var a = 0; a < selected.length; a++)
      {
        selectTs(selected[a]);
      }
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
    filterCityTo();
    filterCityFrom();
    filterLocationTo();
    filterLocationFrom();
    filterLocationTo();
    // if($('#vehicle > option').length == 0)
    // {
    //   $("#media-message").fadeIn("slow");
    //   $('#media-message').html("NOT ENOUGH RESOURCES TO SAVE").addClass('alert alert-danger');
    //   $('.save').prop('disabled', true);
    // }
    $('#advertiser-add-form').on('submit', function(e){
      e.preventDefault();
      if($('#image_file').val() == '')
      {
        $('#advertiser-message-add').html("The file upload cannot be empty!").addClass('alert alert-danger');
      }
      else
      {
        $('#loading_img').removeClass('hidden');
        $.ajax({
          url: "<?php echo site_url('advertisers/saveAdvertiser') ?>",
          method: 'POST',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success:function(data) {
            if(!data.success){
              if(data.errors){
                $(window).scrollTop(0);
                $("#advertiser-message-add").fadeIn("slow");
                $('#advertiser-message-add').html(data.errors).addClass('alert alert-danger');
                $('#loading_img').addClass('hidden');
                setTimeout(function() {
                    $('#advertiser-message-add').fadeOut('slow');
                }, 3000);
              }
            }else {
              $('#loading_img').addClass('hidden');
              $('#advertiser-add').modal('hide');
              swal({
                title: data.message,
                type: 'success',
                confirmButtonText: 'Okay',
                confirmButtonClass: 'btn btn-success btn-fix',
                buttonsStyling: false
              })
              $('#advertiser_id')
              .append($('<option>', { value : data.id })
              .text(data.name));
              $('#advertiser_id').val(data.id);
              $('input[name="advertiser_name-add"]').val('');
              $('input[name="advertiser_address-add"]').val('');
              $('input[name="advertiser_contact-add"]').val('');
              $('input[name="advertiser_email-add"]').val('');
              $('input[name="advertiser_website-add"]').val('');
              $('select[name="agency_id-add"]').children().removeAttr("selected");
              $('select[name="agency_id-add"] option:first-child').attr('selected', 'selected');
              $('select[name="agency_id-add"]').trigger('change');
              $('textarea[name="advertiser_description-add"]').val('');
            }
          }
        });
      }
    });
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
      //PAUL : DISABLE MO YUNG NEXT DITO DUN SA CITY
    }
    else
    {
      // PAUL : ENABLE MO YUNG NEXT DITO DUN SA CITY
      $.each(cityfiltered, function(key, value) {   
        $('#city_id')
          .append($('<option>', { value : value[0] })
          .text(value[1])); 
      });
    }
    $('#city_id').trigger('change');
  }
  $("#region_id").change(function() {
    cityfilter();
  });

  var routefiltered = [];
  function routefilter() {
    routefiltered=[];
    if($('#city_id').val() == 'all')
    {
      routefiltered.push([
        'all',
        'All Routes',
      ]);
    }
    for(var a = 0 ; a < route.length ; a++)
    {
      if($('#city_id').val() == 'all')
      {
        routefiltered.push([
          route[a][0],
          route[a][1],
        ]);
      }
      else if($('#city_id').val() == 0)
      {
      }
      else if(route[a][2] == $('#city_id').val() || route[a][3] == $('#city_id').val())
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
        .append('<option value=0>NO ROUTE IN THAT CITY</option>')
        .val(0)
      ;
      //PAUL : DISABLE MO YUNG NEXT DITO DUN SA ROUTE
    }
    else
    {
      //PAUL : ENABLE MO YUNG NEXT DITO DUN SA ROUTE
      $.each(routefiltered, function(key, value) {   
        $('#route_id')
          .append($('<option>', { value : value[0] })
          .text(value[1])); 
      });
    }
    $('#route_id').trigger('change');
  }
  $("#city_id").change(function() {
    // locationfilter();
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
    getAvailability(dates[0], dates[1]);
  }

  $("#reservation").change(function() {
    getDates();
  });
  //////////////////////

  // TIMESLOT
  var supert = [];

  function getAvailability(fromD, toD) {
    var dateFrom = fromD.split('/');
    var dateTo = toD.split('/');
    var dateFr = dateFrom[2]+'-'+dateFrom[0]+'-'+dateFrom[1];
    var dateT = dateTo[2]+'-'+dateTo[0]+'-'+dateTo[1];
    $.get("<?php echo site_url('api/MRetrieve/getschedavailability/from/"+dateFr+"/to/"+dateT+"') ?>", function(data){
      var basic = $.map(data, function(el) { return el; });
      supert = basic;
      timefilter();
    });
  }

  var amcheck = '';
  var pmcheck = '';
  var evecheck = '';
  function  timefilter() {
    amcheck = '';
    pmcheck = '';
    evecheck = '';
    // PAUL : PA LAGYAN TO NG INPUT MASK
    for(var a = 0; a < timeslot.length; a++)
    {
      if(!supert[a])
      {
        supert[a] = 100;
      }
      if(timeslot[a][2] == "am")
      {
        amcheck = amcheck + '<tr><td><input id="tslot-'+timeslot[a][0]+'" name="tslot_id" value="'+timeslot[a][0]+'" type="checkbox" class="flat morning-box" onclick="selectTs('+timeslot[a][0]+')"></td><td>'+timeslot[a][1]+'</td><td>'+supert[a]+'%</td><td><div class="input-group"><input type="text" class="form-control" id="ad-frequency" name="time-'+timeslot[a][0]+'" readonly="readOnly"><div class="input-group-addon"><i class="fa fa-clock-o"></i></div></div></td></tr>';
      }
      else if(timeslot[a][2] == "pm")
      {
        pmcheck = pmcheck + '<tr><td><input id="tslot-'+timeslot[a][0]+'" name="tslot_id" value="'+timeslot[a][0]+'" type="checkbox" class="flat afternoon-box" onclick="selectTs('+timeslot[a][0]+')"></td><td>'+timeslot[a][1]+'</td><td>'+supert[a]+'%</td><td><div class="input-group"><input type="text" class="form-control" id="ad-frequency" name="time-'+timeslot[a][0]+'" readonly="readOnly"><div class="input-group-addon"><i class="fa fa-clock-o"></i></div></div></td></tr>';
      }
      else if(timeslot[a][2] == "eve")
      {
        evecheck = evecheck + '<tr><td><input id="tslot-'+timeslot[a][0]+'" name="tslot_id" value="'+timeslot[a][0]+'" type="checkbox" class="flat evening-box" onclick="selectTs('+timeslot[a][0]+')"></td><td>'+timeslot[a][1]+'</td><td>'+supert[a]+'%</td><td><div class="input-group"><input type="text" class="form-control" id="ad-frequency" name="time-'+timeslot[a][0]+'" readonly="readOnly"><div class="input-group-addon"><i class="fa fa-clock-o"></i></div></div></td></tr>';
      }
    }
    $('#morning-table tbody').html(amcheck);
    $('#afternoon-table tbody').html(pmcheck);
    $('#evening-table tbody').html(evecheck);
  }
  var tslotsel = [];
  // PAUL : KELANGAN YUNG INPUT NAKA MASK TAS MINIMUM 1, BAHALA KA NA, BASTA KELANGAN DI MABURA INPUT
  function selectTs(timeslot) {
    var timeSl = 'time-'+timeslot;
    if($('#tslot-'+timeslot).is(':checked'))
    {
      $('input[name="'+timeSl+'"]').val(1);
      $('input[name="'+timeSl+'"]').prop({ readOnly: false });
    }
    else
    {
      $('input[name="'+timeSl+'"]').val('');
      $('input[name="'+timeSl+'"]').prop({ readOnly: true });
    }
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

  var cities = [];
  var cityX = [];
  cityX.push([
    "all",
    "All Cities",
    0,
  ]);
  <?php 
    foreach($city as $row)
    {
  ?>
    cityX.push([
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

  function filterCityFrom() {
    filteredCityFrom=[];
    for(var a = 0 ; a < cityX.length ; a++)
    {
      if($('#region_from').val() == "all")
      {
        filteredCityFrom.push([
          cityX[a][0],
          cityX[a][1],
        ]);
      }
      else if(cityX[a][2] == $('#region_from').val())
      {
        filteredCityFrom.push([
          cityX[a][0],
          cityX[a][1],
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
    for(var a = 0 ; a < cityX.length ; a++)
    {
      if($('#region_to').val() == "all")
      {
        filteredCityTo.push([
          cityX[a][0],
          cityX[a][1],
        ]);
      }
      else if(cityX[a][2] == $('#region_to').val())
      {
        filteredCityTo.push([
          cityX[a][0],
          cityX[a][1],
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

            $('#add-route-box').modal('hide');
            swal({
              title: data.message,
              type: 'success',
              confirmButtonText: 'Okay',
              confirmButtonClass: 'btn btn-success btn-fix',
              buttonsStyling: false
            })
            $('#route_id')
            .append($('<option>', { value : data.id })
            .text(data.name));
            $('#route_id').val(data.id);

            $('input[name="route_name"]').val('');
            $('textarea[name="route_description"]').val('');
            $('select[id="region_from"]').children().removeAttr("selected");
            $('select[id="region_from"] option:first-child').attr('selected', 'selected');
            $('select[id="region_from"]').trigger('change');
            $('select[id="region_to"]').children().removeAttr("selected");
            $('select[id="region_to"] option:first-child').attr('selected', 'selected');
            $('select[id="region_to"]').trigger('change');
            $('select[name="city_to"]').children().removeAttr("selected");
            $('select[name="city_to"] option:first-child').attr('selected', 'selected');
            $('select[name="city_to"]').trigger('change');
            $('select[name="city_from"]').children().removeAttr("selected");
            $('select[name="city_from"] option:first-child').attr('selected', 'selected');
            $('select[name="city_from"]').trigger('change');
            $('select[name="location_to"]').children().removeAttr("selected");
            $('select[name="location_to"] option:first-child').attr('selected', 'selected');
            $('select[name="location_to"]').trigger('change');
            $('select[name="location_from"]').children().removeAttr("selected");
            $('select[name="location_from"] option:first-child').attr('selected', 'selected');
            $('select[name="location_from"]').trigger('change');
          }
        }
      })
    }
  }
</script>