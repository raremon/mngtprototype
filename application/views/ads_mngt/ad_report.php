<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Report</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">
      <div class="form-group">
          <label>Select Advertiser:</label>
          <select name="advertiser_id" class="form-control">
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
          <label for="route_list">Select Route:</label>
          <select name="route_id" class="form-control">
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
    <?php echo form_close(); ?>
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Ads Played Per Owner</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
              <div class="chart">
                  <canvas id="adChart1" style="height:350px"></canvas>
              </div> 
            <!-- /.box-body -->
          </div>
  </div><!-- /.box-body -->
    
  <div class="box-footer">
      <h3>Overall Ad Statistics</h3>
      <div class="chart">
          <canvas id="adChart2" style="height:350px"></canvas>
      </div>     
  </div><!-- box-footer -->
</div><!-- /.box -->

<script>
$(function () {
var canvas = document.getElementById('adChart1');
var data = {
    labels: ["AM", "PM", "TOTAL"],
    datasets: [
        {
            label: "ADS PLAYED",
            fill: true,
            lineTension: 0.1,
            backgroundColor: "rgba(50,205,50,0.4)",
            borderColor: "rgba(50,205,50,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(50,205,50,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(50,205,50,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 5,
            pointHitRadius: 10,
            data: [0, 0, 0],
        }
    ]
};
window.addEventListener('load', updateData);
function updateData(){               
  ad_Chart1.data.datasets[0].data[0] = 0;// for am
  ad_Chart1.data.datasets[0].data[1] = 2;// for pm
  ad_Chart1.data.datasets[0].data[2] = 0;// total
                                     //^ yung zero yan ung papalitan ng magiging bagong value nung data
  ad_Chart1.update();
}
var ad_Chart1 = Chart.Line(canvas,{
  data:data,
});
    
//CHART FOR OVERALL AD STATISTICS
var canvas2 = document.getElementById('adChart2');
var data2 = {
    labels: ["AM", "PM", "TOTAL"],
    datasets: [
        {
            label: "ADS PLAYED",
            fill: true,
            lineTension: 0.1,
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgba(75,192,192,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 5,
            pointHitRadius: 10,
            data: [0, 0, 0],
        }
    ]
};
window.addEventListener('load', updateData2);
function updateData2(){               
  ad_Chart2.data.datasets[0].data[0] = 2;// for am
  ad_Chart2.data.datasets[0].data[1] = 0;// for pm
  ad_Chart2.data.datasets[0].data[2] = 0;// total
                                     //^ yung zero yan ung papalitan ng magiging bagong value nung data
  ad_Chart2.update();
}
var ad_Chart2 = Chart.Line(canvas2,{
  data:data2,
});


});
</script>