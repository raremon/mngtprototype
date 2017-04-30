<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab_1" data-toggle="tab">Regular</a></li>
    <li><a href="#tab_2" data-toggle="tab">Scheduled</a></li>
    <li><a href="#tab_3" data-toggle="tab">Block Scheduled</a></li>
    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
  </ul>
  <div class="tab-content">

    <div class="tab-pane active" id="tab_1">
      <div class="container-fluid">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Arrange by routes</h3>
            <div class="box-tools pull-right">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class="box-body">
            <div id="regular-message"></div>
            <?php echo form_open('', array('id'=>'regular')); ?>

              <div class="form-group">
                <div class="input-group">
                  <input name="schedule_type_reg" type="text" class="form-control hidden" value="1">
                </div>
              </div> 

              <div class="form-group">
                <label for="route_list">Select Ad Owner:</label>
                <select name="advertiser_id_reg" class="form-control select2" id="advertiser_list_reg">
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
              </div>

              <div class="form-group">
                <label>Select Duration:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="date_reg" type="text" class="form-control pull-left" id="reservation">
                </div>
              </div>    

              <div class="form-group">
                <div class="input-group">
                  <input id="start_1" name="start_reg" type="text" class="form-control hidden">
                </div>
              </div> 
              <div class="form-group">
                <div class="input-group">
                  <input id="end_1" name="end_reg" type="text" class="form-control hidden">
                </div>
              </div> 

              <div class="form-group">
                <label for="route_list">Select Route:</label>
                <select name="route_id_reg" class="form-control select2" id="route_list_reg">
                  <?php 
                    foreach($route as $row)
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
                <div class="row">
                    <div class="col-lg-6">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                            <label>Start Time:</label>
                            <div class="input-group">
                              <input type="text" class="form-control" id="timepicker" disabled>
                              <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                              </div>
                            </div>
                              <span class="help-block">*Regular follows the assigned bus schedule.</span>
                          </div>
                        <!-- /.form group -->
                      </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                            <label>End Time:</label>
                            <div class="input-group">
                              <input type="text" class="form-control" id="timepicker1" disabled>
                              <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                              </div>
                            </div>
                            <!-- /.input group -->
                          </div>
                        <!-- /.form group -->
                      </div>
                    </div>  
                </div>
              </div>

              <span>Selected Ad:</span>

              <div class="form-group">
                <div class="input-group">
                  <input id="selected_ads_1" name="selected_ads_reg" type="text" class="form-control hidden">
                </div>
              </div> 

              <div class="row">
                <div class="container-fluid">
                  <div class="col-md-12">
                    <table id="selected_table_1" class="table table-hover">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>File Name</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              </br><button type="button" class="btn btn-primary" id="button_pos" onclick="save_Regular_Program()">Save</button>
            <?php echo form_close(); ?>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <span>Choose Ad Below:</span>
            <div class="row">
              <div class="container-fluid">
                <div class="col-md-12">
                  <table id="ad_table_1" class="table table-hover">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Thumbnail If Possible</th>
                        <th>Ad Name</th>
                        <th>Video Link</th>
                        <th>Video Length</th>
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
      </div>
    </div>

    <!-- /.tab-pane -->
    <div class="tab-pane" id="tab_2">
      <div class="container-fluid">
        <div class="box">
          <div class="box-header with-border">
              <h3 class="box-title">Arrange by routes</h3>
              <div class="box-tools pull-right">
              <!-- Buttons, labels, and many other things can be placed here! -->
              <!-- Here is a label for example -->
              </div><!-- /.box-tools -->
          </div><!-- /.box-header -->

          <div class="box-body">
            <form role="form">
              <div class="form-group">
                <label for="route_list">Select Ad Owner:</label>
                <select name="advertiser_id" class="form-control select2" id="route_list">
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
              </div>
              <div class="form-group">
                <label>Select Duration:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-left" id="reservation1">
                </div>
              </div>               
              <div class="form-group">
                <label for="route_list">Select Route:</label>
                <select name="route_id" class="form-control select2" id="route_list">
                  <?php 
                    foreach($route as $row)
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
                  <div class="row">
                      <div class="col-lg-6">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                            <label>Start Time:</label>
                            <div class="input-group">
                              <input type="text" class="form-control" id="timepicker2">
                              <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                              </div>
                            </div>
                            <span class="help-block">*Scheduled starts with the given time until the end of bus schedule.</span>
                          </div>
                        <!-- /.form group -->
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                            <label>End Time:</label>
                            <div class="input-group">
                              <input type="text" class="form-control" id="timepicker3" disabled>
                              <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                              </div>
                            </div>
                            <!-- /.input group -->
                          </div>
                          <!-- /.form group -->
                        </div>
                      </div>  
                  </div>
              </div>
              <span>Selected Ad:</span>
              <ul class="margin_fix connectedSortable">
              </ul>
              </br><button type="submit" class="btn btn-primary" id="button_pos">Save</button>
            </form>
          </div><!-- /.box-body -->

          <div class="box-footer">
            <span>Choose Ad Below:</span>
            <div class="row">
              <div class="container-fluid">
                <div class="col-md-12">
                  <table id="ad_table_2" class="table table-hover">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Thumbnail If Possible</th>
                        <th>Video Link</th>
                        <th>Video Length</th>
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
      </div>
    </div>
    <!-- /.tab-pane -->

    <div class="tab-pane" id="tab_3">
      <div class="container-fluid">
        <div class="box">
          <div class="box-header with-border">
              <h3 class="box-title">Arrange by routes</h3>
              <div class="box-tools pull-right">
              <!-- Buttons, labels, and many other things can be placed here! -->
              <!-- Here is a label for example -->
              </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class="box-body">
            <form role="form">
              <div class="form-group">
                <label for="route_list">Select Ad Owner:</label>
                <select name="advertiser_id" class="form-control select2" id="route_list">
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
              </div>
              <div class="form-group">
                <label>Select Duration:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-left" id="reservation2">
                </div>
              </div>               
              <div class="form-group">
                <label for="route_list">Select Route:</label>
                <select name="route_id" class="form-control select2" id="route_list">
                  <?php 
                    foreach($route as $row)
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
                <div class="row">
                  <div class="col-lg-6">
                    <div class="bootstrap-timepicker">
                      <div class="form-group">
                        <label>Start Time:</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="timepicker4">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                        <span class="help-block">*Block will play the ads within the given time.</span>
                      </div>
                      <!-- /.form group -->
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="bootstrap-timepicker">
                      <div class="form-group">
                        <label>End Time:</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="timepicker5">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                        <!-- /.input group -->
                      </div>
                      <!-- /.form group -->
                    </div>
                  </div>  
                </div>
              </div>
              <div class="col-md-12">
                <table id="#" class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>START TIME</th>
                      <th>END TIME</th>
                      <th>EDIT/DELETE</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <span>Selected Ad:</span>
              <ul class="margin_fix connectedSortable">
              </ul>
              </br><button type="submit" class="btn btn-primary" id="button_pos">Save</button>
            </form>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <span>Choose Ad Below:</span>
            <div class="row">
              <div class="container-fluid">
                <div class="col-md-12">
                  <table id="ad_table_3" class="table table-hover">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Thumbnail If Possible</th>
                        <th>Video Link</th>
                        <th>Video Length</th>
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
      </div>
    </div>
    <!-- /.tab-pane -->
  </div>
  <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->

<script type="text/javascript">

  ///////////////////////////////////////////////////////////////////////////////////////
  //          R  E  G  U  L  A  R    C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ///////////////////////////////////////////////////////////////////////////////////////

  // C R E A T E
  function save_Regular_Program() {
    $.ajax({
      url: "<?php echo site_url('program/saveRegularProgram') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#regular').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $('#regular-message').html(data.errors).addClass('alert alert-danger');
          }
        }else {
          $('#regular-message').html(data.message).addClass('alert alert-success').removeClass('alert alert-danger');
          // setTimeout(function() {
          //   window.location.reload()
          // }, 1000);
        }
      }
    })
  }

  // // R E A D
  // $("#user_data").DataTable({
  //   "ajax":{
  //     "url":"<?php echo site_url('users/showUser') ?>",
  //     "type":"POST"
  //   }
  // })

  // // U P D A T E
  // function edit_user(user_id) {
  //   $.ajax({
  //     url: "<?php echo site_url('users/editUser') ?>",
  //     type: 'POST',
  //     dataType: 'json',
  //     data: 'user_id='+user_id,
  //     encode:true,
  //     success:function (data) {
  //       $('.save').attr('disabled', true);
  //       $('.update').removeAttr('disabled');
  //       $('input[name="user_id"]').val(data.user_id);
  //       $('input[name="user_fname"]').val(data.user_fname);
  //       $('input[name="user_lname"]').val(data.user_lname);
  //       $('select[name="user_role"]').val(data.user_role);
  //       $('input[name="user_name"]').val(data.user_name);
  //     }
  //   })
  // }

  // function update_User() {
  //   $.ajax({
  //     url: "<?php echo site_url('users/updateUser') ?>",
  //     type: 'POST',
  //     dataType: 'json',
  //     data: $('#user').serialize(),
  //     encode:true,
  //     success:function (data) {
  //       if(!data.success){
  //         $('#user-message').html(data.errors).addClass('alert alert-danger');
  //       }else {
  //         $('#user-message').html(data.message).addClass('alert alert-success').removeClass('alert alert-danger');
  //         setTimeout(function () {
  //           window.location.reload();
  //         }, 1000);
  //       }
  //     }
  //   })
  // }

  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////

  ///////////////////////////////////////////////
  // F I R S T   T A B L E   D A T A T A B L E //
  ///////////////////////////////////////////////
  
  $( document ).ready(function() {
    $('#start_1').val($("input[name='date_reg']").val().split(' - ')[0]);
    $('#end_1').val($("input[name='date_reg']").val().split(' - ')[1]);
    $("input[name='date_reg']").change(function() {
      $('#start_1').val($("input[name='date_reg']").val().split(' - ')[0]);
      $('#end_1').val($("input[name='date_reg']").val().split(' - ')[1]);
    });

    var selected = $('#advertiser_list_reg').val();
    $("#ad_table_1").DataTable({
      ajax:{
        url:"<?php echo site_url('program/showAdReg/" + selected + "') ?>",
        type:"POST",
      },

      "columns": [
        null,
        null,
        null,
        null,
        null,
        null,
      ]
    })

    $("#selected_table_1").DataTable({
    })

    $("#advertiser_list_reg").change(function() {
      var advertiser = $('#advertiser_list_reg').val();
      $('#selected_table_1').dataTable().fnClearTable();
      $("#selected_ads_1").val('');
      $.get("<?php echo site_url('program/showAdReg/" + advertiser + "') ?>", function(data){
        var ads_tbl_1 = $.map(data, function(el) { return el; });
        $('#ad_table_1').dataTable().fnClearTable();
        $('#ad_table_1').dataTable().fnAddData(ads_tbl_1);
      });    
    });
  });

  

  var selected_table_1 = [];
  var selected_id_1 = [];
  function get_ad(ad_id) {
    $.get("<?php echo site_url('program/appendAd/" + ad_id + "') ?>", function(data){
      var basic = $.map(data, function(el) { return el; });
      selected_table_1.push(basic[0]);
      selected_id_1.push(basic[0][0]);
      $('#selected_table_1').dataTable().fnClearTable();
      $('#selected_table_1').dataTable().fnAddData(selected_table_1);
      $("#selected_ads_1").val(JSON.stringify(selected_id_1));
    }); 
  }

  function remove_ad(ad_id) {
    var ctr = 0;
    var confirm = false;
    while( !confirm )
    {
      if(selected_table_1[ctr][0] == ad_id)
      {
        selected_table_1.splice(ctr, 1);
        selected_id_1.splice(ctr, 1);
        confirm = true;
      }
      else
      {
        ctr++;
      }
    }
    $('#selected_table_1').dataTable().fnClearTable();
    if(selected_table_1.length > 0)
    {
      $('#selected_table_1').dataTable().fnAddData(selected_table_1);
      $("#selected_ads_1").val(JSON.stringify(selected_id_1));
    }
    else
    {
      $("#selected_ads_1").val('');
    }
  }
  /////////////////////////////////////////////////////////////
  // E N D   O F   F I R S T   T A B L E   D A T A T A B L E //
  /////////////////////////////////////////////////////////////


  $("#ad_table_2").DataTable({
    "ajax":{
      "url":"<?php echo site_url('program/showAd') ?>",
      "type":"POST"
    },

    "columns": [
      null,
      { "width": "45%" },
      null,
      null
    ]
  })

  $("#ad_table_3").DataTable({
    "ajax":{
      "url":"<?php echo site_url('program/showAd') ?>",
      "type":"POST"
    },

    "columns": [
      null,
      { "width": "45%" },
      null,
      null
    ]
  })

</script>