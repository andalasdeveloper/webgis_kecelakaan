<?php include 'ti.php' ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>ACCIDENT | <?php startblock('title') ?><?php endblock() ?></title>

    <!-- Bootstrap core CSS -->
    <link href="/Basisdatalanjut/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="/Basisdatalanjut/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/css/zabuto_calendar.css"> -->
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/lineicons/style.css">
    
    <!-- Custom styles for this template -->
    <link href="/Basisdatalanjut/assets/css/style.css" rel="stylesheet">
    <link href="/Basisdatalanjut/assets/css/style-responsive.css" rel="stylesheet">

    <script src="/Basisdatalanjut/assets/js/chart-master/Chart.js"></script>
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
        <a href="#" class="logo"><b>Kecelakaan</b></a>
        <!--logo end-->
<!--        <div class="top-menu">-->
<!--          <ul class="nav pull-right top-menu">-->
<!--                <li><a class="logout" href="#">Logout</a></li>-->
<!--          </ul>-->
<!--        </div>-->
      </header>
      <!--header end-->

      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <p class="centered"><!--<a href="profile.html">--><img style="background-color: #E0FF84" src="/Basisdatalanjut/assets/img/avatar/guest.png" class="img-circle" width="60"><!--</a>--></p>
                  <h5 class="centered">guest</h5>

                  <li class="sub-menu">
                    <a class="" href="javascript:;">
                        <i class="fa fa-thumb-tack"></i>
                        <span>Accident By Radius</span>
                    </a>
                    <ul class="treeview-menu">
                        <div class=" form-group" style="color: white;"> <br>
                          <label for="inputradiuss">Radius : </label>
                          <label  id="nilai">0</label> m
                          <script>
                            function cekkk()
                            {
                              document.getElementById('nilai').innerHTML=
                              document.getElementById('inputradiuss').value*100
                            }
                          </script>
                          <input  type="range" onchange="cekkk();aktifkanRadiuss()" id="inputradiuss" 
                                  name="inputradiuss" data-highlight="true" min="0" max="20" value="0" >
                        </div>
                      </ul>
                  </li>

                  <li class="sub-menu">
                    <a class="" href="javascript:;" onclick="tampilsemua();resultt()">
                      <i class="fa fa-map-marker"></i>
                      <span>Show All Accident</span>
                    </a>
                  </li>
                  
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-search"></i>
                          <span>Accident By Detail</span>
                      </a>
                      <ul class="sub">
                          <li><a href="javascript:;" onclick="kecelakaan_mobil();resultt()"><i class="fa fa-circle"></i>Car Accident</a></li>
                          <li><a href="javascript:;" onclick="kecelakaan_motor();resultt()"><i class="fa fa-circle"></i>Motorcycle Accident</a></li>
                      </ul>


                  </li>

                  <li class="sub-menu">
                <a href="javascript:;" >
                  <i class="fa fa-search"></i>
                  <span>Name Victim</span>
                </a>
                <ul class="sub">
                  <div class=" form-group">
                    <li>
                      <div class="search">
                        <div class="col-md-15 padding-0 text-center">
                         <div class="form-group form-animate-text"><br>
                          <input type="text"  class="form-text" placeholder="...." id="nama_korban" name="nama_korban" required>
                            <span class="bar"></span> 
                        </div>         
                       <button type="submit" class="btn btn-info btn-block btn-flat" id="kul_button" value="nama_korban" onclick='find_korban();resultt()'>Search</button>
                     </div> 
                     </div> 
                    </li>
                  </div>         
                </ul>
                </li>
                  
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->

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
              2018 - Tugas Basis Data Lanjut 
              <a href="#main-content" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="/Basisdatalanjut/assets/js/jquery.js"></script>
    <script src="/Basisdatalanjut/action/scripts.js" type="text/javascript"></script>
    <script src="/Basisdatalanjut/assets/js/jquery-1.8.3.min.js"></script>
    <script src="/Basisdatalanjut/assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="/Basisdatalanjut/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="/Basisdatalanjut/assets/js/jquery.scrollTo.min.js"></script>
    <script src="/Basisdatalanjut/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="/Basisdatalanjut/assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="/Basisdatalanjut/assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="/Basisdatalanjut/assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="/Basisdatalanjut/assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="/Basisdatalanjut/assets/js/sparkline-chart.js"></script>    
   
    <?php startblock('js') ?> <?php endblock() ?>
  </body>
</html>





