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

<div class="box box-success" id="byAdvertiserBox">
  <div class="box-header with-border">
    <h3 class="box-title">Program Listing</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->

  <div class="box-body">
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
        <input type="text" class="form-control" id="" readonly>
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
              <tr>
                <td class="index">1</td>
                <td>YKK Zipper</td>
                <td>70s</td>
                <td>90s</td>
                <td>Ads</td>
              </tr>
              <tr>
                <td class="index">2</td>
                <td>Eagle Cement</td>
                <td>70s</td>
                <td>90s</td>
                <td>Ads</td>
              </tr>
              <tr>
                <td class="index">3</td>
                <td>Rhea Alcohol</td>
                <td>70s</td>
                <td>90s</td>
                <td>Ads</td>
              </tr>
            </tbody>
          </table>
        </div>
     </div>
   </div>
  </div><!-- /.box-body -->
     
  <div class="box-footer">
    <button type="button" class="btn btn-success pull-right" onclick="">Save</button>
    <button type="button" class="btn btn-primary pull-right" onclick="" style="margin-right:10px;">Update</button>
  </div><!-- box-footer -->
</div><!-- /.box -->

<div class="box box-success hidden" id="byRouteBox">
  <div class="box-header with-border">
    <h3 class="box-title">Program Listing</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->

  <div class="box-body">
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
        <input type="text" class="form-control" id="" readonly>
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
  </div><!-- /.box-body -->
     
  <div class="box-footer">
    <button type="button" class="btn btn-success pull-right" onclick="">Save</button>
    <button type="button" class="btn btn-primary pull-right" onclick="" style="margin-right:10px;">Update</button>
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
    
    $("#program-list-table").DataTable();
    
    //ROW CLICK
    $('#morning-table tbody').on('click', 'tr', function () {
        var data = morning_table.row( this ).data();
        programListing(data[0]);
//        alert( 'Timeslot: '+data[0]+' Selected' );
    });
    
    $('#afternoon-table tbody').on('click', 'tr', function () {
        var data = afternoon_table.row( this ).data();
        programListing(data[0]);
//        alert( 'Timeslot: '+data[0]+' Selected' );
    });
    
    $('#evening-table tbody').on('click', 'tr', function () {
        var data = evening_table.row( this ).data();
        programListing(data[0]);
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
          }
          else
          {
              alert('WALANG PROGRAM DUN SA TIMESLOT');
          }
        });
    }
    
    $("#byRoute").click(function(){
       $("#byAdvertiserBox").addClass("hidden");
       $("#byRouteBox").removeClass("hidden");
    });
    
    $("#byAdvertiser").click(function(){
       $("#byAdvertiserBox").removeClass("hidden");
       $("#byRouteBox").addClass("hidden");
    });
</script>