<?php
include 'ti.php';
session_start();
if(!isset($_SESSION['SA'])){
    echo"<script language='JavaScript'>document.location='/Basisdatalanjut/layout/login.php'</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kecelakaan | <?php startblock('title') ?><?php endblock() ?></title>

    <link href="/Basisdatalanjut/assets/css/bootstrap.css" rel="stylesheet">
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

    <link href="/Basisdatalanjut/assets/css/floating-button.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/lineicons/style.css">
    <link href="/Basisdatalanjut/assets/css/style.css" rel="stylesheet">
    <link href="/Basisdatalanjut/assets/css/style-responsive.css" rel="stylesheet">
    <script src="/Basisdatalanjut/action/admin-script.js" type="text/javascript"></script>
    <link href="/Basisdatalanjut/assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDM2fDXHmGzCDmDBk3bdPIEjs6zwnI1kGQ&libraries=drawing"></script>
    <script src="/Basisdatalanjut/assets/js/chart-master/Chart.js"></script>
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/js/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/js/bootstrap-daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/js/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/js/bootstrap-datetimepicker/datertimepicker.html" />
    <link rel="stylesheet" type="text/css" href="/Basisdatalanjut/assets/css/skins/_all-skins.css" />
    <link rel="stylesheet"  href="/Basisdatalanjut/assets/css/lightslider.css"/>

    <!-- blueimp Gallery styles -->
    <link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="/Basisdatalanjut/assets/css/jquery.fileupload.css">
    <link rel="stylesheet" href="/Basisdatalanjut/assets/css/jquery.fileupload-ui.css">
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript><link rel="stylesheet" href="/Basisdatalanjut/assets/css/jquery.fileupload-noscript.css"></noscript>
    <noscript><link rel="stylesheet" href="/Basisdatalanjut/assets/css/jquery.fileupload-ui-noscript.css"></noscript>

    <?php startblock('css') ?><?php endblock() ?>
</head>
<body>
    <section id="container">
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
                <ul class="sidebar-menu" id="nav-accordion">
                    <p class="centered"><a href="profile.html"><img src="/Basisdatalanjut/assets/img/fr-10.jpg" class="img-circle" width="60"></a></p>
                    <h5 class="centered"><p><?php echo $_SESSION['name']; ?></p></h5>
                    <li class="mt">
                        <a href="/Basisdatalanjut/admin">
                            <i class="fa fa-book"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="?page=listkecelakaan">
                            <i class="fa fa-dashboard"></i>
                            <span>Lists Accident</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="?page=listkorban">
                            <i class="fa fa-dashboard"></i>
                            <span>Lists Victim</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="?page=listkendaraan">
                            <i class="fa fa-dashboard"></i>
                            <span>Lists Kendaraan</span>
                        </a>
                    </li>
                    
                    <li class="sub-menu">
                        <a href="/Basisdatalanjut/home">
                            <i class="fa fa-tasks"></i>
                            <span>User Access</span>
                        </a>
                    </li>
                    
                    <li class="sub-menu">
                        <a href="?page=user">
                            <i class="fa fa-tasks"></i>
                            <span>User Management</span>
                        </a>
                    </li>

                </ul>
            </div>
        </aside>

        <section id="main-content">
            <section class="wrapper">
                    <?php startblock('body') ?><?php endblock() ?>
            </section>
        </section>
    </section>

    <script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.deleteUrl%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
  

    <script src="/Basisdatalanjut/assets/js/jquery.js"></script>
<!--    <script src="/Basisdatalanjut/assets/js/jquery-1.8.3.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="/Basisdatalanjut/assets/js/bootstrap.min.js"></script>

    <!-- js placed at the end of the document so the pages load faster -->
    <script class="include" type="text/javascript" src="/Basisdatalanjut/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="/Basisdatalanjut/assets/js/jquery.scrollTo.min.js"></script>
    <script src="/Basisdatalanjut/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="/Basisdatalanjut/assets/js/jquery.sparkline.js"></script>
    <script src="/Basisdatalanjut/assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="/Basisdatalanjut/assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

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

    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="/Basisdatalanjut/assets/js/vendor/jquery.ui.widget.js"></script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- blueimp Gallery script -->
    <script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="/Basisdatalanjut/assets/js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="/Basisdatalanjut/assets/js/jquery.fileupload.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="/Basisdatalanjut/assets/js/jquery.fileupload-process.js"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="/Basisdatalanjut/assets/js/jquery.fileupload-image.js"></script>
    <!-- The File Upload audio preview plugin -->
    <script src="/Basisdatalanjut/assets/js/jquery.fileupload-audio.js"></script>
    <!-- The File Upload video preview plugin -->
    <script src="/Basisdatalanjut/assets/js/jquery.fileupload-video.js"></script>
    <!-- The File Upload validation plugin -->
    <script src="/Basisdatalanjut/assets/js/jquery.fileupload-validate.js"></script>
    <!-- The File Upload user interface plugin -->
    <script src="/Basisdatalanjut/assets/js/jquery.fileupload-ui.js"></script>
    <!-- The main application script -->
    <script src="/Basisdatalanjut/assets/js/main.js"></script>
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
    <!--[if (gte IE 8)&(lt IE 10)]>
    <script src="/Basisdatalanjut/assets/js/cors/jquery.xdr-transport.js"></script>
    <![endif]-->

    <?php startblock('js') ?><?php endblock() ?>
    <script type="text/javascript">
        $(function () {
            $('#example1, #example2, #example3').dataTable({
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bSort": false,
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
