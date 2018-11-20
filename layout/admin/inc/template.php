<?php
session_start();
if(!isset($_SESSION['A'])){
    echo"<script language='JavaScript'>document.location='login.php'</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mosque Finder</title>

    <link href="/ta_pariwisata/assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="/ta_pariwisata/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="/ta_pariwisata/assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="/ta_pariwisata/assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="/ta_pariwisata/assets/lineicons/style.css">
    <link href="/ta_pariwisata/assets/css/style.css" rel="stylesheet">
    <link href="/ta_pariwisata/assets/css/style-responsive.css" rel="stylesheet">
    <script src="inc/script.js" type="text/javascript"></script>
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDM2fDXHmGzCDmDBk3bdPIEjs6zwnI1kGQ&libraries=drawing"></script>
    <script src="/ta_pariwisata/assets/js/chart-master/Chart.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/js/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="../assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="../assets/js/bootstrap-daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="../assets/js/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="../assets/js/bootstrap-datetimepicker/datertimepicker.html" />
    <link rel="stylesheet" type="text/css" href="../assets/css/skin/_all-skins.css" />

</head>

<body>

<section id="container" >
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>

        </div>
        <header class="header black-bg">

            <a class="logo"><p><img src="/ta_pariwisata/assets/ico/111.png"><b>W</b>EB<b style="font-size: 17px">GIS</b>&nbspADMIN</p></a>
            <ul class="nav pull-right top-menu">
                <a href="act/logout.php" class="logo" style="font-size:14px"><i class="fa fa-sign-in"></i>
                    <b>Logout</b></a>
            </ul>
        </header>
    </header>
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <ul class="sidebar-menu" id="nav-accordion">

                <p class="centered"><a href="profile.html"><img src="../assets/img/fr-10.jpg" class="img-circle" width="60"></a></p>
                <h5 class="centered"><p><?php echo $_SESSION['username']; ?></p></h5>

                <li class="mt">
                    <a href="../")">
                    <i class="fa fa-book"></i>
                    <span>User Access</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="./")">
                    <i class="fa fa-tasks"></i>
                    <span>Dashboard</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="?page=homeadmin">
                        <i class="fa fa-dashboard"></i>
                        <span>List Mosque</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="?page=listkeg">
                        <i class="fa fa-tasks"></i>
                        <span>Event</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="?page=fasilitas">
                        <i class="fa fa-book"></i>
                        <span>Facility</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="?page=listustad">
                        <i class="fa fa-tasks"></i>
                        <span>Ustad</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="?page=listpengurus">
                        <i class="fa fa-tasks"></i>
                        <span>User Management</span>
                    </a>
                </li>

            </ul>
        </div>
    </aside>

    <section id="main-content">
        <section class="wrapper">
            <div class="row mt">
                <?php
                $p=$_GET['page'];
                $page="pages/".$p.".php";
                if(file_exists($page)){
                    include($page);
                }elseif($p==""){
                    include('pages/info.php');
                }else{
                    include('pages/404.php');
                }
                ?>
            </div>
        </section>
    </section>

</section>
<!-- js placed at the end of the document so the pages load faster -->
<script src="/ta_pariwisata/assets/js/jquery.js"></script>
<script src="/ta_pariwisata/assets/js/jquery-1.8.3.min.js"></script>
<script src="/ta_pariwisata/assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="/ta_pariwisata/assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="/ta_pariwisata/assets/js/jquery.scrollTo.min.js"></script>
<script src="/ta_pariwisata/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="/ta_pariwisata/assets/js/jquery.sparkline.js"></script>
<script src="/ta_pariwisata/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<!--common script for all pages-->
<script src="/ta_pariwisata/assets/js/common-scripts.js"></script>

<script type="text/javascript" src="/ta_pariwisata/assets/js/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="/ta_pariwisata/assets/js/gritter-conf.js"></script>
<script src="/ta_pariwisata/ assets/js/jquery-ui-1.9.2.custom.min.js"></script>

<script type="text/javascript" src="/ta_pariwisata/assets/js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="/ta_pariwisata/assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="/ta_pariwisata/assets/js/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="/ta_pariwisata/assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="/ta_pariwisata/assets/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="/ta_pariwisata/assets/js/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="/ta_pariwisata/assets/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script src="/ta_pariwisata/assets/js/advanced-form-components.js"></script>
<script type="text/javascript">
    $(function () {
        $('#example1, #example2, #example3').dataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
            "iDisplayLength": 10,
            "oLanguage": {
                "sInfo": "Showing _START_ to _END_ of _TOTAL_ entries",
                "sLengthMenu": "Show _MENU_ entries",
                "sSearch": "Search:"
            }
        });
    });
</script>
</body>
</html>
