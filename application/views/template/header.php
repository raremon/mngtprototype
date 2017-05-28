<!DOCTYPE html>
<html>
    
    <head>
      
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Star8 | <?php echo $title; ?></title>

      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

      <!--GLOBAL LINKS-->
      <link rel="icon" href="<?php echo base_url(); ?>/favicon.ico" type="image/gif">
      <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css') ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/animate.css') ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
      <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css') ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/css/skins/skin-green.css') ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/css/dataTables.bootstrap.min.css') ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css') ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/select2.min.css') ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.css') ?>"/>
    <?php foreach($css as $rows){ ?>
      <link rel="stylesheet" href="<?php echo base_url($rows) ?>"/>
    <?php } ?>

      <!-- GLOBAL SCRIPTS -->
      <script src="<?php echo base_url('assets/js/jquery-2.2.3.min.js') ?>"></script>
      <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
      <script src="<?php echo base_url('assets/js/app.min.js') ?>"></script>
      <script src="<?php echo base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
      <script src="<?php echo base_url('assets/js/dataTables.bootstrap.min.js') ?>"></script>
      <script src="<?php echo base_url('assets/plugins/jQueryUI/jquery-ui.min.js') ?>"></script>
      <script src="<?php echo base_url('assets/plugins/select2/select2.full.min.js') ?>"></script>
      <script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
      <script>
        $.widget.bridge('uibutton', $.ui.button);
      </script>
    <?php foreach($script as $rows){ ?>
      <script src="<?php echo base_url($rows) ?>"></script>
    <?php } ?>

    </head>

    <body class="hold-transition skin-green sidebar-mini">
        <div class="wrapper">
          <header class="main-header">
              
            <a href="<?php  echo site_url('dashboard') ?>" class="logo">
              <span class="logo-mini"><img src="<?php echo base_url('assets/public/star8logo_sm.png') ?>"></span>
              <span class="logo-lg"><img src="<?php echo base_url('assets/public/star8logo_lg.png') ?>"></img></span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
              <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
              </a>
              <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- Messages: style can be found in dropdown.less-->
                  <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-envelope-o"></i>
                      <span class="label label-success">1</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header">You have 1 messages</li>
                      <li>
                        <!-- inner menu: contains the messages -->
                        <ul class="menu">
                          <li><!-- start message -->
                            <a href="#">
                              <div class="pull-left">
                                <!-- User Image -->
                                <img src="<?php echo base_url('assets/public/mcdo.gif') ?>" class="img-circle" alt="User Image">
                              </div>
                              <!-- Message title and timestamp -->
                              <h4>
                                Advertisement Owner
                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                              </h4>
                              <!-- The message -->
                              <p>Update ad duration</p>
                            </a>
                          </li>
                          <!-- end message -->
                        </ul>
                        <!-- /.menu -->
                      </li>
                      <li class="footer"><a href="#">See All Messages</a></li>
                    </ul>
                  </li>
                  <!-- /.messages-menu -->

                  <!-- Notifications Menu -->
                  <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-bell-o"></i>
                      <span class="label label-warning">0</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header">You have 0 notifications</li>
                      <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">
                          <li><!-- start notification -->
                            <a href="#">
                              <i class="fa fa-users text-aqua"></i> 0 new members joined today
                            </a>
                          </li>
                          <!-- end notification -->
                        </ul>
                      </li>
                      <li class="footer"><a href="#">View all</a></li>
                    </ul>
                  </li>

                  <!-- Tasks Menu -->
                  <li class="dropdown tasks-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-flag-o"></i>
                      <span class="label label-danger">2</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header">You have 2 tasks</li>
                      <li>
                        <!-- Inner menu: contains the tasks -->
                        <ul class="menu">
                          <li><!-- Task item -->
                            <a href="#">
                              <!-- Task title and progress text -->
                              <h3>
                                Update route
                                <small class="pull-right">20%</small>
                              </h3>
                              <!-- The progress bar -->
                              <div class="progress xs">
                                <!-- Change the css width attribute to simulate progress -->
                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                  <span class="sr-only">20% Complete</span>
                                </div>
                              </div>
                            </a>
                          </li>
                          <!-- end task item -->
                        </ul>
                      </li>
                      <li class="footer">
                        <a href="#">View all tasks</a>
                      </li>
                    </ul>
                  </li>

                  <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="<?php echo base_url('assets/public/user1.jpg') ?>" class="user-image" alt="User Image">
                      <span class="hidden-xs"><?php echo $this->session->userdata("user_fname") . " " . $this->session->userdata("user_lname");?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="user-header">
                        <img src="<?php echo base_url('assets/public/user1.jpg') ?>" class="img-circle" alt="User Image">
                        <p>
                          <?php 
                            echo $this->session->userdata("user_fname") . " " . $this->session->userdata("user_lname") . " - " . $role['role_name'];
                          ?>
                          <!-- <small>
                            Member since 
                            <?php 
                              $d = new DateTime($this->session->userdata("created_at"));
                              echo $d->format('M / d / Y') 
                            ?>
                          </small> -->
                          <small>
                            Last logged-in  
                            <?php 
                              $d = new DateTime($this->session->userdata("last_login"));
                              echo $d->format('M / d / Y') 
                            ?>
                          </small>
                        </p>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-right">
                          <a href="<?php echo site_url('login/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                      </li>
                    </ul>
                  </li>

                  <!-- Control Sidebar Toggle Button -->
                  <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                  </li>

                </ul>
              </div>
            </nav>
          </header>

          <aside class="main-sidebar">
            <section class="sidebar">
              <div class="user-panel">
                <div class="pull-left image">
                  <img src="<?php echo base_url('assets/public/user1.jpg') ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                  <p>
                    <?php 
                      echo $this->session->userdata("user_fname") . " " . $this->session->userdata("user_lname");
                    ?>
                  </p>
                  <a id="userStat" href="javascript:void(0)" onclick="toggleStatus()" data-stat="1"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
              </div>

              <!-- search form (Optional) -->
              <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                  <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                      <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                      </button>
                    </span>
                </div>
              </form>

              <ul class="sidebar-menu">
                <li class="header">Main Menu</li>
                <li id="dashboard"><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
                <!--<li id="salesman"><a href="<?php echo base_url('salesman/schedules') ?>"><i class="fa fa-calendar-check-o"></i> <span>Schedule Availability</span></a></li>-->
                <li id="program_schedule" class="treeview">
                  <a href="#"><i class="fa fa-tv"></i> <span>Program Schedule</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li id="create_program_schedule"><a href="<?php echo base_url('salesman/schedules') ?>">Schedule Availability</a></li>
                    <li id="create_program_schedule"><a href="<?php //echo base_url('schedules') ?>">New Ad Orders</a></li>
                    <!--<li id="create_program_schedule"><a href="<?php echo base_url('schedules') ?>">Ads for Scheduling</a></li>-->
                    <!--<li id="create_program_schedule"><a href="<?php echo base_url('program/create') ?>">Create Program Schedule</a></li>-->
                    <li id="browse_program_schedule"><a href="<?php echo base_url('program/browse') ?>">Browse Program Schedules</a></li>
                    <!--<li id="assign_per_route"><a href="#">Assign Per Route</a></li>
                    <li id="assign_per_bus"><a href="#">Assign Per Bus</a></li>-->
                  </ul>
                </li>
                <li id="ads_management" class="treeview">
        					<a href="#"><i class="fa fa-upload"></i> <span>Ads Management</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>					
        					</a>
                  <ul class="treeview-menu">
                    <li id="upload_new_ad"><a href="<?php echo base_url('ads_mngt/upload') ?>">Upload New Ad</a></li>
                    <li id="browse_ads"><a href="<?php echo base_url('ads_mngt/browse') ?>">Browse Ads</a></li>
                    <li id="ad_report"><a href="<?php echo base_url('ads_mngt/report') ?>">Ad Report</a></li>
                  </ul>				
        				</li>
                <li id="ad_companies" class="treeview">
        					<a href="#"><i class="fa fa-briefcase"></i> <span>Ad Companies</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>					
        					</a>
                  <ul class="treeview-menu">
                    <li id="new_advertiser"><a href="<?php echo base_url('advertisers/add') ?>">New Advertiser</a></li>
                    <li id="browse_ad_companies"><a href="<?php echo base_url('advertisers/show') ?>">Browse Advertisers</a></li>
                  </ul>				
        				</li>	
<!--
                <li id="users_management" class="treeview">
                  <a href="#"><i class="fa fa-users"></i> <span>Users Management</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li id="new_user"><a href="<?php echo base_url('users/add') ?>">New User</a></li>
                    <li id="browse_users"><a href="<?php echo base_url('users/browse') ?>">Browse Users</a></li>
                    <li id="new_driver"><a href="<?php echo base_url('drivers/add') ?>">New Driver</a></li>
                    <li id="browse_drivers"><a href="<?php echo base_url('drivers/browse') ?>">Browse Drivers</a></li>
                  </ul>
                </li>
-->
<!--
                <li id="vehicle_management" class="treeview">
                  <a href="#"><i class="fa fa-bus"></i> <span>Vehicle Management</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li id="new_vehicle"><a href="<?php echo base_url('vehicles/add') ?>">New Vehicle</a></li>
                    <li id="browse_vehicles"><a href="<?php echo base_url('vehicles/browse') ?>">Browse Vehicles</a></li>

                    <li id="new_tv"><a href="<?php echo base_url('tvs/add') ?>">New TV</a></li>
                    <li id="browse_tvs"><a href="<?php echo base_url('tvs/browse') ?>">Browse TVs</a></li>

                    <li id="new_mediabox"><a href="<?php echo base_url('mediaboxes/add') ?>">New Mediabox</a></li>
                    <li id="browse_mediaboxes"><a href="<?php echo base_url('mediaboxes/browse') ?>">Browse Mediaboxes</a></li>

                    <li id="assign_media"><a href="<?php echo base_url('media/assign') ?>">Assign Media</a></li>
                    <li id="browse_assignment"><a href="<?php echo base_url('media/browse') ?>">Browse Assignment</a></li>
                  </ul>
                </li>
-->
                <li id="route_management" class="treeview">
                  <a href="#"><i class="fa fa-road"></i> <span>Route Management</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li id="browse_routes"><a href="<?php echo base_url('routes/browse') ?>">Routes</a></li>

                    <li id="locations"><a href="<?php echo base_url('locations/browse') ?>">Locations</a></li>

                    <li id="browse_cities"><a href="<?php echo base_url('cities/browse') ?>">Cities</a></li>

                    <li id="browse_regions"><a href="<?php echo base_url('regions/browse') ?>">Regions</a></li>
                  </ul>
                </li>
                <li id="settings" class="treeview">
                  <a href="#"><i class="fa fa-gear"></i> <span>Settings</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    
                      
                    <li id="browse_users"><a href="<?php echo base_url('users/browse') ?>">Users</a></li>
                      
                    <li id="browse_drivers"><a href="<?php echo base_url('drivers/browse') ?>">Drivers</a></li>
                      
                    <li id="browse_vehicles"><a href="<?php echo base_url('vehicles/browse') ?>">Vehicles</a></li>

                    <li id="browse_tvs"><a href="<?php echo base_url('tvs/browse') ?>">TVs</a></li>

                    <li id="browse_mediaboxes"><a href="<?php echo base_url('mediaboxes/browse') ?>">Mediaboxes</a></li>
					
                    <li id="browse_cardreaders"><a href="<?php echo base_url('cardreaders/browse') ?>">Card Readers</a></li>
					
                    <li id="browse_posdevices"><a href="<?php echo base_url('posdevices/browse') ?>">POS Devices</a></li>

                    <li id="browse_assignment"><a href="<?php echo base_url('media/browse') ?>">Media Assignment</a></li>
                  </ul>
                </li>
                <li id="live_monitoring" class="treeview">
                  <a href="#"><i class="fa fa-eye"></i> <span>Live Monitoring</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li id="active_buses"><a href="#">Active Buses</a></li>
                  </ul>
                </li>
              </ul>

            </section>
          </aside>

          <!-- TAGGING PAUL -->
          <div class="modal fade" id="successModal" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Success!</h4>
                </div>
                <div class="modal-body">
                  <p id="message-text"></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <script type="text/javascript">$('#successModal').on('hidden.bs.modal',function(){window.location.reload();})</script>

          <!-- TAGGING PAUL -->
          <div class="modal fade" id="errorModal" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header alert alert-danger">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Error!</h4>
                </div>
                <div class="modal-body">
                  <p id="error-text"></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          
          <div class="content-wrapper">
            <section class="content-header">
              <h1>
                <?php echo $title; ?>
                <small><?php echo $page_description; ?></small>
              </h1>
              <ol class="breadcrumb">
                <i class="fa fa-user-plus"></i>&nbsp;
                <?php foreach($breadcrumbs as $row) { ?>
                  <li><a href="<?php echo base_url($row[1]) ?>"><?php echo $row[0]; ?></a></li>
                <?php } ?>
                <li class="active">Here</li>
              </ol>
            </section>

            <section class="content">

            <script type="text/javascript">
              $(document).ready(function() {
                 $('#<?php echo $treeActive; ?>').addClass('active');
                 $('#<?php echo $childActive; ?>').addClass('active');
              });

              function toggleStatus() {
                var user_status = $('#userStat').data("stat");
                switch(user_status)
                {
                  case 0: 
                    $('#userStat').data("stat", 1);
                    $('#userStat').html("<i class='fa fa-circle'></i> Online");
                    $('#userStat i').addClass('text-success');
                    $('#userStat i').removeClass('text-danger');
                    break;
                  case 1: 
                    $('#userStat').data("stat", 0);
                    $('#userStat').html("<i class='fa fa-circle'></i> Offline");
                    $('#userStat i').addClass('text-danger');
                    $('#userStat i').removeClass('text-success');
                    break;
                }
                toggleStat($('#userStat').data("stat"));
              }

              function toggleStat(status) {
                $.ajax({
                  url: "<?php echo site_url('users/toggleStatus') ?>",
                  type: 'POST',
                  dataType: 'json',
                  data: 'is_online='+status,
                  encode:true,
                });
              }
            </script>