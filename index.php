<?php

//To Handle Session Variables on This Page
session_start();


//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Work Finder</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="css/custom.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition  ">
<div class="container-fluid">

    <!-- Logo -->
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar navbar-default navbar-fixed-top">
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
	   <ul class="nav navbar-nav navbar-left">
			<li>
				<a href="index.php" class="logo">
				  <!-- logo for regular state and mobile devices -->
				  <span><b class="logo-cl">Work</b> Finder</span>
				</a>
			</li>
		</ul>
        <ul class="nav navbar-nav navbar-right">
<li>
            <a class="header_bold" href="#company">POST A JOBS</a>
          </li>		
          <li>
            <a href="jobs.php">FIND A JOBS</a>
          </li>
          

          <?php if(empty($_SESSION['id_user']) && empty($_SESSION['id_company'])) { ?>
          <li>
            <a href="login.php"> LOG IN <i class="fa fa-sign-in" aria-hidden="true"></i></a>
          </li>
          <li>
            <a href="sign-up.php">SING UP <i class="fa fa-address-book-o" aria-hidden="true"></i></a>
          </li>  
          <?php } else { 

            if(isset($_SESSION['id_user'])) { 
          ?>        
          <li>
            <a href="user/index.php">Dashboard</a>
          </li>
          <?php
          } else if(isset($_SESSION['id_company'])) { 
          ?>        
          <li>
            <a href="company/index.php">Dashboard</a>
          </li>
          <?php } ?>
          <li>
            <a href="logout.php">Logout</a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </nav>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px;">

    <section class="content-header bg-main">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center index-head">
            <h1>All <strong>JOBS</strong> In One Place</h1>
            <p>One search, global reach</p>
            <p><a class="btn btn-success btn-lg" href="jobs.php" role="button">Search Jobs</a></p>
          </div>
        </div>
      </div>
    </section>

    <section class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 latest-job margin-bottom-20">
            <h2 class="text-center">OUR LATEST JOBS</h2>            
            <?php 
          /* Show any 4 random job post
           * 
           * Store sql query result in $result variable and loop through it if we have any rows
           * returned from database. $result->num_rows will return total number of rows returned from database.
          */
          $sql = "SELECT * FROM job_post Order By Rand() Limit 6";
          $result = $conn->query($sql);
          if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) 
            {
              $sql1 = "SELECT * FROM company WHERE id_company='$row[id_company]'";
              $result1 = $conn->query($sql1);
              if($result1->num_rows > 0) {
                while($row1 = $result1->fetch_assoc()) 
                {
             ?>
            <div class="attachment-block clearfix">
              <img class="attachment-img" src="img/photo1.png" alt="Attachment Image">
              <div class="attachment-pushed">
                <h4 class="attachment-heading"><a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle']; ?></a> <span class="attachment-heading pull-right">$<?php echo $row['maximumsalary']; ?>/Month</span></h4>
			<div>
              <?php echo stripcslashes($row['description']); ?>
            </div>
                <div class="attachment-text">
                    <div><i class="fa fa-building"></i><strong class="jobrequirment"> <?php echo $row1['companyname']; ?> </strong> <i class="fa fa-map-marker" aria-hidden="true"></i><strong class="jobrequirment"> <?php echo $row1['city']; ?> </strong><strong class="jobrequirment"> | Experience: <?php echo $row['experience']; ?> years</strong> <a class="apply-now" href="login-candidate.php">APPLY NOW</a></div>
                </div>
              </div>
            </div>
          <?php
              }
            }
            }
          }
          ?>

          </div>
        </div>
      </div>
    </section>

    <section id="candidates" class="candidates content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h2>How it works</h2>           
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-6">
			<div class="media">
			  <div class="media-left">
				<a href="#">
				  <img class="media-object" src="img/find.svg" alt="...">
				</a>
			  </div>
			  <div class="media-body">
				<h4 class="media-heading">1.Post Your Project</h4>
				Tell us about your project. We will connects you with top talent and agencies around the world, or near you.
			  </div>
			</div>
          </div>
          <div class="col-sm-12 col-md-6">
			<div class="media">
			  <div class="media-left">
				<a href="#">
				  <img class="media-object" src="img/hire.svg" alt="...">
				</a>
			  </div>
			  <div class="media-body">
				<h4 class="media-heading">3.Chose A Canditate </h4>
				Get qualified proposals within 24 hours. Compare Canditate, reviews, and prior work. Interview favorites and hire the best fit.
			  </div>
			</div>
          </div>
        </div>
		<div class="row">
		<hr>
		</div>
		<div class="row"></div>
        <div class="row">
          <div class="col-sm-12 col-md-6">
			<div class="media">
			  <div class="media-left">
				<a href="#">
				  <img class="media-object" src="img/work.svg" alt="...">
				</a>
			  </div>
			  <div class="media-body">
				<h4 class="media-heading">2. Find and Interview</h4>
				Tell us about your project. We will connects you with top talent and agencies around the world, or near you.
			  </div>
			</div>
          </div>
          <div class="col-sm-12 col-md-6 margin-bottom-20">
			<div class="media">
			  <div class="media-left">
				<a href="#">
				  <img class="media-object" src="img/pay.svg" alt="...">
				</a>
			  </div>
			  <div class="media-body">
				<h4 class="media-heading">4. Payment simplified </h4>
				Pay hourly or fixed-price and receive invoices through Upwork. Pay for work you authorize.
			  </div>
			</div>
          </div>
        </div>
      </div>
    </section>

    <section id="statistics" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h2>Our Statistics</h2>
          </div>
        </div>
        <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
               <?php
                      $sql = "SELECT * FROM job_post";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3><?php echo $totalno; ?></h3>

              <p>Job Offers</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
               <?php
                      $sql = "SELECT * FROM company WHERE active='1'";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3><?php echo $totalno; ?></h3>

              <p>Registered Company</p>
            </div>
            <div class="icon">
                <i class="ion ion-briefcase"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php
                      $sql = "SELECT * FROM users WHERE resume!=''";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3><?php echo $totalno; ?></h3>

              <p>CV'S/Resume</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-list"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
               <?php
                      $sql = "SELECT * FROM users WHERE active='1'";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3><?php echo $totalno; ?></h3>

              <p>Daily Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      </div>
    </section>
	<div class="row">
	
	</div>
    <section id="company" class=" company content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-6 latest-job margin-bottom-20">
            <h2>How to Clind Save Thousant <br>Dollar</h2>
			<p><em>"Work Finder took a lot of stress off of growing <br>with minimal resources"</em></p>
			
			<div class="media">
			  <div class="media-left">
				<a href="#">
				  <img class="media-object clind_pic" src="img/user8-128x128.jpg" alt="...">
				</a>
			  </div>
			  <div class="media-body">
				<h4 class="media-heading">Mahmudul Hasan</h4>
				CEO and co-founder, FiduWeb
			  </div>
			</div>
          </div>
		  
		   <div class="col-md-6 margin-bottom-20">
			<div class="vid">
			<iframe width="460" height="300" src="https://www.youtube.com/embed/DMRTOpfk-tg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
          </div>
        </div>

    </section>


    <section id="about" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h1>About US</h1>                      
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <img src="img/browse.jpg" class="img-responsive">
          </div>
          <div class="col-md-6 about-text margin-bottom-20">
            <p>The online job portal application allows job seekers and recruiters to connect.The application provides the ability for job seekers to create their accounts, upload their profile and resume, search for jobs, apply for jobs, view different job openings. The application provides the ability for companies to create their accounts, search candidates, create job postings, and view candidates applications.
            </p>
            <p>
              This website is used to provide a platform for potential candidates to get their dream job and excel in yheir career.
              This site can be used as a paving path for both companies and job-seekers for a better life .
              
            </p>

          </div>
        </div>
      </div>
    </section>

  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer" style="margin-left: 0px;">
    <div class="text-center">
      <strong>Copyright &copy; 2020-2021 <a href="https://web.facebook.com/mahmud.918">Work Finder</a>.</strong> All rights
    reserved.
    </div>
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
</body>
</html>
