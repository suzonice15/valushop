<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

	<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/fullcalendar/dist/fullcalendar.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/select2/dist/css/select2.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

  <!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body  class="skin-blue fixed sidebar-mini sidebar-mini-expand-feature"  onload="set_interval()"
       onmousemove="reset_interval()"
       onclick="reset_interval()"
       onkeypress="reset_interval()"
       onscroll="reset_interval()" style="height: auto; min-height: 100%;">
<div class="wrapper">
<header class="main-header">


    <!-- Logo -->
    <a href="<?php echo base_url()?>dashboard" class="logo">
		<?php
		$userRole=$this->session->userdata('user_role');
		if($userRole==1){
		echo 'Admin Panel';
		}
		else if($userRole==2){
			echo 'Teacher Panel';
		} else {
			echo 'Student Panel';
		}
		?>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">


          <li class="dropdown user user-menu">


            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

				<?php  if($this->session->userdata('teacher_picture_path')){ ?>
					<img  class="user-image"  src="<?php echo base_url(); ?><?php echo $this->session->userdata('teacher_picture_path')?>" class="img-circle"
						 alt="<?php echo $this->session->userdata('teacher_full_name')?>">
				<?php }  else { ?>

					<img  class="user-image"  src="<?php echo base_url(); ?><?php echo $this->session->userdata('student_picture_path')?>" class="img-circle"
						 alt="<?php echo $this->session->userdata('student_name')?>">
				<?php } ?>

            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
				  <?php  if($this->session->userdata('teacher_picture_path')){ ?>
					  <img   class="img-circle"  src="<?php echo base_url(); ?><?php echo $this->session->userdata('teacher_picture_path')?>" class="img-circle"
							alt="<?php echo $this->session->userdata('teacher_full_name')?>">
				  <?php }  else { ?>

					  <img  class="img-circle"  src="<?php echo base_url(); ?><?php echo $this->session->userdata('student_picture_path')?>" class="img-circle"
							alt="<?php echo $this->session->userdata('student_name')?>">
				  <?php } ?>
<!--                <img src="--><?php //echo base_url();?><!--assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->

                <p>
					<?php

					if($userRole==2 or $userRole==1):
						if(($this->session->userdata('teacher_full_name'))) :
							echo $this->session->userdata('teacher_full_name');
						else :
							echo $this->session->userdata('student_name');
						endif;
						?>

					- <?php echo 'Teacher';?>
                  <small>Member since <?php echo $this->session->userdata('user_join_date');?></small>
					<?php else :
					if(($this->session->userdata('student_name'))) :
					echo $this->session->userdata('student_name');
					else :
					echo $this->session->userdata('student_name');
					endif;
					?>

					- <?php echo 'Student';?>
					<small>Member since <?php echo $this->session->userdata('user_join_date');?></small>
					<?php endif; ?>
                </p>
              </li>

<!--              <li class="user-body">-->
<!--                <div class="row">-->
<!--                  <div class="col-xs-4 text-center">-->
<!--                    <a href="#">Followers</a>-->
<!--                  </div>-->
<!--                  <div class="col-xs-4 text-center">-->
<!--                    <a href="#">Sales</a>-->
<!--                  </div>-->
<!--                  <div class="col-xs-4 text-center">-->
<!--                    <a href="#">Friends</a>-->
<!--                  </div>-->
<!--                </div>-->
<!--              -->
<!--              </li>-->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
<!--                  <a href="--><?php //echo base_url()?><!--profile" class="btn btn-default btn-flat">Profile</a>-->
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url()?>website-logout" class="btn btn-default btn-flat">Sign out</a>
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
