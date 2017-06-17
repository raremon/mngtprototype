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
            <form>
              <div class="form-group">
                <label>Timeslot:</label>
                <input id="timeslot_form" type="text" class="form-control" id="" readonly>
              </div>
              <div class="form-group">
                <table id="program-list-table" class="table table-hover" width="100%">
                  <thead>
                    <tr>
                      <th class="index">No.</th>
                      <th>Play Id</th>
                      <th>Title</th>
                      <th>Duration</th>
                      <th>Airtime</th>
                      <th>Type</th>
                      <th>Route</th>
                      <th>Advertiser</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </form>
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
              <label>Timeslot:</label>
              <input id="timeslot_form1" type="text" class="form-control" id="" readonly>
            </div>
            <div class="form-group">
              <table id="program-list-table1" class="table table-hover" width="100%">
                <thead>
                  <tr>
                    <th class="index">No.</th>
                    <th>Play Id</th>
                    <th>Title</th>
                    <th>Duration</th>
                    <th>Airtime</th>
                    <th>Type</th>
                    <th>Route</th>
                    <th>Advertiser</th>
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
        <button type="button" class="btn btn-info" onclick="updateSched2()">Update</button>
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
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <?php echo form_open('', array('id'=>'scheduling')); ?>
      <div class="form-group">
        <input type="text" name="scheduleData" id="scheduleData" class="form-control hidden" readonly/>
      </div>
    <?php echo form_close(); ?>
    <div class="nav-tabs-custom tab-success">
      <ul class="nav nav-tabs superdens">
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
        <div class="form-group">
          <label>Date:</label>

          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="datepicker1">
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
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
  </div>
  <!-- box-footer -->
</div>
<!-- /.box -->
<script type="text/javascript">
  $(".select2").select2();
  $('.select2-selection__rendered').removeAttr('title');
  var output;
  var morning_table;
  var afternoon_table;
  var evening_table;
  $( document ).ready(function() {
    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();

    output = (month<10 ? '0' : '') + month + '/' +
    (day<10 ? '0' : '') + day + '/' +
    d.getFullYear();
    $('#datepicker1').val(output);

    // READ
    morning_table = $("#morning-table").DataTable({
     "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            },
        ],
      "ajax":{
        "url":"<?php echo site_url('program/morningTslot/"+output+"') ?>",
        "type":"POST"
      }
    })
  
    afternoon_table = $("#afternoon-table").DataTable({
     "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            },
        ],
      "ajax":{
        "url":"<?php echo site_url('program/afternoonTslot/"+output+"') ?>",
        "type":"POST"
      }
    })
  
    evening_table = $("#evening-table").DataTable({
     "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            },
        ],
      "ajax":{
        "url":"<?php echo site_url('program/eveningTslot/"+output+"') ?>",
        "type":"POST"
      }
    });
  });

  $('#datepicker1').change(function() {
    // console.log($('#datepicker1').val());
    var datechange = $('#datepicker1').val();
    $.get("<?php echo site_url('program/morningTslot/"+datechange+"') ?>", function(data){
      var basic = $.map(data, function(el) { return el; });
      $("#morning-table").dataTable().fnClearTable();
      if(basic.length > 0)
      {
        $("#morning-table").dataTable().fnAddData(basic);
      }
    });
    $.get("<?php echo site_url('program/afternoonTslot/"+datechange+"') ?>", function(data){
      var basic = $.map(data, function(el) { return el; });
      $("#afternoon-table").dataTable().fnClearTable();
      if(basic.length > 0)
      {
        $("#afternoon-table").dataTable().fnAddData(basic);
      }
    });
    $.get("<?php echo site_url('program/eveningTslot/"+datechange+"') ?>", function(data){
      var basic = $.map(data, function(el) { return el; });
      $("#evening-table").dataTable().fnClearTable();
      if(basic.length > 0)
      {
        $("#evening-table").dataTable().fnAddData(basic);
      }
    });
  });

//    //Dragging and Updating Index of Rows
//    var fixHelperModified = function(e, tr) {
//        var $originals = tr.children();
//        var $helper = tr.clone();
//        $helper.children().each(function(index) {
//            $(this).width($originals.eq(index).width())
//        });
//        return $helper;
//    },
//        updateIndex = function(e, ui) {
//            $('td.index', ui.item.parent()).each(function (i) {
//                $(this).html(i + 1);
//            });
//            
//        };
//    $("#program-list-table tbody").sortable({
//        helper: fixHelperModified,
//    });
//    $("#program-list-table1 tbody").sortable({
//        helper: fixHelperModified,
//    });
    
    var modalBox = "advertiser";
    var table1 = $("#program-list-table").DataTable({
        "paging":   false,
        "bFilter": false,
        "stateSave": true,
        rowReorder: true
    });
    var table2 = $("#program-list-table1").DataTable({
        "paging":   false,
        "bFilter": false,
        "stateSave": true,
        rowReorder: true
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
        if(modalBox == 'route')
        {
          // SECOND TAB
          programListing(data[0]);
        }
        else
        {
          // FIRST TAB
          programListing1(data[0]);
        }
        var input_timeslot = document.getElementById('timeslot_form');
        input_timeslot.value = timeslotData;
        var input_timeslot1 = document.getElementById('timeslot_form1');
        input_timeslot1.value = timeslotData;
    });
    
    $('#afternoon-table tbody').on('click', 'tr', function () {
        var data = afternoon_table.row( this ).data();
        timeslotData = data[1];
        if(modalBox == 'route')
        {
          // SECOND TAB
          programListing(data[0]);
        }
        else
        {
          // FIRST TAB
          programListing1(data[0]);
        }
        var input_timeslot = document.getElementById('timeslot_form');
        input_timeslot.value = timeslotData;
        var input_timeslot1 = document.getElementById('timeslot_form1');
        input_timeslot1.value = timeslotData;
    });
    
    $('#evening-table tbody').on('click', 'tr', function () {
        var data = evening_table.row( this ).data();
        timeslotData = data[1];
        if(modalBox == 'route')
        {
          // SECOND TAB
          programListing(data[0]);
        }
        else
        {
          // FIRST TAB
          programListing1(data[0]);
        }
        var input_timeslot = document.getElementById('timeslot_form');
        input_timeslot.value = timeslotData;
        var input_timeslot1 = document.getElementById('timeslot_form1');
        input_timeslot1.value = timeslotData;
    });
    
    var program = [];
    var programFilter = [];
    // SECOND TAB, PANG ROUTE
    function programListing(tslot_id)
    {
        programFilter = [];
        var datechange = $('#datepicker1').val();
        $.get("<?php echo site_url('program/programListing/" + tslot_id + "/" + datechange + "') ?>", function(data){
          var basic = $.map(data, function(el) { return el; });
          program = basic;
          $("#program-list-table1").dataTable().fnClearTable();
          if(program.length > 0)
          {
            for(var i=0; i<program.length; i++)
            {
              if(program[i][6] == $('#route_id').val())
              {
                programFilter.push(program[i]);
              }
            }
            if(programFilter.length > 0)
            {
             $("#program-list-table1").dataTable().fnAddData(programFilter);
            }
            $('#byRouteModal').modal('show');
          }
          else
          {
              alert('TIMESLOT EMPTY');
          }
        });
    }
    
    function programListing1(tslot_id)
    {
      programFilter = [];
      var datechange = $('#datepicker1').val();
      $.get("<?php echo site_url('program/programListing/" + tslot_id + "/" + datechange + "') ?>", function(data){
        var basic = $.map(data, function(el) { return el; });
        program = basic;
        $("#program-list-table").dataTable().fnClearTable();
        if(program.length > 0)
        {
          for(var i=0; i<program.length; i++)
          {
            if(program[i][7] == $('#advertiser_id').val() || program[i][7] == 0)
            {
              programFilter.push(program[i]);
            }
          }
          if(programFilter.length > 0)
          {
           $("#program-list-table").dataTable().fnAddData(programFilter);
          }
          $('#byAdvertiserModal').modal('show');
        }
        else
        {
            alert('TIMESLOT EMPTY');
        }
      });
    }
  
    function updateSched() {
      var sched = [];
      table1.draw();
      for (var i=0;i<program.length;i++) {
          // console.log(table1.cells({ row: i, column: 0 }).data()[0]);
          sched.push([table1.cells({ row: i, column: 0 }).data()[0], table1.cells({ row: i, column: 1 }).data()[0]]);
      } 
      updateSchedule(sched);
      // console.log(sched);   
    }
    function updateSched2() {
      var sched = [];
      table2.draw();
      for (var i=0;i<10;i++) {
          // console.log(table2.cells({ row: i, column: 0 }).data()[0]);
          sched.push([table2.cells({ row: i, column: 0 }).data()[0], table2.cells({ row: i, column: 1 }).data()[0]]);
      } 
      updateSchedule(sched); 
      // console.log(sched);   
    }

    function updateSchedule(schedule) {
      console.log(schedule);
      $('#scheduleData').val(JSON.stringify(schedule));
      $.ajax({
        url: "<?php echo site_url('program/scheduleUpdate') ?>",
        type: 'POST',
        dataType: 'json',
        data: $('#scheduling').serialize(),
        encode:true,
        success:function (data) {
          if(!data.success){
              // $(window).scrollTop(0);
              // $("#card-message").fadeIn("slow");
              // $('#card-message').html(data.errors).addClass('alert alert-danger');
              // setTimeout(function() {
              //     $('#card-message').fadeOut('slow');
              // }, 3000);
          }else {
            console.log(data.message);
            $('#message-text').html(data.message);
            $('#byRouteModal').modal('hide');
            $('#byAdvertiserModal').modal('hide');
            $('#successModal').modal('show');
          }
        }
      })
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
