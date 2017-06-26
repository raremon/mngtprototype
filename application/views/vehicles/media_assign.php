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

<div class="modal fade" id="mediabox-add" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open('mediaboxes/saveBox', array('id'=>'box-add-form')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Mediabox Details</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="col-md-12">
            <div id="box-message-add"></div>
            <div class="form-group">
              <label>Box Tag</label>
              <input type="text" name="box_tag-add" class="form-control" placeholder="Enter Mediabox Tag"/>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="box_description-add" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary save" onclick="save_Box()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>
<div class="modal fade" id="gps-add" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open('gps/save', array('id'=>'gps-add-form')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">GPS Details</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="col-md-12">
            <div id="gps-message-add"></div>
            <div class="form-group">
              <label>GPS Serial</label>
              <input type="text" name="gps_serial-add" class="form-control" placeholder="Enter GPS Serial"/>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="gps_description-add" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary save" onclick="save_Gps()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>
<div class="modal fade" id="tv-add" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open('tvs/save', array('id'=>'tv-add-form')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Television Details</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="col-md-12">
            <div id="tv-message-add"></div>
            <div class="form-group">
              <label>Television Serial</label>
              <input type="text" name="tv_serial-add" class="form-control" placeholder="Enter Television Serial"/>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="tv_description-add" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary save" onclick="save_Tv()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>
<div class="modal fade" id="card-add" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open('card_readers/save', array('id'=>'card-add-form')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Card Reader Details</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="col-md-12">
            <div id="card-message-add"></div>
            <div class="form-group">
              <label>Card Reader Serial</label>
              <input type="text" name="card_serial-add" class="form-control" placeholder="Enter Card Reader Serial"/>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="card_description-add" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary save" onclick="save_Card()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>
<div class="modal fade" id="cctv-add" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open('cctvs/save', array('id'=>'cctv-add-form')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CCTV Details</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="col-md-12">
            <div id="cctv-message-add"></div>
            <div class="form-group">
              <label>CCTV Serial</label>
              <input type="text" name="cctv_serial-add" class="form-control" placeholder="Enter CCTV Serial"/>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="cctv_description-add" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary save" onclick="save_Cctv()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>
<div class="modal fade" id="ipcam-add" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open('ipcams/save', array('id'=>'ipcam-add-form')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">IP Camera Details</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="col-md-12">
            <div id="ipcam-message-add"></div>
            <div class="form-group">
              <label>IP Camera Serial</label>
              <input type="text" name="ipcam_serial-add" class="form-control" placeholder="Enter IP Camera Serial"/>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="ipcam_description-add" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary save" onclick="save_Ipcam()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>
<div class="modal fade" id="pos-add" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open('pos/save', array('id'=>'pos-add-form')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">POS Details</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="col-md-12">
            <div id="pos-message-add"></div>
            <div class="form-group">
              <label>POS Serial</label>
              <input type="text" name="pos_serial-add" class="form-control" placeholder="Enter POS Serial"/>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="pos_description-add" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary save" onclick="save_Pos()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
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
              <div class="col-md-12">
                <div class="form-group">
                  <label>Select Mediabox</label> 
                  <a class="btn btn-link add-link pull-right" href="javascript:void(0);" data-toggle="modal" data-target="#mediabox-add"><i class="fa fa-plus-square-o">&nbsp;</i>New Mediabox</a>
                  <select name="box_id" id="box" class="form-control select2">
                  </select>
                  <p class="help-block" id="box-info">&nbsp;</p>
                </div>
                <div class="form-group">
                  <label>Select GPS</label>
                  <a class="btn btn-link add-link pull-right" href="javascript:void(0);" data-toggle="modal" data-target="#gps-add"><i class="fa fa-plus-square-o">&nbsp;</i>New GPS</a>
                  <select name="gps_id" id="gps" class="form-control select2">
                  </select>
                  <p class="help-block" id="gps-info">Additional info for Gps</p>
                </div>
                <div class="form-group">
                  <label>Select TV</label>
                  <a class="btn btn-link add-link pull-right" href="javascript:void(0);" data-toggle="modal" data-target="#tv-add"><i class="fa fa-plus-square-o">&nbsp;</i>New Television</a>
                  <select name="tv_id" id="tv" class="form-control select2">
                  </select>
                  <p class="help-block" id="tv-info">Additional info for TV</p>
                </div>
                <div class="form-group">
                  <label>Select Card Reader</label>
                  <a class="btn btn-link add-link pull-right" href="javascript:void(0);" data-toggle="modal" data-target="#card-add"><i class="fa fa-plus-square-o">&nbsp;</i>New Card Reader</a>
                  <select name="card_id" id="card" class="form-control select2">
                  </select>
                  <p class="help-block" card-info>Additional info for Card Reader</p>
                </div>
                <div class="form-group">
                  <label>Select CCTV</label>
                  <a class="btn btn-link add-link pull-right" href="javascript:void(0);" data-toggle="modal" data-target="#cctv-add"><i class="fa fa-plus-square-o">&nbsp;</i>New CCTV</a>
                  <select name="cctv_id" id="cctv" class="form-control select2">
                  </select>
                  <p class="help-block" card-info>Additional info for CCTV</p>
                </div>
                <div class="form-group">
                  <label>Select IP Camera</label>
                  <a class="btn btn-link add-link pull-right" href="javascript:void(0);" data-toggle="modal" data-target="#ipcam-add"><i class="fa fa-plus-square-o">&nbsp;</i>New IP Camera</a>
                  <select name="ipcam_id" id="ipcam" class="form-control select2">
                  </select>
                  <p class="help-block" card-info>Additional info for IP Camera</p>
                </div>
                <div class="form-group">
                  <label>Select POS</label>
                  <a class="btn btn-link add-link pull-right" href="javascript:void(0);" data-toggle="modal" data-target="#pos-add"><i class="fa fa-plus-square-o">&nbsp;</i>New POS</a>
                  <select name="pos_id" id="pos" class="form-control select2">
                  </select>
                  <p class="help-block" card-info>Additional info for POS</p>
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

    // // info [5] = cctv
    var selCctv = [];
    for(var a = 0; a < cctvs.length; a++)
    {
      selCctv.push([cctvs[a][0],cctvs[a][1]]);
    }
    if(inf[5][0] != null)
    {
      selCctv.push([inf[5][0],inf[5][1]]);
    }
    $('#cctv')
      .find('option')
      .remove()
      .end()
    ;
    $.each(selCctv, function(key, value) {   
      $('#cctv')
        .append($('<option>', { value : value[0] })
        .text(value[1])); 
    });
    if(inf[5][0] != null)
    {
      $('#cctv').val(inf[5][0]);
    }
    else
    {
      $('#cctv').val(0);
    }

    // // info [6] = ipcam
    var selIpcam = [];
    for(var a = 0; a < ipcams.length; a++)
    {
      selIpcam.push([ipcams[a][0],ipcams[a][1]]);
    }
    if(inf[6][0] != null)
    {
      selIpcam.push([inf[6][0],inf[6][1]]);
    }
    $('#ipcam')
      .find('option')
      .remove()
      .end()
    ;
    $.each(selIpcam, function(key, value) {   
      $('#ipcam')
        .append($('<option>', { value : value[0] })
        .text(value[1])); 
    });
    if(inf[6][0] != null)
    {
      $('#ipcam').val(inf[6][0]);
    }
    else
    {
      $('#ipcam').val(0);
    }

    // // info [7] = pos
    var selPos = [];
    for(var a = 0; a < pos.length; a++)
    {
      selPos.push([pos[a][0],pos[a][1]]);
    }
    if(inf[7][0] != null)
    {
      selPos.push([inf[7][0],inf[7][1]]);
    }
    $('#pos')
      .find('option')
      .remove()
      .end()
    ;
    $.each(selPos, function(key, value) {   
      $('#pos')
        .append($('<option>', { value : value[0] })
        .text(value[1])); 
    });
    if(inf[7][0] != null)
    {
      $('#pos').val(inf[7][0]);
    }
    else
    {
      $('#pos').val(0);
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

  // IP Camera
  var ipcams = [];
  ipcams.push([0,"IP Camera"]);
  <?php 
    foreach($ipcams as $row)
    {
  ?>
    ipcams.push([
      <?php echo $row[0]; ?>,
      "<?php echo $row[1]; ?>",
    ]);
  <?php 
    }
  ?>

  // CCTV
  var cctvs = [];
  cctvs.push([0,"CCTV"]);
  <?php 
    foreach($cctvs as $row)
    {
  ?>
    cctvs.push([
      <?php echo $row[0]; ?>,
      "<?php echo $row[1]; ?>",
    ]);
  <?php 
    }
  ?>

  // POS
  var pos = [];
  pos.push([0,"POS"]);
  <?php 
    foreach($poss as $row)
    {
  ?>
    pos.push([
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

    $.each(cctvs, function(key, value) {   
      $('#cctv')
        .append($('<option>', { value : value[0] })
        .text(value[1])); 
    });
    $.each(ipcams, function(key, value) {   
      $('#ipcam')
        .append($('<option>', { value : value[0] })
        .text(value[1])); 
    });
    $.each(pos, function(key, value) {   
      $('#pos')
        .append($('<option>', { value : value[0] })
        .text(value[1])); 
    });
  }

  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////
    function attempt_Media() {
      if($('#box').val() == 0 && $('#gps').val() == 0 && $('#tv').val() == 0 && $('#card').val() == 0 && $('#cctv').val() == 0 && $('#ipcam').val() == 0 && $('#pos').val() == 0 && $('#media_id').val() == "")
      {
        swal({
          title: 'Nothing to Save',
          type: 'error',
          confirmButtonText: 'Okay',
          confirmButtonClass: 'btn btn-default btn-fix',
          buttonsStyling: false
        })
      }
      else if($('#box').val() == 0 && $('#gps').val() == 0 && $('#tv').val() == 0 && $('#card').val() == 0 && $('#cctv').val() == 0 && $('#ipcam').val() == 0 && $('#pos').val() == 0 && $('#media_id').val() != "")
      {
        delete_media($('#media_id').val());
      }
      else if($('#media_id').val() != "")
      {
        update_Media();
      }
      else
      {
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
    function delete_media(media_id) {
      swal({
        title: 'Are you sure you want to empty devices on Vehicle?',
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
          url: "<?php echo site_url('media/delete_Media/') ?>",
          type: 'POST',
          dataType: 'json',
          data: 'ready_vehicle_id='+media_id,
          encode:true,
          success:function(data) {
            if(!data.success){
              if(data.errors){
                swal({
                  title: data.errors,
                  type: 'error',
                  confirmButtonText: 'Okay',
                  confirmButtonClass: 'btn btn-default btn-fix',
                  buttonsStyling: false,
                  timer: 3000  
                })
              }
            }else {
              swal({
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
    function save_Box() {
      $.ajax({
        url: "<?php echo site_url('mediaboxes/saveBox') ?>",
        type: 'POST',
        dataType: 'json',
        data: $('#box-add-form').serialize(),
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#box-message-add").fadeIn("slow");
              $('#box-message-add').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#box-message-add').fadeOut('slow');
              }, 3000);
            }
          }else {
            $('#mediabox-add').modal('hide');
            swal({
              title: 'SAVED SUCCESSFULLY',
              type: 'success',
              confirmButtonText: 'Okay',
              confirmButtonClass: 'btn btn-success btn-fix',
              buttonsStyling: false
            });
            $('#box')
              .append($('<option>', { value : data.id })
              .text(data.tag));
            $('#box').val(data.id);
            $('input[name="box_tag-add"]').val('');
            $('textarea[name="box_description-add"]').val('');
          }
        }
      })
    }
    function save_Gps() {
      $.ajax({
        url: "<?php echo site_url('gps/save') ?>",
        type: 'POST',
        dataType: 'json',
        data: $('#gps-add-form').serialize(),
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#gps-message-add").fadeIn("slow");
              $('#gps-message-add').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#gps-message-add').fadeOut('slow');
              }, 3000);
            }
          }else {
            $('#gps-add').modal('hide');
            swal({
              title: 'SAVED SUCCESSFULLY',
              type: 'success',
              confirmButtonText: 'Okay',
              confirmButtonClass: 'btn btn-success btn-fix',
              buttonsStyling: false
            });
            $('#gps')
              .append($('<option>', { value : data.id })
              .text(data.tag));
            $('#gps').val(data.id);
            $('input[name="gps_serial-add"]').val('');
            $('textarea[name="gps_description-add"]').val('');
          }
        }
      })
    }
    function save_Tv() {
      $.ajax({
        url: "<?php echo site_url('tvs/save') ?>",
        type: 'POST',
        dataType: 'json',
        data: $('#tv-add-form').serialize(),
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#tv-message-add").fadeIn("slow");
              $('#tv-message-add').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#tv-message-add').fadeOut('slow');
              }, 3000);
            }
          }else {
            $('#tv-add').modal('hide');
            swal({
              title: 'SAVED SUCCESSFULLY',
              type: 'success',
              confirmButtonText: 'Okay',
              confirmButtonClass: 'btn btn-success btn-fix',
              buttonsStyling: false
            });
            $('#tv')
              .append($('<option>', { value : data.id })
              .text(data.tag));
            $('#tv').val(data.id);
            $('input[name="tv_serial-add"]').val('');
            $('textarea[name="tv_description-add"]').val('');
          }
        }
      })
    }
    function save_Card() {
      $.ajax({
        url: "<?php echo site_url('card_readers/save') ?>",
        type: 'POST',
        dataType: 'json',
        data: $('#card-add-form').serialize(),
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#card-message-add").fadeIn("slow");
              $('#card-message-add').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#card-message-add').fadeOut('slow');
              }, 3000);
            }
          }else {
            $('#card-add').modal('hide');
            swal({
              title: 'SAVED SUCCESSFULLY',
              type: 'success',
              confirmButtonText: 'Okay',
              confirmButtonClass: 'btn btn-success btn-fix',
              buttonsStyling: false
            });
            $('#card')
              .append($('<option>', { value : data.id })
              .text(data.tag));
            $('#card').val(data.id);
            $('input[name="card_serial-add"]').val('');
            $('textarea[name="card_description-add"]').val('');
          }
        }
      })
    }
    function save_Cctv() {
      $.ajax({
        url: "<?php echo site_url('cctvs/save') ?>",
        type: 'POST',
        dataType: 'json',
        data: $('#cctv-add-form').serialize(),
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#cctv-message-add").fadeIn("slow");
              $('#cctv-message-add').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#cctv-message-add').fadeOut('slow');
              }, 3000);
            }
          }else {
            $('#cctv-add').modal('hide');
            swal({
              title: 'SAVED SUCCESSFULLY',
              type: 'success',
              confirmButtonText: 'Okay',
              confirmButtonClass: 'btn btn-success btn-fix',
              buttonsStyling: false
            });
            $('#cctv')
              .append($('<option>', { value : data.id })
              .text(data.tag));
            $('#cctv').val(data.id);
            $('input[name="cctv_serial-add"]').val('');
            $('textarea[name="cctv_description-add"]').val('');
          }
        }
      })
    }
    function save_Ipcam() {
      $.ajax({
        url: "<?php echo site_url('ipcams/save') ?>",
        type: 'POST',
        dataType: 'json',
        data: $('#ipcam-add-form').serialize(),
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#ipcam-message-add").fadeIn("slow");
              $('#ipcam-message-add').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#ipcam-message-add').fadeOut('slow');
              }, 3000);
            }
          }else {
            $('#ipcam-add').modal('hide');
            swal({
              title: 'SAVED SUCCESSFULLY',
              type: 'success',
              confirmButtonText: 'Okay',
              confirmButtonClass: 'btn btn-success btn-fix',
              buttonsStyling: false
            });
            $('#ipcam')
              .append($('<option>', { value : data.id })
              .text(data.tag));
            $('#ipcam').val(data.id);
            $('input[name="ipcam_serial-add"]').val('');
            $('textarea[name="ipcam_description-add"]').val('');
          }
        }
      })
    }
    function save_Pos() {
      $.ajax({
        url: "<?php echo site_url('pos/save') ?>",
        type: 'POST',
        dataType: 'json',
        data: $('#pos-add-form').serialize(),
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#pos-message-add").fadeIn("slow");
              $('#pos-message-add').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#pos-message-add').fadeOut('slow');
              }, 3000);
            }
          }else {
            $('#pos-add').modal('hide');
            swal({
              title: 'SAVED SUCCESSFULLY',
              type: 'success',
              confirmButtonText: 'Okay',
              confirmButtonClass: 'btn btn-success btn-fix',
              buttonsStyling: false
            });
            $('#pos')
              .append($('<option>', { value : data.id })
              .text(data.tag));
            $('#pos').val(data.id);
            $('input[name="pos_serial-add"]').val('');
            $('textarea[name="pos_description-add"]').val('');
          }
        }
      })
    }
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////

  // END OF MEDIA ASSIGN JAVASCRIPT
</script>