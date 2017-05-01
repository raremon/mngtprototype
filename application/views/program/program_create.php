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
                  <input type="text" class="form-control pull-left" id="reservation">
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

                <div class="row">
                  <div class="container-fluid">
                    <div class="col-md-12">
                      <table id="ad_table_selected_1" class="table table-hover">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Play</th>
                            <th>Ad Title</th>
                            <th>Ad Length</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>   

              </br><button type="submit" class="btn btn-primary" id="button_pos">Save</button>
              <button type="button" class="btn btn-danger" id="button_res1">Reset</button>
            </form>
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
                        <th>Play</th>
                        <th>Ad Title</th>
                        <th>Ad Length</th>
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
                <div class="row">
                  <div class="container-fluid">
                    <div class="col-md-12">
                      <table id="ad_table_selected_2" class="table table-hover">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Play</th>
                            <th>Ad Title</th>
                            <th>Ad Owner</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </br><button type="submit" class="btn btn-primary" id="button_pos">Save</button>
              <button type="button" class="btn btn-danger" id="button_res2">Reset</button>
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
                        <th>Play</th>
                        <th>Ad Title</th>
                        <th>Ad Length</th>
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
                  <div class="col-lg-5">
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
                  <div class="col-lg-5">
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
                       <div class="col-lg-2">
                           </br><button type="submit" class="btn btn-success" id="button_pos">Add Time</button>
                      </div>               
                </div>
              </div>
              <div class="col-md-12">
                <table id="#" class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>CHECKBOX</th>
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
                <div class="row">
                  <div class="container-fluid">
                    <div class="col-md-12">
                      <table id="ad_table_selected_3" class="table table-hover">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Play</th>
                            <th>Ad Title</th>
                            <th>Ad Owner</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </br><button type="submit" class="btn btn-primary" id="button_pos">Save</button>
              <button type="button" class="btn btn-danger" id="button_res3">Reset</button>
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
                        <th>Play</th>
                        <th>Ad Title</th>
                        <th>Ad Owner</th>
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
  // R E A D
  $("#ad_table_1").DataTable({
    "ajax":{
      "url":"<?php echo site_url('program/showAd') ?>",
      "type":"POST",
    },

    "columns": [
      null,
      { "width": "45%" },
      null,
      null,
    ]
  })

  $("#ad_table_2").DataTable({
    "ajax":{
      "url":"<?php echo site_url('program/showAd') ?>",
      "type":"POST"
    },

    "columns": [
      null,
      { "width": "45%" },
      null,
      null,
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
      null,
    ]
  })
  var table1 = $('#ad_table_1').DataTable();
  var table2 = $('#ad_table_selected_1').DataTable();
      $('#ad_table_1 tbody').on( 'click', 'tr', function (){
        if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
        }
        else {
            table1.$('tr.active').removeClass('active');
            $(this).addClass('active');
        }
        $(this).clone().appendTo('#ad_table_selected_1');
        return false;
    });
     $('#button_res1').on('click',function (){
         table2.row('.active').remove().draw( false );
    });
    
  var table3 = $('#ad_table_2').DataTable();
  var table4 = $('#ad_table_selected_2').DataTable();
      $('#ad_table_2 tbody').on( 'click', 'tr', function (){
        if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
        }
        else {
            table3.$('tr.active').removeClass('active');
            $(this).addClass('active');
        }
        $(this).clone().appendTo('#ad_table_selected_2');
        return false;
    });
     $('#button_res2').on('click',function (){
         table4.row('.active').remove().draw( false );
    });
    
  var table5 = $('#ad_table_3').DataTable();
  var table6 = $('#ad_table_selected_3').DataTable();
      $('#ad_table_3 tbody').on( 'click', 'tr', function (){
        if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
        }
        else {
            table5.$('tr.active').removeClass('active');
            $(this).addClass('active');
        }
        $(this).clone().appendTo('#ad_table_selected_3');
        return false;
    });
     $('#button_res3').on('click',function (){
         table6.row('.active').remove().draw( false );
    });
 
</script>