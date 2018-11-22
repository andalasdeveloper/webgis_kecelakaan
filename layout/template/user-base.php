<?php
session_start();
if(!isset($_SESSION['P'])){
    echo"<script language='JavaScript'>document.location='/Basisdatalanjut/layout/login.php'</script>";
    exit();
}
include("/Basisdatalanjut/action/connect.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mosque Finder</title>

    <link href="/Basisdatalanjut/assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="/Basisdatalanjut/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/lineicons/style.css">
    <link href="/Basisdatalanjut/assets/css/style.css" rel="stylesheet">
    <link href="/Basisdatalanjut/assets/css/style-responsive.css" rel="stylesheet">
    <script src="mapedit.js" type="text/javascript"></script>
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNnzxae2AewMUN0Tt_fC3gN38goeLVdVE&sensor=true&libraries=drawing&callback="  async defer"></script>
    <script src="/Basisdatalanjut/assets/js/chart-master/Chart.js"></script>
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/js/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/js/bootstrap-daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/js/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/js/bootstrap-datetimepicker/datertimepicker.html" />


</head>

<body>

<section id="container" >
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <header class="header black-bg">
            <a class="logo"><p><img src="/Basisdatalanjut/assets/ico/111.png"><b>W</b>EB<b style="font-size: 17px">GIS</b>&nbspADMIN</p></a>
            <ul class="nav pull-right top-menu">
                <a href="/Basisdatalanjut/action/auth/logout.php" class="logo" style="font-size:14px"><i class="fa fa-sign-in"></i><b>Logout</b></a>
            </ul>
        </header>
    </header>
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <?php require '/Basisdatalanjut/data/viewdatamas.php'; ?>
            <ul class="sidebar-menu" id="nav-accordion">

                <p class="centered"><a href="profile.html"><img src="/Basisdatalanjut/assets/img/fr-10.jpg" class="img-circle" width="60"></a></p>
                <h5 class="centered"><p><?php echo $_SESSION['name']; ?></p></h5>

                <li class="mt">
                    <a href="../")">
                    <i class="fa fa-book"></i>
                    <span>User Access</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="?page=content">
                        <i class="fa fa-dashboard"></i>
                        <span>Information</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="?page=updatemesjid&id=<?php echo $id ?>">
                        <i class="fa fa-dashboard"></i>
                        <span>Edit Information</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="?page=formfasupd&id=<?php echo $id ?>">
                        <i class="fa fa-dashboard"></i>
                        <span>Edit Facility</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="?page=listevent">
                        <i class="fa fa-cogs"></i>
                        <span>List Event</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="?page=ubahpw">
                        <i class="fa fa-cogs"></i>
                        <span>Change Password</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <section id="main-content">
        <section class="wrapper site-min-height">
            <div class="row mt">
                <?php
                $p=$_GET['page'];
                $page="pages/".$p.".php";
                if(file_exists($page)){
                    include($page);
                }elseif($p==""){
                    include('pages/content.php');
                }else{
                    include('pages/404.php');
                }
                ?>
            </div>
        </section>
    </section>

</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="/Basisdatalanjut/assets/js/jquery.js"></script>
<script src="/Basisdatalanjut/assets/js/jquery-1.8.3.min.js"></script>
<script src="/Basisdatalanjut/assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="/Basisdatalanjut/assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="/Basisdatalanjut/assets/js/jquery.scrollTo.min.js"></script>
<script src="/Basisdatalanjut/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="/Basisdatalanjut/assets/js/jquery.sparkline.js"></script>
<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<!--common script for all pages-->
<script src="/Basisdatalanjut/assets/js/common-scripts.js"></script>
<script type="text/javascript" src="/Basisdatalanjut/assets/js/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="/Basisdatalanjut/assets/js/gritter-conf.js"></script>
<script src="/Basisdatalanjut/assets/js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="/Basisdatalanjut/assets/js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="/Basisdatalanjut/assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="/Basisdatalanjut/assets/js/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="/Basisdatalanjut/assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="/Basisdatalanjut/assets/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="/Basisdatalanjut/assets/js/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="/Basisdatalanjut/assets/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script src="/Basisdatalanjut/assets/js/advanced-form-components.js"></script>
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
                "sInfo": "Showing _START_ to _END_ of _TOTAL_ entires",
                "sLengthMenu": "Show _MENU_ entires",
                "sSearch": "Search:"
            }
        });
    });
</script>
</body>
</html>
