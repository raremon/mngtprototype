<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZWe4gOwsSV0uNIKkrwvzjbVg15adxrvw&libraries=places" type="text/javascript"></script>

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

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Route Details</h3>
        <div class="box-tools pull-right">
        </div><!-- /.box-tools -->
      </div><!-- /.box-header -->
      <div class="box-body">
        <div id="main-cont" class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div id="route-message"></div>

              <div id="map-canvas"> </div>
              <?php echo form_open('welcome', array('id'=>'route')); ?>
              <div class="form-group hidden">
                <input type="text" name="route_id" class="form-control"/>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Terminal From</label>
                    <select id="terminal_from" name="terminal_from" class="form-control">
                      <?php 
                        foreach($terminal as $row)
                        {
                      ?>
                        <option value= "<?php echo $row[0];?>" data-lat= "<?php echo $row[2];?>" data-long="<?php echo $row[3];?>">
                          <?php echo $row[1]; ?>
                        </option>
                      <?php 
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Terminal To</label>
                    <select id="terminal_to" name="terminal_to" class="form-control">
                      <?php 
                        foreach($terminal as $row)
                        {
                      ?>
                        <option value= "<?php echo $row[0];?>" data-lat= "<?php echo $row[2];?>" data-long="<?php echo $row[3];?>">
                          <?php echo $row[1]; ?>
                        </option>
                      <?php 
                        }
                      ?>
                    </select>
                    <a class="btn btn-link pull-right" href="<?php echo site_url('routes/terminals') ?>">Add Terminals</a>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>Route Name</label>
                <input type="text" name="route_name" class="form-control" placeholder="Manila to Batanggas Route"/>
              </div>
              <div class="form-group">
                <label>Route Description</label>
                <textarea name="route_description" class="form-control" cols="30" rows="7" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."></textarea>
              </div>
              <button type="button" class="btn btn-primary save" onclick="save_route()">Save</button>
              <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_route()">Update</button>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div><!-- /.box-body -->
      <div class="box-footer">

      </div><!-- box-footer -->
    </div><!-- /.box -->
      
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Route Data</h3>
        <div class="box-tools pull-right">
        </div><!-- /.box-tools -->
      </div><!-- /.box-header -->
      <div class="box-body">

      </div><!-- /.box-body -->
      <div class="box-footer">
          <div class="row">
            <div class="container-fluid">
              <div class="col-md-12">
                <table id="route_data" class="table table-hover">
                  <thead>
                    <tr>
                      <th>ROUTE ID</th>
                      <th>ROUTE NAME</th>
                      <th>ROUTE DESCRIPTION</th>
                      <th>ROUTE</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div><!-- box-footer -->
    </div><!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">

  ////////////////////////////////////////////////////////////////
  //          M  I  S  C    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////
  
  var tempValue1, tempName1, tempLat1, tempLong1, tempValue2, tempName2, tempLat2, tempLong2;
  sortFirst();
  sortSecond();
  init();

  function init(){
      tempValue1 = $('#terminal_to').find(":selected").val();
      tempName1 = $('#terminal_to').find(":selected").text();
      tempLat1 = $('#terminal_to').find(":selected").data("lat");
      tempLong1 = $('#terminal_to').find(":selected").data("long");

      $("#terminal_from option[value='"+tempValue1+"']").remove();

      tempValue2 = $('#terminal_from').find(":selected").val();
      tempName2 = $('#terminal_from').find(":selected").text();
      tempLat2 = $('#terminal_from').find(":selected").data("lat");
      tempLong2 = $('#terminal_from').find(":selected").data("long");

      $("#terminal_to option[value='"+tempValue2+"']").remove();
  }

  $( "#terminal_to" ).change(function() {
    $("#terminal_from").append('<option value="'+tempValue1+'" data-lat= "'+tempLat1+'" data-long="'+tempLong1+'">'+tempName1+'</option>');

    tempValue1 = $('#terminal_to').find(":selected").val();
    tempName1 = $('#terminal_to').find(":selected").text();
    tempLat1 = $('#terminal_to').find(":selected").data("lat");
    tempLong1 = $('#terminal_to').find(":selected").data("long");
    $("#terminal_from option[value='"+tempValue1+"']").remove();
    sortFirst();
  });

  $( "#terminal_from" ).change(function() {
    $("#terminal_to").append('<option value="'+tempValue2+'" data-lat= "'+tempLat2+'" data-long="'+tempLong2+'">'+tempName2+'</option>');

    tempValue2 = $('#terminal_from').find(":selected").val();
    tempName2 = $('#terminal_from').find(":selected").text();
    tempLat2 = $('#terminal_from').find(":selected").data("lat");
    tempLong2 = $('#terminal_from').find(":selected").data("long");
    $("#terminal_to option[value='"+tempValue2+"']").remove();
    sortSecond();
  });

  function sortFirst(){
    var sel = $('#terminal_from');
    var selected = sel.val();
    var opts_list = sel.find('option');
    opts_list.sort(function(a, b) { return $(a).text() > $(b).text() ? 1 : -1; });
    sel.html(opts_list);
    sel.val(selected);
  }

  function sortSecond(){
    var sel = $('#terminal_to');
    var selected = sel.val();
    var opts_list = sel.find('option');
    opts_list.sort(function(a, b) { return $(a).text() > $(b).text() ? 1 : -1; });
    sel.html(opts_list);
    sel.val(selected);
  }

  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    M  I  S  C    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////

  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////

  // C R E A T E
  function save_route() {
    $.ajax({
      url: "<?php echo site_url('routes/saveRoute') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#route').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $('#route-message').html(data.errors).addClass('alert alert-danger');
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
  $("#route_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('routes/show_Route') ?>",
      "type":"POST"
    },

    "columns": [
      null,
      null,
      null,
      { "width": "40%" },
      null
    ]
  })

  // U P D A T E
  function edit_route(route_id) {
    $.ajax({
      url: "<?php echo site_url('routes/edit_Route') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'route_id='+route_id,
      encode:true,
      success:function (data) {
        $('.save').attr('disabled', true);
        $('.update').removeAttr('disabled');
        $('input[name="route_id"]').val(data.route_id);
        $('input[name="route_name"]').val(data.route_name);
        $('textarea[name="route_description"]').val(data.route_description);
        $('select[name="terminal_from"]').val(data.terminal_from);
        $('select[name="terminal_to"]').val(data.terminal_to);

        markers = getMarker();
        initialize(markers);
      }
    })
  }

  function update_route() {
    $.ajax({
      url: "<?php echo site_url('routes/updateRoute') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#route').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
          $('#route-message').html(data.errors).addClass('alert alert-danger');
        }else {
          alert(data.message);
          setTimeout(function () {
            window.location.reload();
          }, 400);
        }
      }
    })
  }

  // D E L E T E
  function delete_route(route_id) {
    if(confirm('Do you really want to delete this Route Record ??')){
      $.ajax({
        url: "<?php echo site_url('routes/delete_Route/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'route_id='+route_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $('#route-message').html(data.errors).addClass('alert alert-danger');
            }
          }else {
            $('#route-message').html(data.message).addClass('alert alert-success').removeClass('alert alert-danger');
            setTimeout(function() {
              window.location.reload();
            }, 400);
          }
        }
      });
    }
  }

  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////

  ////////////////////////////////////////////////////////////////
  //        G  O  O  G  L  E    M  A  P  S    A  P  I           //
  ////////////////////////////////////////////////////////////////

  var Xmarkers = getMarker();

  function getMarker() {
    var marker=[
    [ $('#terminal_to').find(":selected").text() , $('#terminal_to').find(":selected").data("lat") , $('#terminal_to').find(":selected").data("long") ],
    [ $('#terminal_from').find(":selected").text() , $('#terminal_from').find(":selected").data("lat") , $('#terminal_from').find(":selected").data("long") ]
    ];
    return(marker);
  }

  $( "#terminal_to" ).change(function() {
    Xmarkers[0] = [ $('#terminal_to').find(":selected").text() , $('#terminal_to').find(":selected").data("lat") , $('#terminal_to').find(":selected").data("long") ];
    initialize(Xmarkers);
  });

  $( "#terminal_from" ).change(function() {
    Xmarkers[1] = [ $('#terminal_from').find(":selected").text() , $('#terminal_from').find(":selected").data("lat") , $('#terminal_from').find(":selected").data("long") ];
    initialize(Xmarkers);
  });

  initialize(Xmarkers);

  function initialize(markers) 
  {
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap',
        navigationControl: false,
        mapTypeControl: false,
        scaleControl: false,
        draggable: false,
    };

    var map = new google.maps.Map( document.getElementById('map-canvas'), mapOptions);
    map.setTilt(45);

    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });
    }
        map.fitBounds(bounds);

    google.maps.event.addListenerOnce(map, "zoom_changed", function() {
      map.setZoom(map.getZoom()-1);
    });
  }

  ////////////////////////////////////////////////////////////////
  //E  N  D    O  F    G  O  O  G  L  E    M  A  P  S    A  P  I//
  ////////////////////////////////////////////////////////////////

  // // END OF TERMINAL JAVASCRIPT
</script>