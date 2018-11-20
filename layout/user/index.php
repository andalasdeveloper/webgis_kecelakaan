<?php include '/ta_pariwisata/layout/template/user-base.php' ?>
<?php startblock('title') ?>DASHBOARD<?php endblock() ?>
<?php startblock('body') ?>
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
<?php endblock() ?>