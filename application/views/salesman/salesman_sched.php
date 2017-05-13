<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title"></h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
    <div id="sched_wizard">
        <h3>Select Region<i class="fa fa-angle-double-right" style="float:right;font-size:20px;padding-top:5px;"></i></h3>
        <section>
            <form>
                <div class="form-group">
                <label>Region</label>
                <select name="region_id" class="form-control">
                  <?php 
                    foreach($region as $row)
                    {
                  ?>
                    <option value= <?php echo $row[0];?> >
                      <?php echo $row[1]; ?>
                    </option>
                  <?php 
                    }
                  ?>
                </select>
                <a class="btn btn-link pull-right" href="<?php echo site_url('regions/add') ?>">Add Region</a>
                </div>          
            </form>
        </section>
        <h3>Select City/Province<i class="fa fa-angle-double-right" style="float:right;font-size:20px;padding-top:5px;"></i></h3>
        <section>
            <form>
                <div class="form-group">
                  <label>City/Province</label>
                  <select id="#" name="#" class="form-control">
                  </select>
                  <a class="btn btn-link pull-right" href="<?php echo site_url('cities/add') ?>">Add City</a>
                </div>         
            </form>
        </section>
        <h3>Select Route<i class="fa fa-angle-double-right" style="float:right;font-size:20px;padding-top:5px;"></i></h3>
        <section>
            <form>
                <div class="form-group">
                  <label>Route</label>
                  <select id="#" name="#" class="form-control">
                  </select>
                  <a class="btn btn-link pull-right" href="<?php echo site_url('routes/add') ?>">Add Routes</a>
                </div>          
            </form>
        </section>
        <h3>Select Schedule<i class="fa fa-angle-double-right" style="float:right;font-size:20px;padding-top:5px;"></i></h3>
        <section>
          <div class="container-fluid">
            <div class="col-md-12">
              <table id="#" class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>TIME SLOT</th>
                    <th>AVAILABLE</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </section>
        <h3>Selected Schedule<i class="fa fa-check" style="float:right;font-size:20px;padding-top:5px;"></i></h3>
        <section>
          <div class="container-fluid">
            <div class="col-md-12">
              <table id="#" class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>SELECTED TIME SLOT</th>
                    <th>AD FREQUENCY</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
        </section>
    </div>
  </div>
  <div class="box-footer">
  </div>
</div>
<script type="text/javascript">
    $("#sched_wizard").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "fade",
        autoFocus: true,
        onFinished: function (event, currentIndex)
        {
            //DITO YUNG ONCLICK NUNG FINISH
            alert("DONE");
        }
    });
</script>