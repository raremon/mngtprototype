    <div class="tab-pane" id="tab_3">
      <div class="container-fluid">
        <div class="box">
          <div class="box-header with-border">
              <h3 class="box-title">Arrange by routes</h3>
              <div class="box-tools pull-right">
              </div>
          </div>

          <div class="box-body">
            <div id="block-message"></div>
            <?php echo form_open('', array('id'=>'block')); ?>
              <!-- SCHEDULE TYPE BLOCK -->
              <div class="form-group">
                <div class="input-group">
                  <input name="schedule_type_block" type="text" class="form-control hidden" value="3">
                </div>
              </div> 

              <!-- ADVERTISER ID BLOCK -->
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

              <!-- START DATE BLOCK -->
              <div class="form-group">
                <div class="input-group">
                  <input id="start_3" name="start_block" type="text" class="form-control hidden">
                </div>
              </div> 
              <!-- END DATE BLOCK -->
              <div class="form-group">
                <div class="input-group">
                  <input id="end_3" name="end_block" type="text" class="form-control hidden">
                </div>
              </div> 

              <!-- ROUTE ID BLOCK -->
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
                          <!-- START TIME BLOCK -->
                          <input type="text" class="form-control" id="timepicker4" name="start_time_block">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                        <span class="help-block">*Block will play the ads within the given time.</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="bootstrap-timepicker">
                      <div class="form-group">
                        <label>End Time:</label>
                        <div class="input-group">
                          <!-- END TIME BLOCK -->
                          <input type="text" class="form-control" id="timepicker5" name="end_time_block">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                      </div>
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

              <!-- START BLOCK // CONTAINS START TIME -->
              <div class="form-group">
                <div class="input-group">
                  <input id="start_block" name="start_time_block" type="text" class="form-control hidden">
                </div>
              </div> 
              <!-- ALL BLOCK // CONTAINS START TIME | END TIME -->
              <div class="form-group">
                <div class="input-group">
                <input id="all_block" name="all_time_block" type="text" class="form-control hidden">
                </div>
              </div> 
              <!-- END BLOCK // CONTAINS END TIME -->
              <div class="form-group">
                <div class="input-group">
                  <input id="end_block" name="end_time_block" type="text" class="form-control hidden">
                </div>
              </div> 

              <!-- SELECTED TIME BLOCK -->
              <span>Selected Ad:</span>
              <div class="form-group">
                <div class="input-group">
                  <input id="selected_ads_3" name="selected_ads_block" type="text" class="form-control hidden">
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
          </div>

          <div class="box-footer">
            <span>Choose Ad Below:</span>
            <div class="row">
              <div class="container-fluid">
                <div class="col-md-12">
                  <table id="ad_table_3" class="table table-hover" width="100%">
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

                $(window).scrollTop(0);

                $("#block-message").fadeIn("slow");
                $('#block-message').html(data.errors).addClass('alert alert-danger');
                setTimeout(function() {
                    $('#block-message').fadeOut('slow');
                }, 3000);
              }
            }else {

                $(window).scrollTop(0);

                $("#block-message").fadeIn("slow");
                $('#block-message').html(data.message).addClass('alert alert-success').removeClass('alert-danger');
                setTimeout(function() {
                    $('#block-message').fadeOut('slow');

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