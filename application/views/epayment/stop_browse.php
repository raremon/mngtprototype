<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJAq_K8XorLcD2nKKsrmB7BserF3Wh3Ss&libraries=places" type="text/javascript"></script>

<div class="box box-success">
    <div class="row">
      <div class="container-fluid">
        <?php echo $route_details; ?>
      </div>
    </div>
  <div style='margin-top:20px' class="box-header with-border">
    <h3 class="box-title">Stops Data</h3>
    <div class="box-tools pull-right">
        <a href="javascript:void(0)" class="btn btn-primary add-link" onclick="fare_matrix(<?php echo $_GET['id']; ?>)"><i class="fa fa-table">&nbsp;</i>Fare Matrix</a>
        <a class="btn btn-link add-link" href="<?php echo base_url('stops/add?id='.$_GET['id']) ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New Stop</a>
    </div>
  </div>
  <div class="box-body">
    <div id="route-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="stop_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>STOP NAME</th>
                <th>STOP DESCRIPTION</th>
                <th>LOCATION</th>
                <th>MAP</th>
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
  <div class="box-footer">
  </div>
</div>


<div id="fareMatrix" class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="text-align: center" class="modal-title"><b>Fare Matrix</b><br>(<?php echo $page_description; ?>)</h4>
            </div>
            <div class="modal-body">
                <h4 style="text-align: center"><b>PUBLIC UTILITY BUS</b></h4>
                <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="head"></thead>
                    <tbody id="PUB"></tbody>
                </table>
                </div>
                <div class="table-responsive">
                <h4 style="text-align: center"><b>PUBLIC UTILITY JEEP</b></h4>
                <table class="table table-hover table-bordered">
                    <thead class="head">
                        
                    </thead>
                    <tbody id="PUJ">
                        
                    </tbody>
                </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$("#stop_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('stops/showStops?id='.$_GET['id']) ?>",
      "type":"POST"
    }
  })
  
  
  function fare_matrix(id) {
    $('#fareMatrix').modal('show');
    $.ajax({
      url: "<?php echo site_url('stops/PUBFareMatrix?id='.$_GET['id']) ?>",
      type: 'POST',
      success:function (data) {
        $("#PUB").html(data);
      }
    });
    $.ajax({
      url: "<?php echo site_url('stops/PUJFareMatrix?id='.$_GET['id']) ?>",
      type: 'POST',
      success:function (data) {
        $("#PUJ").html(data);
      }
    });
    $.ajax({
      url: "<?php echo site_url('stops/FareMatrixHead?id='.$_GET['id']) ?>",
      type: 'POST',
      success:function (data) {
        $(".head").html(data);
      }
    });
  }
</script>