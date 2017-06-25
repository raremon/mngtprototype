<div class="box box-success">
  <div style='margin-top:20px' class="box-header with-border">
    <h3 class="box-title">Fares Data</h3>
    <div class="box-tools pull-right">
        <a class="btn btn-link add-link" href="<?php echo base_url('fares/add') ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New Fare</a>
    </div>
  </div>
  <div class="box-body">
    <div id="route-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="fares_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>ROUTE</th>
                <th>PUB</th>
                <th>PUJ</th>
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
                <h4 class="modal-title">Fare Matrix</h4>
            </div>
            <div class="modal-body">
                <h4 style="text-align: center"><b>PUBLIC UTILITY BUS</b></h4>
                <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead id="head"></thead>
                    <tbody id="PUB"></tbody>
                </table>
                </div>
                <div class="table-responsive">
                <h4 style="text-align: center"><b>PUBLIC UTILITY JEEP</b></h4>
                <table class="table table-hover table-bordered">
                    <thead id="head"></thead>
                    <tbody id="PUJ"></tbody>
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
$("#fares_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('fares/showFares') ?>",
      "type":"POST"
    }
  })
  
  function fare_matrix(route) {
    $('#fareMatrix').modal('show');
    $.ajax({
      url: "<?php echo site_url('stops/PUBFareMatrix?id=') ?>"+route,
      type: 'POST',
      success:function (data) {
        $("#PUB").html(data);
      }
    });
    $.ajax({
      url: "<?php echo site_url('stops/PUJFareMatrix?id=') ?>"+route,
      type: 'POST',
      success:function (data) {
        $("#PUJ").html(data);
      }
    });
    $.ajax({
      url: "<?php echo site_url('stops/FareMatrixHead?id=')?>"+route,
      type: 'POST',
      success:function (data) {
        $("#head").html(data);
      }
    });
  }
</script>