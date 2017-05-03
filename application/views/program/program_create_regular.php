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

              <!-- SCHEDULE TYPE REGULAR -->
              <div class="form-group">
                <div class="input-group">
                  <input name="schedule_type_reg" type="text" class="form-control hidden" value="1">
                </div>
              </div> 

              <!-- ADVERTISER ID REGULAR -->
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

              <!-- DATE START REGULAR -->
              <div class="form-group">
                <div class="input-group">
                  <input id="start_1" name="start_reg" type="text" class="form-control hidden">
                </div>
              </div> 
              <!-- DATE END REGULAR -->
              <div class="form-group">
                <div class="input-group">
                  <input id="end_1" name="end_reg" type="text" class="form-control hidden">
                </div>
              </div> 

              <!-- ROUTE ID REGULAR -->
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
                          </div>
                      </div>
                    </div>  
                </div>
              </div>

              <span>Selected Ad:</span>

              <!-- SELECTED ADS REGULAR -->
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

                        <th>Play</th>

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
          </div>
        </div>
      </div>
    </div>

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

              $(window).scrollTop(0);

              $("#regular-message").fadeIn("slow");
              $('#regular-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#regular-message').fadeOut('slow');
              }, 3000);

              
            }
          }else {
              $(window).scrollTop(0);

              $("#regular-message").fadeIn("slow");
              $('#regular-message').html(data.message).addClass('alert alert-success').removeClass('alert-danger');
              setTimeout(function() {
                  $('#regular-message').fadeOut('slow');

                  window.location.reload();
              }, 2000);

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

    </script>