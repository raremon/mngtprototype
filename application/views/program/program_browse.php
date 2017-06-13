<div class="modal fade" id="byAdvertiserModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Program Listing</h4>
      </div>

      <div class="modal-body">
       <div class="container-fluid">
         <div class="col-md-12">
              <div class="form-group">
                <label for="route_list">Route:</label>
                <select id="route_id" name="route_id" class="form-control select2" style="width:100%;">
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
                <a class="btn btn-link pull-right" href="<?php echo site_url('routes/add') ?>">New Route</a>
              </div>  
            <div class="form-group">
            <label>Timeslot:</label>
            <input id="timeslot_form" type="text" class="form-control" id="" readonly>
            </div>
            <div class="form-group">
            <label>Airing Dates:</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input name="date_reg" type="text" class="form-control pull-left" id="reservation">
              <input name="date_start" id="date_start" type="text" class="hidden">
              <input name="date_end" id="date_end" type="text" class="hidden">
            </div>
            </div> 
            <div class="form-group">
              <table id="program-list-table" class="table table-hover" width="100%">
                <thead>
                  <tr>
                    <th class="index">No.</th>
                    <th>Title</th>
                    <th>Duration</th>
                    <th>Airtime</th>
                    <th>Type</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
         </div>
       </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-info" onclick="updateSched()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="byRouteModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Program Listing</h4>
      </div>

      <div class="modal-body">
       <div class="container-fluid">
         <div class="col-md-12">
              <div class="form-group">
                <label>Agency/Advertiser:</label>
                <select id="advertiser_id" name="advertiser_id" class="form-control select2" style="width:100%;">
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
                <a class="btn btn-link pull-right" href="<?php echo site_url('advertisers/add') ?>">New Advertiser</a>
              </div>   
            <div class="form-group">
            <label>Timeslot:</label>
            <input id="timeslot_form1" type="text" class="form-control" id="" readonly>
            </div>
            <div class="form-group">
            <label>Airing Dates:</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input name="date_reg" type="text" class="form-control pull-left" id="reservation">
              <input name="date_start" id="date_start" type="text" class="hidden">
              <input name="date_end" id="date_end" type="text" class="hidden">
            </div>
            </div> 
            <div class="form-group">
              <table id="program-list-table1" class="table table-hover" width="100%">
                <thead>
                  <tr>
                    <th class="index">No.</th>
                    <th>Title</th>
                    <th>Duration</th>
                    <th>Airtime</th>
                    <th>Type</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
         </div>
       </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-info" onclick="updateSched()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Browse Program Schedule</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->

  <div class="box-body">

    <div class="nav-tabs-custom tab-success">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_0" data-toggle="tab" id="byAdvertiser">By Advertiser</a></li>
        <li><a href="#tab_1" data-toggle="tab" id="byRoute">By Route</a></li>
      </ul>
      <div class="tab-content">
      <div></div>
        <div class="tab-pane active" id="tab_0">
          <div class="form-group">
            <label>Select Agency/Advertiser:</label>
            <select id="advertiser_id" name="advertiser_id" class="form-control select2" style="width:100%;">
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
            <a class="btn btn-link pull-right" href="<?php echo site_url('advertisers/add') ?>">New Advertiser</a>
          </div> 
        </div>

        <div class="tab-pane" id="tab_1">
          <div class="form-group">
            <label for="route_list">Select Route:</label>
            <select id="route_id" name="route_id" class="form-control select2" style="width:100%;">
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
            <a class="btn btn-link pull-right" href="<?php echo site_url('routes/add') ?>">New Route</a>
          </div>
        </div>

      </div>
      <!-- /.tab-content -->
    <!-- nav-tabs-custom -->
    <!--2nd Nav Tabs-->
    <div class="nav-tabs-custom tab-success">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#advertiser_tab_0" data-toggle="tab">Morning</a></li>
        <li><a href="#advertiser_tab_1" data-toggle="tab">Afternoon</a></li>
        <li><a href="#advertiser_tab_2" data-toggle="tab">Evening</a></li>
      </ul>
      <div class="tab-content">

        <div class="tab-pane active" id="advertiser_tab_0">
          <table id="morning-table" class="table table-hover" width="100%">
            <thead>
              <tr>
                <th></th>
                <th>Timeslot</th>
                <th>No. of Ads</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>


        <div class="tab-pane" id="advertiser_tab_1">
          <table id="afternoon-table" class="table table-hover" width="100%">
            <thead>
              <tr>
                <th></th>
                <th>Timeslot</th>
                <th>No. of Ads</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
          
        
        <div class="tab-pane" id="advertiser_tab_2">
          <table id="evening-table" class="table table-hover" width="100%">
            <thead>
              <tr>
                <th></th>
                <th>Timeslot</th>
                <th>No. of Ads</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->

    </div>
  </div><!-- /.box-body -->
    
  <div class="box-footer">
  </div><!-- box-footer -->
</div><!-- /.box -->

<script type="text/javascript">
  $(".select2").select2();
  $('.select2-selection__rendered').removeAttr('title');
    
    //Dragging and Updating Index of Rows
    var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width())
        });
        return $helper;
    },
        updateIndex = function(e, ui) {
            $('td.index', ui.item.parent()).each(function (i) {
                $(this).html(i + 1);
            });
        };

    $("#program-list-table tbody").sortable({
        helper: fixHelperModified,
        stop: updateIndex
    }).disableSelection();

    // READ
    var morning_table = $("#morning-table").DataTable({
     "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            },
        ],
      "ajax":{
        "url":"<?php echo site_url('program/morningTslot') ?>",
        "type":"POST"
      }
    })

    var afternoon_table = $("#afternoon-table").DataTable({
     "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            },
        ],
      "ajax":{
        "url":"<?php echo site_url('program/afternoonTslot') ?>",
        "type":"POST"
      }
    })

    var evening_table = $("#evening-table").DataTable({
     "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            },
        ],
      "ajax":{
        "url":"<?php echo site_url('program/eveningTslot') ?>",
        "type":"POST"
      }
    })
    var modalBox = "advertiser";
    var table1 = $("#program-list-table").DataTable({
        "paging":   false,
    });
    var table2 = $("#program-list-table1").DataTable({
        "paging":   false,
    });
    //
    $("#byRoute").click(function(){
       $("#byAdvertiserBox").addClass("hidden");
       $("#byRouteBox").removeClass("hidden");
       modalBox = "route";
    });
    
    $("#byAdvertiser").click(function(){
       $("#byAdvertiserBox").removeClass("hidden");
       $("#byRouteBox").addClass("hidden");
       modalBox = "advertiser";
    });
    //ROW CLICK
    var timeslotData;
    $('#morning-table tbody').on('click', 'tr', function () {
        var data = morning_table.row( this ).data();
        timeslotData = data[1];
        programListing(data[0]);
        programListing1(data[0]);
        var input_timeslot = document.getElementById('timeslot_form');
        input_timeslot.value = timeslotData;
        var input_timeslot1 = document.getElementById('timeslot_form1');
        input_timeslot1.value = timeslotData;
//        alert( 'Timeslot: '+timeslotData+' Selected' );
    });
    
    $('#afternoon-table tbody').on('click', 'tr', function () {
        var data = afternoon_table.row( this ).data();
        timeslotData = data[1];
        programListing(data[0]);
        programListing1(data[0]);
        var input_timeslot = document.getElementById('timeslot_form');
        input_timeslot.value = timeslotData;
        var input_timeslot1 = document.getElementById('timeslot_form1');
        input_timeslot1.value = timeslotData;
//        alert( 'Timeslot: '+data[0]+' Selected' );
    });
    
    $('#evening-table tbody').on('click', 'tr', function () {
        var data = evening_table.row( this ).data();
        timeslotData = data[1];
        programListing(data[0]);
        programListing1(data[0]);
        var input_timeslot = document.getElementById('timeslot_form');
        input_timeslot.value = timeslotData;
        var input_timeslot1 = document.getElementById('timeslot_form1');
        input_timeslot1.value = timeslotData;
//        alert( 'Timeslot: '+data[0]+' Selected' );
    });
    
    function programListing(tslot_id)
    {
        
        $.get("<?php echo site_url('program/programListing/" + tslot_id + "') ?>", function(data){
          var basic = $.map(data, function(el) { return el; });
          var program = basic;
          $("#program-list-table").dataTable().fnClearTable();
          if(program.length > 0)
          {
            $("#program-list-table").dataTable().fnAddData(program);
            if (modalBox == "advertiser") {
                $('#byAdvertiserModal').modal('show');
            } else {
                $('#byRouteModal').modal('show');
            }
          }
          else
          {
              alert('TIMESLOT EMPTY');
          }
        });
    }
    
    function programListing1(tslot_id)
    {
        
        $.get("<?php echo site_url('program/programListing/" + tslot_id + "') ?>", function(data){
          var basic = $.map(data, function(el) { return el; });
          var program = basic;
          $("#program-list-table1").dataTable().fnClearTable();
          if(program.length > 0)
          {
            $("#program-list-table1").dataTable().fnAddData(program);
            if (modalBox == "advertiser") {
                $('#byAdvertiserModal').modal('show');
            } else {
                $('#byRouteModal').modal('show');
            }
          }
        });
    }

    function updateSched() {
      table1.draw();
      var plainArray;
      plainArray = table1
            .data()
            .toArray();
          console.log(plainArray);
      
    }
//    $(document).on('hidden.bs.modal','#byAdvertiserModal', function () {
//          $('#program-list-table').DataTable().clear().destroy();
//
//    });
//    $(document).on('hidden.bs.modal','#byRouteModal', function () {
//        $('#program-list-table').DataTable().clear().destroy();
//
//    });
</script>