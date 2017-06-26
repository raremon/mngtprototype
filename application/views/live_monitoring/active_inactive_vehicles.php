<div class="modal fade" id="more-info-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close pull-right" data-dismiss="modal">&nbsp;&times;</button>
        <span class="label label-success pull-right">Active</span>
        <span class="label label-danger pull-right">Inactive</span>

          </br>
        <h4 class="modal-title">Vehicle Details</h4>
      </div>
      <div class="modal-body">
      <div class="container-fluid">
        <div class="col-md-12">
            <p>Vehicle Name:</p>
            <p>Vehicle Description:</p>
            <p>Vehicle Type:</p>
            <p>Plate Number:</p>
            <p>Chassis Number:</p>
            <p>Sim Number:</p>
        </div>
      </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Vehicle List</h3>
    <div class="box-tools pull-right"></div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
            <div class="col-md-3">
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>Active</h3>

                  <p>Vehicle Name Here</p>
                </div>
                <div class="icon">
                  <i class="ion ion-checkmark"></i>
                </div>
                <a href="#/" class="small-box-footer" onclick="showModal()">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>  
            <div class="col-md-3">
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>Inactive</h3>

                  <p>Vehicle Name Here</p>
                </div>
                <div class="icon">
                  <i class="ion ion-close"></i>
                </div>
                <a href="#/" class="small-box-footer" onclick="showModal()">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div> 
            <div class="col-md-3">
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>Inactive</h3>

                  <p>Vehicle Name Here</p>
                </div>
                <div class="icon">
                  <i class="ion ion-close"></i>
                </div>
                <a href="#/" class="small-box-footer" onclick="showModal()">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div> 
            <div class="col-md-3">
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>Active</h3>

                  <p>Vehicle Name Here</p>
                </div>
                <div class="icon">
                  <i class="ion ion-checkmark"></i>
                </div>
                <a href="#/" class="small-box-footer" onclick="showModal()">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div> 
        </div>
      </div> 
  </div>
  <div class="box-footer">

  </div>
</div>

<script type="text/javascript">
  $("#hidden-form").hide();
  $(".select2").select2();
$('.select2-selection__rendered').removeAttr('title');
  function showModal() {
      $("#more-info-box").modal('show');
  }

</script>