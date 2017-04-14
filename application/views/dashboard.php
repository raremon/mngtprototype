<!DOCTYPE html>
<html>
    
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Star8 | <?php echo $title; ?></title>

      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!--LINKS-->
      <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
      <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css') ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/css/skins/skin-green.css') ?>">

      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

    <body class="hold-transition skin-green sidebar-mini">
        <div class="wrapper">
          <header class="main-header">
              
            <!-- Logo -->
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
                  <!-- User Account Menu -->
                  <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <!-- The user image in the navbar-->
                      <img src="<?php echo base_url('assets/public/user1.jpg') ?>" class="user-image" alt="User Image">
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                      <span class="hidden-xs"><?php echo $this->session->userdata("user_fname") . " " . $this->session->userdata("user_lname");?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- The user image in the menu -->
                      <li class="user-header">
                        <img src="<?php echo base_url('assets/public/user1.jpg') ?>" class="img-circle" alt="User Image">

                        <p>
                          <?php 
                            echo $this->session->userdata("user_fname") . " " . $this->session->userdata("user_lname") . " - " . $role['role_name'];
                          ?>
                          <small>
                            Member since 
                            <?php 
                              $d = new DateTime($this->session->userdata("created_at"));
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
          <!-- Left side column. contains the logo and sidebar -->
          <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

              <!-- Sidebar user panel (optional) -->
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
                  <!-- Status -->
                  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
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
              <!-- /.search form -->

              <!-- Sidebar Menu -->
              <ul class="sidebar-menu">
                <li class="header">Main Menu</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="active"><a href="dashboard.html"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-tv"></i> <span>Program Schedule</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#">Per Route</a></li>
                    <li><a href="#">Per Bus</a></li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-upload"></i> <span>Upload Ads</span></a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-users"></i> <span>Manage Users</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#">Add User</a></li>
                    <li><a href="#">Delete User</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-bus"></i> <span>Manage Buses</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#">Bus Routes</a></li>
                    <li><a href="#">Bus Tables</a></li>
                  </ul>
                </li>
              </ul>
              <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
          </aside>

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                Dashboard
                <small>Summary of data</small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Here</li>
              </ol>
            </section>

            <!-- Main content -->
            <section class="content">

              <!-- Your Page Content Here -->

            </section>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->

          <!-- Main Footer -->
          <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
              Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2016 <a href="#">Star8</a>.</strong> All rights reserved.
          </footer>

          <!-- Control Sidebar -->
          <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
              <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
              <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <!-- Home tab content -->
              <div class="tab-pane active" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                  <li>
                    <a href="javascript:;">
                      <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                      <div class="menu-info">
                        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                        <p>Will be 23 on April 24th</p>
                      </div>
                    </a>
                  </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                  <li>
                    <a href="javascript:;">
                      <h4 class="control-sidebar-subheading">
                        Custom Template Design
                        <span class="pull-right-container">
                          <span class="label label-danger pull-right">70%</span>
                        </span>
                      </h4>

                      <div class="progress progress-xxs">
                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                      </div>
                    </a>
                  </li>
                </ul>
                <!-- /.control-sidebar-menu -->

              </div>
              <!-- /.tab-pane -->
              <!-- Stats tab content -->
              <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
              <!-- /.tab-pane -->
              <!-- Settings tab content -->
              <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                  <h3 class="control-sidebar-heading">General Settings</h3>

                  <div class="form-group">
                    <label class="control-sidebar-subheading">
                      Report panel usage
                      <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                      Some information about this general settings option
                    </p>
                  </div>
                  <!-- /.form-group -->
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
          </aside>
          <!-- /.control-sidebar -->
          <!-- Add the sidebar's background. This div must be placed
               immediately after the control sidebar -->
          <div class="control-sidebar-bg"></div>
        </div>
    <!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url('assets/js/jquery-2.2.3.min.js') ?>"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/js/app.min.js') ?>"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
    </body>
</html>
