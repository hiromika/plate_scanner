<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Project</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom icon font-->
    <link rel="stylesheet" href="assets/css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="assets/css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="assets/css/style.pink.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="assets/css/custom.css">
    <!-- datables -->
    <link rel="stylesheet" href="assets/css/jquery.dataTables.css">

    <link rel="stylesheet" href="assets/fancybox/jquery.fancybox-1.3.4.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="assets/favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <script src="assets/js/jquery-2.2.3.min.js"></script>
    <script src="assets/js/jquery-migrate-1.4.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/dataTables.bootstrap.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script>
    !window.jQuery && document.write('<script src="assets/fancybox/jquery-1.4.3.min.js"><\/script>');
    </script>
    <script src="assets/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <script src="assets/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
  </head>
<body>

<?php 
session_start();
require_once 'koneksi.php';
	$ses = $_SESSION['user'];

    if($proses->is_loggedin()==""){
      $proses->redirect('index.php');
    }
	
	if(isset($_GET['logout']) && $_GET['logout']=="true"){
		$proses->logout();
		$proses->redirect('index.php');
	}


 ?>
 <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <div class="sidenav-header-inner text-center"><!-- <img src="img/avatar-1.jpg" alt="person" class="img-fluid rounded-circle"> -->
            <h2 class="h5 text-uppercase"><?php echo $ses['username'];  ?></h2><!-- <span class="text-uppercase">Web Developer</span> -->
          </div>
          <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>P</strong><strong class="text-primary">T</strong></a></div>
        </div>
 
        <div class="admin-menu">
          <ul id="side-admin-menu" class="side-menu list-unstyled"> 
            <li> <a href="home.php?link=dashboard"> <i class="icon-home"> </i><span>Dashboard</span></a></li>
            <li> <a href="#pages-nav-list" data-toggle="collapse" aria-expanded="false"><i class="icon-interface-windows"></i><span>Master</span>
                <div class="arrow pull-right"><i class="fa fa-angle-down"></i></div></a>
              <ul id="pages-nav-list" class="collapse list-unstyled">
                <li> <a href="home.php?link=m_login">User</a></li>
                <li> <a href="home.php?link=m_users">Data Pengendara</a></li>
              </ul>
            </li>
            <li> <a href="home.php?link=m_parkir"> <i class="icon-home"> </i><span>Histori Parkir</span></a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="page home-page">
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid" style="padding-left: 20px !important;">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a>
              <a href="#" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block">
                  <strong class="text-primary">Welcome</strong>
                  </div>
              </a>
              </div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
               
                <li class="nav-item"><a href="home.php?logout=true" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>

   	 <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row">
        		
        	<?php 

        	$link = $_GET['link'];

        	switch ($link) {
        		case 'dashboard':
        			include 'dashboard.php';
        			break;
        		case 'm_users':
        			include 'm_users.php';
        			break;
            case 'm_login':
              include 'login_manage.php';
              break;
            case 'm_parkir':
              include 'parkir_manage.php';
              break;
        		default:
        			# code...
        			break;
        	}

        	?>

          </div>
        </div>
     </section>

   <!-- Javascript files-->
    <script src="assets/js/jquery-2.2.3.min.js"></script>
    <script src="assets/js/jquery-migrate-1.4.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/dataTables.bootstrap.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    
    <script src="assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="assets/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="assets/js/front.js"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
    <!---->

</body>
</html>