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
                <label for="advertiser_list_reg">Select Ad Owner:</label>
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
                <label for="route_list_reg">Select Route:</label>
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
                    <table id="selected_table_1" class="table table-hover" width="100%">
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
                  <table id="ad_table_1" class="table table-hover" width="100%">
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
            <div id="schedule-message"></div>
            <?php echo form_open('', array('id'=>'schedule')); ?>

              <div class="form-group">
                <div class="input-group">
                  <input name="schedule_type_sched" type="text" class="form-control hidden" value="2">
                </div>
              </div> 

              <div class="form-group">
                <label for="advertiser_list_sched">Select Ad Owner:</label>
                <select name="advertiser_id_sched" class="form-control select2" id="advertiser_list_sched">
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
                  <input name="date_sched" type="text" class="form-control pull-left" id="reservation1">
                </div>
              </div>    

              <div class="form-group">
                <div class="input-group">
                  <input id="start_2" name="start_sched" type="text" class="form-control hidden">
                </div>
              </div> 
              <div class="form-group">
                <div class="input-group">
                  <input id="end_2" name="end_sched" type="text" class="form-control hidden">
                </div>
              </div> 

              <div class="form-group">
                <label for="route_list_sched">Select Route:</label>
                <select name="route_id_sched" class="form-control select2" id="route_list_sched">
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
                              <input type="text" class="form-control" id="timepicker2" name="start_time_sched">
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

              <div class="form-group">
                <div class="input-group">
                  <input id="selected_ads_2" name="selected_ads_sched" type="text" class="form-control hidden">
                </div>
              </div> 

              <div class="row">
                <div class="container-fluid">
                  <div class="col-md-12">
                    <table id="selected_table_2" class="table table-hover" width="100%">
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

              </br><button type="button" class="btn btn-primary" id="button_pos_2" onclick="save_Schedule_Program()">Save</button>
            <?php echo form_close(); ?>
          </div><!-- /.box-body -->

          <div class="box-footer">
            <span>Choose Ad Below:</span>
            <div class="row">
              <div class="container-fluid">
                <div class="col-md-12">
                  <table id="ad_table_2" class="table table-hover" width="100%">
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

    <div class="tab-pane" id="tab_3">
      <div class="container-fluid">
        <div class="box">
          <div class="box-header with-border">
              <h3 class="box-title">Arrange by routes</h3>
              <div class="box-tools pull-right">
              </div><!-- /.box-tools -->
          </div><!-- /.box-header -->

          <div class="box-body">
            <div id="block-message"></div>
            <?php echo form_open('', array('id'=>'block')); ?>

              <div class="form-group">
                <div class="input-group">
                  <input name="schedule_type_block" type="text" class="form-control hidden" value="3">
                </div>
              </div> 

              <div class="form-group">
                <label for="advertiser_list_block">Select Ad Owner:</label>
                <select name="advertiser_id_block" class="form-control select2" id="advertiser_list_block">
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
                  <input name="date_block" type="text" class="form-control pull-left" id="reservation2">
                </div>
              </div>    

              <div class="form-group">
                <div class="input-group">
                  <input id="start_3" name="start_block" type="text" class="form-control">
                </div>
              </div> 
              <div class="form-group">
                <div class="input-group">
                  <input id="end_3" name="end_block" type="text" class="form-control">
                </div>
              </div> 

              <div class="form-group">
                <label for="route_list_block">Select Route:</label>
                <select name="route_id_block" class="form-control select2" id="route_list_block">
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
                          <input type="text" class="form-control" id="timepicker4" name="start_time_block">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                        <span class="help-block">*Block will play the ads within the given time.</span>
                      </div>
                      <!-- /.form group -->
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="bootstrap-timepicker">
                      <div class="form-group">
                        <label>End Time:</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="timepicker5" name="end_time_block">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                        <!-- /.input group -->
                      </div>
                      <!-- /.form group -->
                    </div>
                  </div>
                  <div class="col-lg-1">
                    <button type="button" class="btn btn-success pull-right" id="button_pos_3" onclick="addBlock()">Add</button>
                  </div>  
                </div>
              </div>

              <div class="col-md-12">
                <table id="timeBlocks" class="table table-hover table-bordered" >
                  <thead>
                    <tr>
                      <th>START TIME</th>
                      <th>END TIME</th>
                      <th>EDIT/DELETE</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <input id="start_block" name="start_time_block" type="text" class="form-control">
                </div>
              </div> 

              <div class="form-group">
                <div class="input-group">
                <input id="all_block" name="all_time_block" type="text" class="form-control">
                </div>
              </div> 

              <div class="form-group">
                <div class="input-group">
                  <input id="end_block" name="end_time_block" type="text" class="form-control">
                </div>
              </div> 

              <span>Selected Ad:</span>
              <div class="form-group">
                <div class="input-group">
                  <input id="selected_ads_3" name="selected_ads_block" type="text" class="form-control">
                </div>
              </div> 

              <div class="row">
                <div class="container-fluid">
                  <div class="col-md-12">
                    <table id="selected_table_3" class="table table-hover" width="100%">
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

              </br><button type="button" class="btn btn-primary" id="button_pos_3" onclick="save_Block_Program()">Save</button>
            <?php echo form_close(); ?>
          </div><!-- /.box-body -->

          <div class="box-footer">
            <span>Choose Ad Below:</span>
            <div class="row">
              <div class="container-fluid">
                <div class="col-md-12">
                  <table id="ad_table_3" class="table table-hover" width="100%">
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
  </div>
  <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->

<script type="text/javascript">

  ///////////////////////////////////////////////////////////////////////////////////////
  //                     C  R  U  D    F  U  N  C  T  I  O  N  S                       //
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
            $("#regular-message").fadeIn("slow");
            $('#regular-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#regular-message').fadeOut('slow');
            }, 3000);
          }
        }else {
            $("#regular-message").fadeIn("slow");
            $('#regular-message').html(data.message).addClass('alert alert-success').removeClass('alert-danger');
            setTimeout(function() {
                $('#regular-message').fadeOut('slow');
            }, 3000);
        }
      }
    })
  }

  function save_Schedule_Program() {
    $.ajax({
      url: "<?php echo site_url('program/saveScheduleProgram') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#schedule').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $("#schedule-message").fadeIn("slow");
            $('#schedule-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#schedule-message').fadeOut('slow');
            }, 3000);
          }
        }else {
            $("#schedule-message").fadeIn("slow");
            $('#schedule-message').html(data.message).addClass('alert alert-success').removeClass('alert-danger');
            setTimeout(function() {
                $('#schedule-message').fadeOut('slow');
            }, 3000);
        }
      }
    })
  }

  function save_Block_Program() {
    $.ajax({
      url: "<?php echo site_url('program/saveBlockProgram') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#block').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $("#block-message").fadeIn("slow");
            $('#block-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#block-message').fadeOut('slow');
            }, 3000);
          }
        }else {
            $("#block-message").fadeIn("slow");
            $('#block-message').html(data.message).addClass('alert alert-success').removeClass('alert-danger');
            setTimeout(function() {
                $('#block-message').fadeOut('slow');
            }, 3000);
        }
      }
    })
  }
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
      selected_table_1 = [];
      selected_id_1 = [];
      $.get("<?php echo site_url('program/showAdReg/" + advertiser + "') ?>", function(data){
        var ads_tbl_1 = $.map(data, function(el) { return el; });
        $('#ad_table_1').dataTable().fnClearTable();
        if(ads_tbl_1.length > 0)
        {
          $('#ad_table_1').dataTable().fnAddData(ads_tbl_1);
        }
      });    
    });
  });

  var selected_table_1 = [];
  var selected_id_1 = [];
  function get_ad(ad_id) {
    if(!find_ad(ad_id))
    {
      $.get("<?php echo site_url('program/appendAd/" + ad_id + "') ?>", function(data){
        var basic = $.map(data, function(el) { return el; });
        selected_table_1.push(basic[0]);
        selected_id_1.push(basic[0][0]);
        $('#selected_table_1').dataTable().fnClearTable();
        $('#selected_table_1').dataTable().fnAddData(selected_table_1);
        $("#selected_ads_1").val(JSON.stringify(selected_id_1));
      }); 
    }
    else
    {
      alert("Ad Already Selected !");
    }
  }

  function find_ad(ad_id) {
    var confirm = false;

    for(var a = 0; a < selected_table_1.length ; a++)
    {
      if(selected_table_1[a][0] == ad_id)
      {
        confirm = true;
      }
    }
    return confirm;
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

  /////////////////////////////////////////////////
  // S E C O N D   T A B L E   D A T A T A B L E //
  /////////////////////////////////////////////////
  $( document ).ready(function() {
    $('#start_2').val($("input[name='date_sched']").val().split(' - ')[0]);
    $('#end_2').val($("input[name='date_sched']").val().split(' - ')[1]);
    $("input[name='date_sched']").change(function() {
      $('#start_2').val($("input[name='date_sched']").val().split(' - ')[0]);
      $('#end_2').val($("input[name='date_sched']").val().split(' - ')[1]);
    });

    var selected2 = $('#advertiser_list_sched').val();
    $("#ad_table_2").DataTable({
      ajax:{
        url:"<?php echo site_url('program/showAdSched/" + selected2 + "') ?>",
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

    $("#selected_table_2").DataTable({
    })

    $("#advertiser_list_sched").change(function() {
      var advertiser = $('#advertiser_list_sched').val();
      $('#selected_table_2').dataTable().fnClearTable();
      $("#selected_ads_2").val('');
      selected_table_2 = [];
      selected_id_2 = [];
      $.get("<?php echo site_url('program/showAdSched/" + advertiser + "') ?>", function(data){
        var ads_tbl_2 = $.map(data, function(el) { return el; });
        $('#ad_table_2').dataTable().fnClearTable();
        if(ads_tbl_2.length > 0)
        {
          $('#ad_table_2').dataTable().fnAddData(ads_tbl_2);
        }
      });    
    });
  });

  var selected_table_2 = [];
  var selected_id_2 = [];
  function get_ad_sched(ad_id) {
    if(!find_ad_sched(ad_id))
    {
      $.get("<?php echo site_url('program/appendAdSched/" + ad_id + "') ?>", function(data){
        var basic = $.map(data, function(el) { return el; });
        selected_table_2.push(basic[0]);
        selected_id_2.push(basic[0][0]);
        $('#selected_table_2').dataTable().fnClearTable();
        $('#selected_table_2').dataTable().fnAddData(selected_table_2);
        $("#selected_ads_2").val(JSON.stringify(selected_id_2));
      }); 
    }
    else
    {
      alert("Ad Already Selected !");
    }
  }

  function find_ad_sched(ad_id) {
    var confirm = false;

    for(var a = 0; a < selected_table_2.length ; a++)
    {
      if(selected_table_2[a][0] == ad_id)
      {
        confirm = true;
      }
    }
    return confirm;
  }

  function remove_ad_sched(ad_id) {
    var ctr = 0;
    var confirm = false;
    while( !confirm )
    {
      if(selected_table_2[ctr][0] == ad_id)
      {
        selected_table_2.splice(ctr, 1);
        selected_id_2.splice(ctr, 1);
        confirm = true;
      }
      else
      {
        ctr++;
      }
    }
    $('#selected_table_2').dataTable().fnClearTable();
    if(selected_table_2.length > 0)
    {
      $('#selected_table_2').dataTable().fnAddData(selected_table_2);
      $("#selected_ads_2").val(JSON.stringify(selected_id_2));
    }
    else
    {
      $("#selected_ads_2").val('');
    }
  }
  ///////////////////////////////////////////////////////////////
  // E N D   O F   S E C O N D   T A B L E   D A T A T A B L E //
  ///////////////////////////////////////////////////////////////

  ///////////////////////////////////////////////
  // T H I R D   T A B L E   D A T A T A B L E //
  ///////////////////////////////////////////////
  $( document ).ready(function() {
    // Data of date
    $('#start_3').val($("input[name='date_block']").val().split(' - ')[0]);
    $('#end_3').val($("input[name='date_block']").val().split(' - ')[1]);
    $("input[name='date_block']").change(function() {
      $('#start_3').val($("input[name='date_block']").val().split(' - ')[0]);
      $('#end_3').val($("input[name='date_block']").val().split(' - ')[1]);
    });

    // Selected Advertiser
    var selected3 = $('#advertiser_list_block').val();

    // Table of Time Blocks
    $("#timeBlocks").DataTable({
    })

    // Ad Table
    $("#ad_table_3").DataTable({
      ajax:{
        url:"<?php echo site_url('program/showAdBlock/" + selected3 + "') ?>",
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

    // Selected Ads Table
    $("#selected_table_3").DataTable({
    })

    // When Advertiser is Changed, Adapt the page
    $("#advertiser_list_block").change(function() {
      var advertiser = $('#advertiser_list_block').val();
      $('#selected_table_3').dataTable().fnClearTable();
      $("#selected_ads_3").val('');
      $('#selected_block').val("");
      selected_table_3 = [];
      selected_id_3 = [];
      $.get("<?php echo site_url('program/showAdBlock/" + advertiser + "') ?>", function(data){
        var ads_tbl_3 = $.map(data, function(el) { return el; });
        $('#ad_table_3').dataTable().fnClearTable();
        if(ads_tbl_3.length > 0)
        {
          $('#ad_table_3').dataTable().fnAddData(ads_tbl_3);
        }
      });     
    });
  });

  // Adding Blocks
  var counter = 0;
  var ctrs = [];
  var time_block = [];
  var start_block = [];
  var end_block = [];
  function addBlock() {
    var start_time = $('#timepicker4').val();
    var end_time = $('#timepicker5').val();
    if(compare_time_block(start_time, end_time))
      {
      console.log(start_time+" "+end_time);
      console.log(time_block.length);
      time_block.push([
        start_time, 
        end_time,
        '<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="remove_time_block('+"'"+counter+"'"+')">Remove</a>',
      ]);

      start_block.push(start_time);
      end_block.push(end_time);
      ctrs.push(counter);
      counter++;
      $('#timeBlocks').dataTable().fnClearTable();
      if(time_block.length > 0)
      {
        $('#timeBlocks').dataTable().fnAddData(time_block);
        $("#start_block").val(JSON.stringify(start_block));
        $("#end_block").val(JSON.stringify(end_block));
        $("#all_block").val(JSON.stringify(time_block));
      }
      else
      {
        $("#start_block").val("");
        $("#end_block").val(""); 
        $("#all_block").val("");  
      }
    }
    else
    {
      alert("Time Error Restrictions");
    }
  }

  // Deleting Blocks
  function remove_time_block(counter_num) {
    var ctr = 0;
    var confirm = false;
    while( !confirm )
    {
      if(ctrs[ctr] == counter_num)
      {
        time_block.splice(ctr, 1);
        start_block.splice(ctr, 1);
        end_block.splice(ctr, 1);
        ctrs.splice(ctr, 1);
        confirm = true;
      }
      else
      {
        ctr++;
      }
    }
    $('#timeBlocks').dataTable().fnClearTable();
    if(time_block.length > 0)
    {
      $('#timeBlocks').dataTable().fnAddData(time_block);
      $("#start_block").val(JSON.stringify(start_block));
      $("#end_block").val(JSON.stringify(end_block));
      $("#all_block").val(JSON.stringify(time_block));
    }
    else
    {
      $("#start_block").val("");
      $("#end_block").val("");  
      $("#all_block").val("");   
    }
  }

  // Compare Time Blocks to avoid overlapping restrictions
  function compare_time_block(start, end) {
    var t = new Date();
    d = t.getDate();
    m = t.getMonth() + 1;
    y = t.getFullYear();

    var o1 = new Date(m + " " + d + " " + y + " " + start);
    var o2 = new Date(m + " " + d + " " + y + " " + end);

    var d1;
    var d2;

    if(o1.getTime()>=o2.getTime())
    {
      return false;
    }
    
    for(var a = 0; a < ctrs.length; a++)
    {
      d1 = new Date(m + " " + d + " " + y + " " + start_block[a]);
      d2 = new Date(m + " " + d + " " + y + " " + end_block[a]);
      if(o1.getTime()==d1.getTime() && o2.getTime()==d2.getTime())
      {
        return false;
      }
      if(o1.getTime()>d1.getTime())
      {
        if(o1.getTime()<d2.getTime())
        {
          return false;
        }
      }
      if(o2.getTime()>d1.getTime())
      {
        if(o2.getTime()<d2.getTime())
        {
          return false;
        }
      }
    }
    return true;
  }

  // Adding advertisments to selected
  var selected_table_3 = [];
  var selected_id_3 = [];
  function get_ad_block(ad_id) {
    if(!find_ad_block(ad_id))
    {
      $.get("<?php echo site_url('program/appendAdBlock/" + ad_id + "') ?>", function(data){
        var basic = $.map(data, function(el) { return el; });
        selected_table_3.push(basic[0]);
        selected_id_3.push(basic[0][0]);
        $('#selected_table_3').dataTable().fnClearTable();
        $('#selected_table_3').dataTable().fnAddData(selected_table_3);
        $("#selected_ads_3").val(JSON.stringify(selected_id_3));
      });
    }
    else
    {
      alert("Ad Already Selected !");
    }
  }

  // Finding Ad Blocks to avoid restrictions
  function find_ad_block(ad_id) {
    var confirm = false;

    for(var a = 0; a < selected_table_3.length ; a++)
    {
      if(selected_table_3[a][0] == ad_id)
      {
        confirm = true;
      }
    }
    return confirm;
  }

  // Remove Ad Block
  function remove_ad_block(ad_id) {
    var ctr = 0;
    var confirm = false;
    while( !confirm )
    {
      if(selected_table_3[ctr][0] == ad_id)
      {
        selected_table_3.splice(ctr, 1);
        selected_id_3.splice(ctr, 1);
        confirm = true;
      }
      else
      {
        ctr++;
      }
    }
    $('#selected_table_3').dataTable().fnClearTable();
    if(selected_table_3.length > 0)
    {
      $('#selected_table_3').dataTable().fnAddData(selected_table_3);
      $("#selected_ads_3").val(JSON.stringify(selected_id_3));
    }
    else
    {
      $("#selected_ads_3").val('');
    }
  }

  /////////////////////////////////////////////////////////////
  // E N D   O F   T H I R D   T A B L E   D A T A T A B L E //
  /////////////////////////////////////////////////////////////

</script>