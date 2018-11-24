<?php
//include '../template/admin-base.php';
include $_SERVER['DOCUMENT_ROOT'].'/Basisdatalanjut/value/location.php';
include $layout.'/template/admin-base.php';
?>
<?php startblock('title') ?>DASHBOARD<?php endblock() ?>
<?php startblock('body') ?>
    <?php
    
    $p = $_GET['page'];
    
    $page = $p.".php";
    if(file_exists($page)){
        require_once $action.'/connect.php';
        include($layout.'/admin/'.$page);
    }elseif($p=="") {
        require $action.'/admin/countmes.php'; ?>
        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
            <div class="row">
                <div class="col-lg-9 main-chart">
                    <div class="row mtbox">
                        <a href="?page=listkecelakaan">
                            <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                                <div class="box1">
                                    <span class="li_shop"></span>
                                    <h3><?php echo $data['kecelakaan'] ?></h3>
                                </div>
                                <p><?php echo $data['kecelakaan'] ?> Accident is registered on your website</p>
                            </div>
                        </a>
                        <a href="?page=user">
                            <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                                <div class="box1">
                                    <span class="li_user"></span>
                                    <h3><?php echo $data['user'] ?></h3>
                                </div>
                                <p><?php echo $data['user'] ?> user's is registered on your website</p>
                            </div>
                        </a>
                    </div><!-- /row mt -->
                </div><!-- /col-lg-9 END SECTION MIDDLE -->
            </div>
        </div>
        <?php
    }else{
        include($layout."/template/404.php");
    }
        ?>
<?php endblock() ?>
<?php startblock('js') ?>
    <script src="/Basisdatalanjut/assets/js/lightslider.js"></script>
    <script>
    $(document).ready(function() {
        $("#content-slider").lightSlider({
            loop:true,
            keyPress:true
        });
        $('#image-gallery').lightSlider({
            gallery:true,
            item:1,
            thumbItem:9,
            slideMargin: 0,
            speed:500,
            auto:true,
            loop:true,
            onSliderLoad: function() {
                $('#image-gallery').removeClass('cS-hidden');
            }
        });
    });
    </script>
<?php endblock() ?>