    <div class="tab-pane" id="tab_2">
      <div class="container-fluid">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Arrange by routes</h3>
            <div class="box-tools pull-right">
            </div>
          </div>
          <div class="box-body">
            <div id="schedule-message"></div>
            <?php echo form_open('', array('id'=>'schedule')); ?>

              <!-- SCHEDULE TYPE SCHEDULED -->
              <div class="form-group">
                <div class="input-group">
                  <input name="schedule_type_sched" type="text" class="form-control hidden" value="2">
                </div>
              </div> 

              <!-- ADVERTISER ID SCHEDULED -->
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

              <!-- DATE START SCHEDULED -->
              <div class="form-group">
                <div class="input-group">
                  <input id="start_2" name="start_sched" type="text" class="form-control hidden">
                </div>
              </div> 
              <!-- DATE END SCHEDULED -->
              <div class="form-group">
                <div class="input-group">
                  <input id="end_2" name="end_sched" type="text" class="form-control hidden">
                </div>
              </div> 

              <!-- ROUTE ID SCHEDULED -->
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

              <!-- AIRTIME SCHEDULED -->
              <div class="form-group">
                <label>Airtime:</label>
                <div class="input-group">
                  <input id="airtime_2" type="text" class="form-control">
                  <input id="airtime_replicate_2" name="airtime_sched" type="text" class="form-control hidden">
                </div>
              </div> 

              <div class="form-group">
                  <div class="row">
                      <div class="col-lg-6">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                            <label>Start Time:</label>
                            <div class="input-group">
                              <!-- START TIME SCHEDULED -->
                              <input type="text" class="form-control timepicker" id="timepicker2" name="start_time_sched">
                              <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                              </div>
                            </div>
                            <span class="help-block">*Scheduled starts with the given time until the end of bus schedule.</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                            <label>End Time:</label>
                            <div class="input-group">
                              <input type="text" class="form-control timepicker" id="timepicker3" name="end_time_sched" disabled>
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

              <!-- SELECTED ADS SCHEDULED -->
              <div class="form-group">
                <div class="input-group">
                  <input id="selected_ads_2" name="selected_ads_sched" type="text" class="form-control hidden">
                </div>
              </div> 

              <!-- TOTAL DURATION REGULAR -->
              <div class="form-group">
                <div class="input-group">
                  <input name="schedule_duration_sched" id="selected_duration_2" type="text" class="form-control hidden">
                </div>
              </div> 

              <div>
                <h3>TOTAL DURATION: <span id="totalduration"></span></h3>  
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
                          <th>Duration</th>
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
          </div>

          <div class="box-footer">
            <span>Choose Ad Below:</span>
            <div class="row">
              <div class="container-fluid">
                <div class="col-md-12">
                  <table id="ad_table_2" class="table table-hover" width="100%">
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
                $(window).scrollTop(0);
                $("#schedule-message").fadeIn("slow");
                $('#schedule-message').html(data.errors).addClass('alert alert-danger');
                setTimeout(function() {
                    $('#schedule-message').fadeOut('slow');
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
      /////////////////////////////////////////////////
      // S E C O N D   T A B L E   D A T A T A B L E //
      /////////////////////////////////////////////////
      var airtime_2 = 0;
      var hour_2 = 0;
      var minute_2 = 0;
      var second_2 = 0;
      $( document ).ready(function() {
        $("#totalduration").html('No ads selected!');
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
          $('#selected_duration_2').val('');
          $("#totalduration").html($("#selected_duration_2").val());
          selected_table_2 = [];
          selected_id_2 = [];
          selected_duration_2 = [];
          $.get("<?php echo site_url('program/showAdSched/" + advertiser + "') ?>", function(data){
            var ads_tbl_2 = $.map(data, function(el) { return el; });
            $('#ad_table_2').dataTable().fnClearTable();
            if(ads_tbl_2.length > 0)
            {
              $('#ad_table_2').dataTable().fnAddData(ads_tbl_2);
            }
          });    
        });

        $("#airtime_2").keyup(function() {
          if($('#airtime_2').val() != '')
          {
            airtime_2 = parseInt($("#airtime_2").val());
          }
          else
          {
            airtime_2 = 0;
          }
          $("#airtime_replicate_2").val(airtime_2);
          computeEndTime();
        });

        $("#timepicker2").keyup(function(){
          if($('#timepicker2').val() != '')
          {
            var timepicked = ($('#timepicker2').val()).split(":");
            hour_2 = parseInt(timepicked[0]);
            minute_2 = parseInt(timepicked[1]);
            second_2 = parseInt(timepicked[2]);
          }
          else
          {
            hour_2 = 0;
            minute_2 = 0;
            second_2 = 0;
          }
          computeEndTime();
        });
      });

      var selected_duration_2 = [];
      var selected_table_2 = [];
      var selected_id_2 = [];
      function get_ad_sched(ad_id) {
        if(!find_ad_sched(ad_id))
        {
          if($('#airtime_2').val() != '')
          {
            $.get("<?php echo site_url('program/appendAdSched/" + ad_id + "') ?>", function(data){
              var basic = $.map(data, function(el) { return el; });
              if((durationSumSched() + parseInt((basic[0][3].split(" "))[0]))>airtime_2)
              {
                $('#error-text').html("Not Enough Airtime");
                $('#errorModal').modal('show');
              }
              else
              {
                selected_table_2.push(basic[0]);
                selected_id_2.push(basic[0][0]);
                selected_duration_2.push(parseInt((basic[0][3].split(" "))[0]));
                $('#selected_duration_2').val(durationSumSched());
                $('#selected_table_2').dataTable().fnClearTable();
                $('#selected_table_2').dataTable().fnAddData(selected_table_2);
                $("#totalduration").html($("#selected_duration_2").val());
                $("#selected_ads_2").val(JSON.stringify(selected_id_2));
                $("#airtime_2").prop('disabled', true);
              }
            }); 
          }
          else
          {
            $('#error-text').html("Please set airtime first");
            $('#errorModal').modal('show');
          }
        }
        else
        {
          $('#error-text').html("Ad Already Selected !");
          $('#errorModal').modal('show');
        }
      }

      function computeEndTime() {
        if(isNaN(hour_2)||isNaN(minute_2)||isNaN(second_2)||$('#timepicker2').val() == '')
        {
          $('#timepicker3').val("");
        }
        else
        {
          var hour = hour_2;
          var minute = minute_2;
          var second = second_2 + airtime_2;

          while(second>60)
          {
            second = second - 60;
            minute = minute + 1;
            if(minute>60)
            {
              minute = minute - 60;
              hour = hour + 1;
              if(hour>24)
              {
                hour = hour-24;
              }
            }
          }
          if(second<10)
          {
            second = second.toString();
            second = "0"+second;
          }
          else
          {
            second = second.toString();
          }
          if(minute<10)
          {
            minute = minute.toString();
            minute = "0"+minute;
          }
          else
          {
            minute = minute.toString();
          }
          if(hour<10)
          {
            hour = hour.toString();
            hour = "0"+hour;
          }
          else
          {
            hour = hour.toString();
          }
          $('#timepicker3').val(hour+":"+minute+":"+second);
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
            selected_duration_2.splice(ctr, 1);
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
          $('#selected_duration_2').val(durationSumSched());
          $("#totalduration").html($("#selected_duration_2").val());
        }
        else
        {
          $("#selected_ads_2").val('');
          $('#selected_duration_2').val('');
          $("#totalduration").html('No ads selected!');
          $("#airtime_2").prop('disabled', false);
        }
      }
      function durationSumSched() {
        var sum = 0;
        for(var a = 0; a < selected_duration_2.length; a++)
        {
          sum = sum + selected_duration_2[a];
        }
        return sum;
      }
      ///////////////////////////////////////////////////////////////
      // E N D   O F   S E C O N D   T A B L E   D A T A T A B L E //
      ///////////////////////////////////////////////////////////////
    </script>