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

          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Regular</a></li>
              <li><a href="#tab_2" data-toggle="tab">Scheduled</a></li>
              <li><a href="#tab_3" data-toggle="tab">Block Scheduled</a></li>
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="container-fluid">
                   <div class="box">

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
                          <label for="route_list">Select Route:</label>
                          <select class="form-control select2" id="route_list">
                            <option>Manila-Tagaytay</option>
                            <option>Batangas-Manila</option>
                            <option>Pasay-Fairview</option>
                            <option>Buendia-North Edsa</option>
                          </select>
                        </div>
                         <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                      <label>Start Time:</label>

                                      <div class="input-group">
                                        <input type="text" class="form-control" id="timepicker" disabled>

                                        <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                        </div>
                                      </div>
                                        <span class="help-block">*Regular follows the assigned bus schedule.</span>
                                    </div>
                                    <!-- /.form group -->
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                      <label>End Time:</label>

                                      <div class="input-group">
                                        <input type="text" class="form-control" id="timepicker1" disabled>

                                        <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                        </div>
                                      </div>
                                      <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->
                                  </div>
                                </div>  
                            </div>
                        </div>
                        <span>Arrange From Left to Right</span>
                        <ul class="margin_fix connectedSortable">

                        </ul>
                          </br><button type="submit" class="btn btn-primary" id="button_pos">Upload</button>
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
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div class="container-fluid">
                   <div class="box">

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
                            <input type="text" class="form-control pull-left" id="reservation1">
                          </div>
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
                         <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                      <label>Start Time:</label>

                                      <div class="input-group">
                                        <input type="text" class="form-control" id="timepicker2">

                                        <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                        </div>
                                      </div>
                                        <span class="help-block">*Scheduled starts with the given time until the end of bus schedule.</span>
                                    </div>
                                    <!-- /.form group -->
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                      <label>End Time:</label>

                                      <div class="input-group">
                                        <input type="text" class="form-control" id="timepicker3" disabled>

                                        <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                        </div>
                                      </div>
                                      <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->
                                  </div>
                                </div>  
                            </div>
                        </div>
                        <span>Arrange From Left to Right</span>
                        <ul class="margin_fix connectedSortable">

                        </ul>
                          </br><button type="submit" class="btn btn-primary" id="button_pos">Upload</button>
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
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <div class="container-fluid">
                   <div class="box">

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
                            <input type="text" class="form-control pull-left" id="reservation2">
                          </div>
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
                         <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                      <label>Start Time:</label>

                                      <div class="input-group">
                                        <input type="text" class="form-control" id="timepicker4">

                                        <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                        </div>
                                      </div>
                                        <span class="help-block">*Block will play the ads within the given time.</span>
                                    </div>
                                    <!-- /.form group -->
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                      <label>End Time:</label>

                                      <div class="input-group">
                                        <input type="text" class="form-control" id="timepicker5">

                                        <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                        </div>
                                      </div>
                                      <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->
                                  </div>
                                </div>  
                            </div>
                        </div>
                        <div class="col-md-12">
                          <table id="#" class="table table-hover table-bordered">
                            <thead>
                              <tr>
                                <th>START TIME</th>
                                <th>END TIME</th>
                                <th>EDIT/DELETE</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                        <span>Arrange From Left to Right</span>
                        <ul class="margin_fix connectedSortable">

                        </ul>
                          </br><button type="submit" class="btn btn-primary" id="button_pos">Upload</button>
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
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
