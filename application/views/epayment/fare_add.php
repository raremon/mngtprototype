<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Fare Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="route-message"></div>
          <form id='fare' method="POST" class="form-horizontal">


            <div class="form-group">
              <label>Route</label>
              <select data-placeholder="No regions on the data" id="region" name="route" class="select2 form-control">
                <option style="display:none" selected value disabled>Select Route</option>
                <?php 
                  foreach($routes as $row)
                  {
                ?>
                  <option value= '<?php echo $row[0];?>' >
                    <?php echo $row[1]; ?>
                  </option>
                <?php 
                  }
                ?>
              </select>
              <a class="btn btn-link pull-right" href="<?php echo site_url('routes/add') ?>">Add Route</a>
            </div>

              <div style="text-align: center" class="row">
                  <div  class="col-md-6">
                        <label>Public Utility Bus</label><br><br>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Minimum Fare:</label>
                            <div class="col-md-6">
                                <input type="number" name="PUBminimum_fare" class="form-control" placeholder="Enter Minimum Fare"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Minimum Kilometer(s):</label>
                            <div class="col-md-6">
                                <input type="number" name="PUBminimum_km" class="form-control" placeholder="Enter Minimum Kilometer(s)"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Rate/km (After Min):</label>
                            <div class="col-md-6">
                                <input type="number" name="PUBadded_fare" class="form-control" placeholder="Enter Rate/km"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Discount:</label>
                            <div class="col-md-6">
                                <input type="number" name="PUBdiscount" class="form-control" placeholder="Enter Discount"/>
                            </div>
                        </div>
                  </div>
                  
                  <div class="col-md-6">
                        <label>Public Utility Jeepney</label><br><br>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Minimum Fare:</label>
                            <div class="col-md-6">
                                <input type="number" name="PUJminimum_fare" class="form-control" placeholder="Enter Minimum Fare"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Minimum Kilometer(s):</label>
                            <div class="col-md-6">
                                <input type="number" name="PUJminimum_km" class="form-control" placeholder="Enter Minimum Kilometer(s)"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Rate/km (After Min):</label>
                            <div class="col-md-6">
                                <input type="number" name="PUJadded_fare" class="form-control" placeholder="Enter Rate/km"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Discount:</label>
                            <div class="col-md-6">
                                <input type="number" name="PUJdiscount" class="form-control" placeholder="Enter Discount"/>
                            </div>
                        </div>
                  </div>
              </div>
            <button type="button" class="btn btn-primary save" onclick="save_Fare()">Save</button>
          </form>
        </div>
      </div> 
  </div>
  <div class="box-footer">
  </div>
</div>

<script type="text/javascript">
  function save_Fare() {
    
      $.ajax({
        url: "<?php echo site_url('fares/saveFare') ?>",
        type: 'POST',
        dataType: 'json',
        data: $('#fare').serialize(),
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#route-message").fadeIn("slow");
              $('#route-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#route-message').fadeOut('slow');
              }, 3000);
            }
          }else {
            $('#message-text').html(data.message);
            $('#successModal').modal('show');
          }
        }
      });
    
  }
</script>