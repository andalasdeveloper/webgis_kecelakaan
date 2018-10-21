<?php include 'ti.php' ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>SI PARIWISATA - BUKITTINGGI | <?php startblock('title') ?><?php endblock() ?></title>

    <!-- Bootstrap core CSS -->
    <link href="/ta_pariwisata/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="/ta_pariwisata/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" type="text/css" href="/ta_pariwisata/assets/css/zabuto_calendar.css"> -->
    <link rel="stylesheet" type="text/css" href="/ta_pariwisata/assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="/ta_pariwisata/assets/lineicons/style.css">
    
    <!-- Custom styles for this template -->
    <link href="/ta_pariwisata/assets/css/style.css" rel="stylesheet">
    <link href="/ta_pariwisata/assets/css/style-responsive.css" rel="stylesheet">

    <script src="/ta_pariwisata/assets/js/chart-master/Chart.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNnzxae2AewMUN0Tt_fC3gN38goeLVdVE"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php startblock('css') ?> <?php endblock() ?>
  </head>

  <body>
    <section id="container" >
      <!--header start-->
      <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <a href="#" class="logo"><b>PARIWISATA</b></a>
        <!--logo end-->
        <div class="top-menu">
          <ul class="nav pull-right top-menu">
                <li><a class="logout" href="#">Logout</a></li>
          </ul>
        </div>
      </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><a href="profile.html"><img src="/ta_pariwisata/assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
                  <h5 class="centered">Marcel Newman</h5>
                    
                  <!-- <li class="mt">
                    <a class="active" href="/ta_pariwisata/layout/dashboard.php">
                      <i class="fa fa-dashboard"></i>
                      <span>Dashboard</span>
                    </a>
                  </li> -->

                  <li class="sub-menu">
                    <a class="" href="javascript:;" onclick="tampilsemua();resultt()">
                      <i class="fa fa-map-marker"></i>
                      <span>Show All SPA</span>
                    </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-search"></i>
                          <span>Search By</span>
                      </a>
                      <ul class="sub">
                          <li><a href="#"><i class="fa fa-sort-alpha-asc"></i>Name</a></li>
                          
                          <li><a href="#">Discount</a></li>
                          
                          <li><a href="#">Facility</a></li>
                          
                          <li><a href="#"><i class="fa fa-cogs"></i>Sub-District</a></li>
                          
                          <li><a href="#"><i class="fa fa-car"></i>Transportation</a></li>
                          
                          <li><a  href="#"><i class="fa fa-train"></i>Public Transportation</a></li>
                      </ul>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <?php startblock('body') ?><?php endblock() ?>
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2018 - Yudha Restu Alditya
              <a href="#main-content" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="/ta_pariwisata/assets/js/jquery.js"></script>
    <script src="/ta_pariwisata/action/scripts.js" type="text/javascript"></script>
    <script src="/ta_pariwisata/assets/js/jquery-1.8.3.min.js"></script>
    <script src="/ta_pariwisata/assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="/ta_pariwisata/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="/ta_pariwisata/assets/js/jquery.scrollTo.min.js"></script>
    <script src="/ta_pariwisata/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="/ta_pariwisata/assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="/ta_pariwisata/assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="/ta_pariwisata/assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="/ta_pariwisata/assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="/ta_pariwisata/assets/js/sparkline-chart.js"></script>    
    <!-- <script src="/ta_pariwisata/assets/js/zabuto_calendar.js"></script> -->
    
    <!-- <script type="text/javascript">
          $(document).ready(function () {
            var unique_id = $.gritter.add({
              // (string | mandatory) the heading of the notification
              title: 'Welcome to SI PARIWISATA!',
              // (string | mandatory) the text inside the notification
              text: 'Hover me to enable the Close Button',
              // (string | optional) the image to display on the left
              image: '/ta_pariwisata/assets/img/ui-sam.jpg',
              // (bool | optional) if you want it to fade out on its own or just sit there
              sticky: true,
              // (int | optional) the time you want it to be alive for before fading out
              time: '0.5',
              // (string | optional) the class name you want to apply to that specific message
              class_name: 'my-sticky-class'
            });
            return false;
          });
    </script> -->
    <?php startblock('js') ?> <?php endblock() ?>
  </body>
</html>
