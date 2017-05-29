<div class="modal fade" id="vehicle-assign-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Vehicle Details</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <div class="col-md-12">
              <div id="media-message"></div>
              <div class="form-group">
                <label>Vehicle Type</label>
                <select id="vehicle_type" class="form-control select2">
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
              <div class="form-group">
                <label>Vehicles</label>
                <select id="vehicle" class="form-control select2">
                </select>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <button id="show-div" type="button" class="btn btn-success select" onclick="selectVehicle()">Select</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Assign Media</h3>
    <div class="box-tools pull-right"></div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <?php echo form_open('welcome', array('id'=>'media')); ?>
            <div class="form-group hidden">
              <input type="text" name="ready_vehicle_id" id="media_id" class="form-control" readonly>
            </div>
            <div class="input-group">
              <div class="input-group-btn">
                <button type="button" class="btn btn-success" onclick="openModal()">Select Vehicle</button>
              </div>
              <input type="text" id="vehicle_name" class="form-control" readonly>
              <input type="text" name="vehicle_id" id="vehicle_id" class="form-control hidden" readonly>
            </div></br>
            <div id="hidden-form">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Select Mediabox</label>
                  <select name="box_id" id="box" class="form-control select2">
                  </select>
                  <p class="help-block" id="box-info">&nbsp;</p>
                </div>
                <div class="form-group">
                  <label>Select GPS</label>
                  <select name="gps_id" id="gps" class="form-control select2">
                  </select>
                  <p class="help-block" id="gps-info">Additional info here</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Select TV</label>
                  <select name="tv_id" id="tv" class="form-control select2">
                  </select>
                  <p class="help-block" id="tv-info">Additional info for TV</p>
                </div>
                <div class="form-group">
                  <label>Select Card Reader</label>
                  <select name="card_id" id="card" class="form-control select2">
                  </select>
                  <p class="help-block" card-info>Additional info here</p>
                </div>
              </div>
              <button type="button" class="btn btn-success save" onclick="attempt_Media()" style="float:right;">Save</button>
            </div>
          <?php echo form_close(); ?>
        </div>
      </div> 
  </div>
  <div class="box-footer">
      <h3 class="hidden-text text-center">Select Vehicle First</h3>
  </div>
</div>

<script type="text/javascript">
  $("#hidden-form").hide();
  $(".select2").select2();
  $('.select2-selection__rendered').removeAttr('title');
  $("#show-div").click(function(){
     $(".hidden-text").hide();
     $("#hidden-form").show();
   });
  function openModal(){
    $('#vehicle-assign-box').modal('show');
  }       
  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////
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

  function filterDevice(inf) {
    console.log(inf);
    // info [0] = ready_vehicle id
    $('#media_id').val(inf[0]);
    // info [1] = box
    var selBox = [];
    for(var a = 0; a < boxes.length; a++)
    {
      selBox.push([boxes[a][0],boxes[a][1]]);
    }
    if(inf[1][0] != null)
    {
      selBox.push([inf[1][0],inf[1][1]]);
    }
    $('#box')
      .find('option')
      .remove()
      .end()
    ;
    $.each(selBox, function(key, value) {   
      $('#box')
        .append($('<option>', { value : value[0] })
        .text(value[1])); 
    });
    if(inf[1][0] != null)
    {
      $('#box').val(inf[1][0]);
    }
    else
    {
      $('#box').val(0);
    }
    // // info [2] = tv
    var selTv = [];
    for(var a = 0; a < tvs.length; a++)
    {
      selTv.push([tvs[a][0],tvs[a][1]]);
    }
    if(inf[2][0] != null)
    {
      selTv.push([inf[2][0],inf[2][1]]);
    }
    $('#tv')
      .find('option')
      .remove()
      .end()
    ;
    $.each(selTv, function(key, value) {   
      $('#tv')
        .append($('<option>', { value : value[0] })
        .text(value[1])); 
    });
    if(inf[2][0] != null)
    {
      $('#tv').val(inf[2][0]);
    }
    else
    {
      $('#tv').val(0);
    }
    // // info [3] = gps
    var selGps = [];
    for(var a = 0; a < gps.length; a++)
    {
      selGps.push([gps[a][0],gps[a][1]]);
    }
    if(inf[3][0] != null)
    {
      selGps.push([inf[3][0],inf[3][1]]);
    }
    $('#gps')
      .find('option')
      .remove()
      .end()
    ;
    $.each(selGps, function(key, value) {   
      $('#gps')
        .append($('<option>', { value : value[0] })
        .text(value[1])); 
    });
    if(inf[3][0] != null)
    {
      $('#gps').val(inf[3][0]);
    }
    else
    {
      $('#gps').val(0);
    }
    // // info [4] = card
    var selCard = [];
    for(var a = 0; a < cards.length; a++)
    {
      selCard.push([cards[a][0],cards[a][1]]);
    }
    if(inf[4][0] != null)
    {
      selCard.push([inf[4][0],inf[4][1]]);
    }
    $('#card')
      .find('option')
      .remove()
      .end()
    ;
    $.each(selCard, function(key, value) {   
      $('#card')
        .append($('<option>', { value : value[0] })
        .text(value[1])); 
    });
    if(inf[4][0] != null)
    {
      $('#card').val(inf[4][0]);
    }
    else
    {
      $('#card').val(0);
    }
  }
  // E T C

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

  // MEDIABOX
  var boxes = [];
  boxes.push([0,"Mediabox"]);
  <?php 
    foreach($boxes as $row)
    {
  ?>
    boxes.push([
      <?php echo $row[0]; ?>,
      "<?php echo $row[1]; ?>",
    ]);
  <?php 
    }
  ?>

  // TV
  var tvs = [];
  tvs.push([0,"Television"]);
  <?php 
    foreach($tvs as $row)
    {
  ?>
    tvs.push([
      <?php echo $row[0]; ?>,
      "<?php echo $row[1]; ?>",
    ]);
  <?php 
    }
  ?>

  // GPS
  var gps = [];
  gps.push([0,"GPS"]);
  <?php 
    foreach($gps as $row)
    {
  ?>
    gps.push([
      <?php echo $row[0]; ?>,
      "<?php echo $row[1]; ?>",
    ]);
  <?php 
    }
  ?>

  // CARD
  var cards = [];
  cards.push([0,"Card Reader"]);
  <?php 
    foreach($cards as $row)
    {
  ?>
    cards.push([
      <?php echo $row[0]; ?>,
      "<?php echo $row[1]; ?>",
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

  // MEDIA ASSIGNMENT
  function assign_init() {
    $.each(boxes, function(key, value) {   
      $('#box')
        .append($('<option>', { value : value[0] })
        .text(value[1])); 
    });
    $.each(tvs, function(key, value) {   
      $('#tv')
        .append($('<option>', { value : value[0] })
        .text(value[1])); 
    });
    $.each(gps, function(key, value) {   
      $('#gps')
        .append($('<option>', { value : value[0] })
        .text(value[1])); 
    });
    $.each(cards, function(key, value) {   
      $('#card')
        .append($('<option>', { value : value[0] })
        .text(value[1])); 
    });
  }

  // C R E A T E
  function attempt_Media() {
    if($('#box').val() == 0 && $('#gps').val() == 0 && $('#tv').val() == 0 && $('#card').val() == 0 && $('#media_id').val() == "")
    {
      alert('nothing to save!');
    }
    else if($('#box').val() == 0 && $('#gps').val() == 0 && $('#tv').val() == 0 && $('#card').val() == 0 && $('#media_id').val() != "")
    {
      // alert('delete');
      delete_media($('#media_id').val());
    }
    else if($('#media_id').val() != "")
    {
      // alert('update');
      update_Media();
    }
    else
    {
      // alert('save');
      save_Media();
    }
  }

  function save_Media() {
    $.ajax({
      url: "<?php echo site_url('media/saveMedia') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#media').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $(window).scrollTop(0);
            $("#media-message").fadeIn("slow");
            $('#media-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#media-message').fadeOut('slow');
            }, 3000);
          }
        }else {
          $('#message-text').html(data.message);
          $('#successModal').modal('show');
        }
      }
    })
  }

  // U P D A T E
  function update_Media() {
    $.ajax({
      url: "<?php echo site_url('media/updateMedia') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#media').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#media-message").fadeIn("slow");
            $('#media-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#media-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#media-box').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
  function delete_media(media_id) {
    // swal({
    //   title: 'ARE YOU SURE?',
    //   text: "You cannot revert this action!",
    //   type: 'warning',
    //   showCancelButton: true,
    //   confirmButtonColor: '#3085d6',
    //   cancelButtonColor: '#d33',
    //   confirmButtonText: 'Delete',
    //   cancelButtonText: 'Cancel',
    //   confirmButtonClass: 'btn btn-success btn-fix',
    //   cancelButtonClass: 'btn btn-default',
    //   animation: false,
    //   customClass: 'animated fadeInDown',
    //   buttonsStyling: false
    // }).then(function () {
    //     swal({
    //      //pede to ilagay sa success modal di ko mahanap kung saan
    //       title: 'DELETED SUCCESSFULLY',
    //       type: 'success',
    //       confirmButtonText: 'Okay',
    //       confirmButtonClass: 'btn btn-success btn-fix',
    //       buttonsStyling: false
    //     })
    // }, function (dismiss) {
    //   if (dismiss === 'cancel') {
    //     swal({
    //       title: 'CANCELLED',
    //       type: 'error',
    //       confirmButtonText: 'Okay',
    //       confirmButtonClass: 'btn btn-default btn-fix',
    //       buttonsStyling: false
    //     })
    //   }
    // })
    if(confirm('Do you really want to delete this Media Record ??')){
      $.ajax({
        url: "<?php echo site_url('media/delete_Media/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'ready_vehicle_id='+media_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#media-delete-message").fadeIn("slow");
              $('#media-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#media-delete-message').fadeOut('slow');
              }, 3000);
            }
          }else {
            $('#message-text').html(data.message);
            $('#successModal').modal('show');
          }
        }
      });
    }
  }
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////

  // END OF USER ADD JAVASCRIPT
</script>