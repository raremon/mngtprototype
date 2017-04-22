<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $title; ?>
      <small><?php echo $page_description; ?></small>
    </h1>
    <ol class="breadcrumb">
      <i class="fa fa-calendar-plus-o"></i>&nbsp;
      <?php foreach($breadcrumbs as $row) { ?>
        <li><a href="<?php echo base_url($row[1]) ?>"><?php echo $row[0]; ?></a></li>
      <?php } ?>
      <li class="active">Here</li>
    </ol>
  </section>

  <!-- Main content -->

  <section class="content">
    
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Arrange by routes</h3>
                <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
              <form role="form">
                 <div class="form-group">
                  <label for="route_list">Select Ad Owner:</label>
                  <select class="form-control select2" id="route_list">
                    <option>Mcdonalds PH</option>
                    <option>Mang Inasal</option>
                    <option>Unilever</option>
                    <option>YKK Zipper</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Select Duration:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-left" id="reservation">
                  </div>
                </div>
                <div class="form-group">
                    <label>Select Days:</label><br/> 
                    <label class="checkbox-inline">
                        <input type="checkbox" class="minimal" name="days_checked[]" value="Monday">&nbsp;Monday
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="minimal" name="days_checked[]" value="Tuesday">&nbsp;Tuesday
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="minimal" name="days_checked[]" value="Wednesday">&nbsp;Wednesday
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="minimal" name="days_checked[]" value="Thursday">&nbsp;Thursday
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="minimal" name="days_checked[]" value="Friday">&nbsp;Friday
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="minimal" name="days_checked[]" value="Saturday">&nbsp;Saturday
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="minimal" name="days_checked[]" value="Sunday">&nbsp;Sunday
                    </label>
                </div>                
                 <div class="form-group">
                  <label for="route_list">Select Route:</label>
                  <select class="form-control select2" id="route_list">
                    <option>Manila-Tagaytay</option>
                    <option>Batangas-Manila</option>
                    <option>Pasay-Fairview</option>
                    <option>Buendia-North Edsa</option>
                  </select>
                </div>
                <span>Arrange From Left to Right</span>
                <ul class="margin_fix connectedSortable">
                 
                  </ul>
              </form>
                
            </div><!-- /.box-body -->
            <div class="box-footer">
              <span>Choose Videos Below:</span>
              <div class="row">
                  <ul class="connectedSortable">
                      <li class="col-lg-3">
                        <div class="info-box">
                          <!-- Apply any bg-* class to to the icon to color it -->
                          <span class="info-box-icon bg-blue"><i class="fa fa-play-circle-o"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text">Procter and Gamble</span>
                            <span class="info-box-number">2:11</span>
                          </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->                   
                      </li>
                      <li class="col-lg-3">
                        <div class="info-box">
                          <!-- Apply any bg-* class to to the icon to color it -->
                          <span class="info-box-icon bg-yellow"><i class="fa fa-play-circle-o"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text">Nido Fortified</span>
                            <span class="info-box-number">1:24</span>
                          </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->                      
                      </li>
                      <li class="col-lg-3">
                        <div class="info-box">
                          <!-- Apply any bg-* class to to the icon to color it -->
                          <span class="info-box-icon bg-green"><i class="fa fa-play-circle-o"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text">Palawan Express</span>
                            <span class="info-box-number">2:51</span>
                          </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->                      
                      </li>
                      <li class="col-lg-3">
                        <div class="info-box">
                          <!-- Apply any bg-* class to to the icon to color it -->
                          <span class="info-box-icon bg-black"><i class="fa fa-play-circle-o"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text">Apple</span>
                            <span class="info-box-number">3:25</span>
                          </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->                      
                      </li>
                      <li class="col-lg-3">
                        <div class="info-box">
                          <!-- Apply any bg-* class to to the icon to color it -->
                          <span class="info-box-icon bg-gray"><i class="fa fa-play-circle-o"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text">Mercury Drugstore</span>
                            <span class="info-box-number">3:11</span>
                          </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->                      
                      </li>
                      <li class="col-lg-3">
                        <div class="info-box">
                          <!-- Apply any bg-* class to to the icon to color it -->
                          <span class="info-box-icon bg-teal"><i class="fa fa-play-circle-o"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text">Tide</span>
                            <span class="info-box-number">2:24</span>
                          </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->                      
                      </li>
                      <li class="col-lg-3">
                        <div class="info-box">
                          <!-- Apply any bg-* class to to the icon to color it -->
                          <span class="info-box-icon bg-maroon"><i class="fa fa-play-circle-o"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text">Salon</span>
                            <span class="info-box-number">2:34</span>
                          </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->                      
                      </li>
                      <li class="col-lg-3">
                        <div class="info-box">
                          <!-- Apply any bg-* class to to the icon to color it -->
                          <span class="info-box-icon bg-red"><i class="fa fa-play-circle-o"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text">Mcdonalds</span>
                            <span class="info-box-number">3:17</span>
                          </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->                      
                      </li>
                  </ul>
              </div>
            </div><!-- box-footer -->
        </div><!-- /.box -->
      
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
