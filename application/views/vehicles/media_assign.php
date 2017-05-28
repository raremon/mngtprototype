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
              <?php echo form_open('welcome', array('id'=>'media')); ?>
              <div class="form-group hidden">
                <input type="text" name="ready_vehicle_id" class="form-control"/>
              </div>
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
                <select name="vehicle_id" id="vehicle" class="form-control select2">
                </select>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <button id="show-div" type="button" class="btn btn-success update" disabled="disabled" onclick="#">Select</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Assign Media</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
              <div class="input-group">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-success" onclick="openModal()">Select Vehicle</button>
                </div>
                <!-- /btn-group -->
                <input type="text" class="form-control" readonly>
            </div></br>
<!--                LALABAS UNG FORM PAG kA PINDOT NG SELECT DUN SA MODAL-->
              <div id="hidden-form">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Select Mediabox</label>
                    <select name="box_id" class="form-control select2">
                        <option selected="selected">Mediabox</option>
                      <?php 
                        foreach($boxes as $row)
                        {
                      ?> 
                        <option value= <?php echo $row[0];?> >
                          <?php echo $row[1]; ?>
                        </option>
                      <?php 
                        }
                      ?>
                    </select>
                    <p class="help-block">Additional info for box</p>
                  </div>
                  <div class="form-group">
<!--                    Di ko mabasa ung sa sinend mong pic kaya card nilagay ko-->
                    <label>Select GPS</label>
                    <select name="tv_id" class="form-control select2">
                        <option selected="selected">GPS</option>
                    </select>
                    <p class="help-block">Additional info here</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Select TV</label>
                    <select name="tv_id" class="form-control select2">
                        <option selected="selected">TV</option>
                      <?php 
                        foreach($tvs as $row)
                        {
                      ?>
                        <option value= <?php echo $row[0];?> >
                          <?php echo $row[1]; ?>
                        </option>
                      <?php 
                        }
                      ?>
                    </select>
                    <p class="help-block">Additional info for TV</p>
                  </div>
                  <div class="form-group">
<!--                    Di ko mabasa ung sa sinend mong pic kaya card nilagay ko-->
                    <label>Select Card</label>
                    <select name="tv_id" class="form-control select2">
                        <option selected="selected">Card</option>
                    </select>
                    <p class="help-block">Additional info here</p>
                  </div>
                </div>
                  <button type="button" class="btn btn-success save" onclick="save_Media()" style="float:right;">Save</button>
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
  // E T C

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

  var filtered = [];

  $( document ).ready(function() {
    filter();

    if($('select[name="vehicle_id"] > option').length == 0 || $('select[name="vehicle_id"] > option').length == 0 || $('select[name="tv_id"] > option').length == 0)
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
        .append('<option value=0>NO CITY ON THAT REGION</option>')
        .val(0)
      ;
    }
    else
    {
      $.each(filtered, function(key, value) {   
        $('#vehicle')
          .append($('<option>', { value : value[0] })
          .text(value[1])); 
      });
    }
  }

  $( "#vehicle_type" ).change(function() {
    filter();
  });

  // PAG WALANG RECORD, DAPAT DI MAKAKAGAWA , OR DISABLE SAVE BUTTON OR SMTH
  // console.log($('select[name="vehicle_id"] > option').length);
  // console.log($('select[name="vehicle_id"] > option').length);
  // console.log($('select[name="tv_id"] > option').length);

  // C R E A T E
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
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////

  // END OF USER ADD JAVASCRIPT
</script>