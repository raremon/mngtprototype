<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php echo $bus_count; ?></h3>
        <p>Active Buses</p>
      </div>
      <div class="icon">
        <i class="ion ion-android-bus"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?php echo $ad_count;?></h3>
        <p>New Ad Orders</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-monitor-outline"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?php echo $advertiser_count;?></h3>
        <p>New Ad Owner</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-stalker"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3><?php echo $schedule_count;?></h3>
        <p>New Program Schedule</p>
      </div>
      <div class="icon">
        <i class="ion ion-android-film"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="date-box">
            <h3>Welcome,</h3>
            </br></br>
            <p class="text-center" style="font-size:55px;"><script> document.write(new Date().toDateString()); </script></p>
            
        </div>
    </div>
    <div class="col-lg-6">	
    <a href="<?php echo base_url('media/assign') ?>">
        <div class="col-lg-6 col-xs-6">
        <div class="small-box quick-links">
          <div class="inner">
            </br>
            <p style="font-size:23px;">Assign Media</p>
            </br>
          </div>
          <div class="icon">
            <i class="ion ion-film-marker"></i>
          </div>
        </div>
      </div>    
    </a>
    <a href="<?php echo base_url('routes/add') ?>">
        <div class="col-lg-6 col-xs-6">
        <div class="small-box quick-links">
          <div class="inner">
            </br>
            <p style="font-size:23px;">New Route</p>
            </br>
          </div>
          <div class="icon">
            <i class="ion ion-android-compass"></i>
          </div>
        </div>
      </div>    
    </a>
    <a href="<?php echo base_url('salesman/schedules') ?>">
        <div class="col-lg-6 col-xs-6">
        <div class="small-box quick-links">
          <div class="inner">

            <p style="font-size:22px;">Schedule</p>
            <p style="font-size:22px;">Availability</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-calendar"></i>
          </div>
        </div>
      </div>    
    </a>
    <a href="<?php echo base_url('users/add') ?>">
        <div class="col-lg-6 col-xs-6">
        <div class="small-box quick-links">
          <div class="inner">
            </br>
            <p style="font-size:23px;">New User</p>
            </br>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
        </div>
      </div>    
    </a>


    </div>
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">
  <!-- Left col -->