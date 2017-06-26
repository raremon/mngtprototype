<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Report</h3>
  </div>
  <div class="box-body">
      
        <form method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>From</label>
                        <input type="date" class="form-control" name="from_date">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>To</label>
                        <input type="date" class="form-control" name="to_date">
                    </div>
                </div>
            </div>
        </form>
      
      
    <div id="route-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="sales_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>TRANSACTION</th>
                <th>TOTAL COUNT</th>
                <th>TOTAL AMOUNT</th>
              </tr>
            </thead>
            <tbody id="Sales">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="box-footer">
  </div>
</div>

<script type="text/javascript">
    
    $.ajax({
      url: "<?php echo site_url('salesreport/showSales') ?>",
      type: 'POST',
      success:function (data) {
        $("#Sales").html(data);
        console.log(data);
      }
    });
    
</script>

