<?php
include $_SERVER['DOCUMENT_ROOT'].'/ta_pariwisata/value/location.php';
require $action.'/connect.php';
$id = $_GET["id"];

$query = "SELECT kecelakaan.id_kecelakaan as id, kecelakaan.total_kerugian as total_kerugian, kecelakaan.keterangan_lokasi as address, kecelakaan.image, user_polisi.id as admin_id, user_polisi.name as admin_name, ST_X(ST_Centroid(geom)) As lng, ST_Y(ST_Centroid(geom)) As lat FROM kecelakaan LEFT JOIN user_polisi on kecelakaan.id_pelapor = user_polisi.id WHERE kecelakaan.id_kecelakaan='$id'";
$hasil = pg_query($query);
while($row = pg_fetch_array($hasil)){
  $id = $row['id'];
  $name = $row['total_kerugian'];
  $address = $row['address'];
  $image = $row['image'];
  $admin_id = $row['admin_id'];
  $admin_name = $row['admin_name'];
  $lat = $row['lat'];
  $lng = $row['lng'];
  if ($lat=='' || $lng==''){
    $lat='<span style="color:red">Kosong</span>';
    $lng='<span style="color:red">Kosong</span>';
  }
  if ($image=='null' || $image=='' || $image==null){
      $image='foto.jpg';
  }
}
?>
<!--Detail-->
<h3> Detail <?php echo $id ?></h3>
<div class="row mt">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <! -- DETAIL -->
        <div class="showback">
            <table class="table table-condensed">
                <tbody  style='vertical-align:top;'>
                    <tr>
                        <td width="150px"><b>Address</b></td>
                        <td> :&nbsp;</td>
                        <td style='text-transform:capitalize;'><?php echo $address ?></td>
                    </tr>
                    <tr>
                        <td><b>Nama Petugas<b></td>
                        <td>: </td>
                        <td><?php echo($admin_name == NULL ? '<button class="label label-warning" data-toggle="modal" data-target="#set_admin_modal">Not Set</button>' : $admin_name);?></td>
                    </tr>
                    <tr>
                        <td><b>Koordinat<b> </td>
                        <td>: </td>
                        <td><b>Latitude</b> : <?php echo $lat ?> <br>
                            <b>Longitude</b> : <?php echo $lng ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="btn-group">
                <a href="?page=editspa&id=<?php echo $id ?>" class="btn btn-primary pull-right"><i class="fa fa-edit"></i>&nbsp Edit Information</a>
            </div>
        </div><!--/DETAIL -->
        <!--Upload Gambar-->
        <div class="panel">
            <header class="panel-heading">
                <h3>Upload Picture of <?php echo $name ?></h3>
            </header>
            <div class="panel-body">
                <!-- form start -->
                <form action="/ta_pariwisata/action/admin/uploadfotospa.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="file[]" multiple>
                    <input type="submit" name="submit">
                </form>
                <form id="fileupload" action="/ta_pariwisata/action/admin/uploadfotospa.php" file="true" method="POST" enctype="multipart/form-data">
                    <input type="text" class="form-control hidden" name="id" value="<?php echo $id ?>">
                    <div class="row fileupload-buttonbar">
                        <div class="col-lg-7">
                            <!-- The fileinput-button span is used to style the file input field as button -->
                            <span class="btn btn-success fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <!-- <span>Add files...</span> -->
                                <input type="file" accept="image/*" name="files[]" multiple>
                            </span>
                            <button type="submit" class="btn btn-primary start">
                                <i class="glyphicon glyphicon-upload"></i>
                                <!-- <span>Start upload</span>-->
                            </button>
                            <button type="reset" class="btn btn-warning cancel">
                                <i class="glyphicon glyphicon-ban-circle"></i>
                                <!-- <span>Cancel upload</span>-->
                            </button>
                            <button type="button" class="btn btn-danger delete">
                                <i class="glyphicon glyphicon-trash"></i>
                                <!-- <span>Delete</span>-->
                            </button>
                            <!-- <input type="checkbox" class="toggle">-->
                            <!-- The global file processing state -->
                            <span class="fileupload-process"></span>
                        </div>
                        <!-- The global progress state -->
                        <div class="col-lg-5 fileupload-progress fade">
                            <!-- The global progress bar -->
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                            </div>
                            <!-- The extended global progress state -->
                            <div class="progress-extended">&nbsp;</div>
                        </div>
                    </div>
                    <!-- The table listing the files available for upload/download -->
                    <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                </form>
            </div>
        </div>
        <!--/Upload Gambar-->
    </div>
    <!--/Detail-->

    <!--Galeri-->
    <div class="col-sm-12 col-lg-6 col-md-6">
        <div class="panel">
            <header class="panel-heading">
                <h3> Picture of <?php echo $name ?></h3>
            </header>
            <div class="panel-body clearfix">
                <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                    <li data-thumb="/ta_pariwisata/assets/img/thumb/cS-1.jpg">
                        <img src="/ta_pariwisata/assets/img/cS-1.jpg" />
                    </li>
                    <li data-thumb="/ta_pariwisata/assets/img/thumb/cS-2.jpg">
                        <img src="/ta_pariwisata/assets/img/cS-2.jpg" />
                    </li>
                    <li data-thumb="/ta_pariwisata/assets/img/thumb/cS-3.jpg">
                        <img src="/ta_pariwisata/assets/img/cS-3.jpg" />
                    </li>
                    <li data-thumb="/ta_pariwisata/assets/img/thumb/cS-4.jpg">
                        <img src="/ta_pariwisata/assets/img/cS-4.jpg" />
                    </li>
                    <li data-thumb="/ta_pariwisata/assets/img/thumb/cS-5.jpg">
                        <img src="/ta_pariwisata/assets/img/cS-5.jpg" />
                    </li>
                    <li data-thumb="/ta_pariwisata/assets/img/thumb/cS-6.jpg">
                        <img src="/ta_pariwisata/assets/img/cS-6.jpg" />
                    </li>
                    <li data-thumb="/ta_pariwisata/assets/img/thumb/cS-7.jpg">
                        <img src="/ta_pariwisata/assets/img/cS-7.jpg" />
                    </li>
                    <li data-thumb="/ta_pariwisata/assets/img/thumb/cS-8.jpg">
                        <img src="/ta_pariwisata/assets/img/cS-8.jpg" />
                    </li>
                    <li data-thumb="/ta_pariwisata/assets/img/thumb/cS-9.jpg">
                        <img src="/ta_pariwisata/assets/img/cS-9.jpg" />
                    </li>
                    <li data-thumb="/ta_pariwisata/assets/img/thumb/cS-10.jpg">
                        <img src="/ta_pariwisata/assets/img/cS-10.jpg" />
                    </li>
                    <li data-thumb="/ta_pariwisata/assets/img/thumb/cS-11.jpg">
                        <img src="/ta_pariwisata/assets/img/cS-11.jpg" />
                    </li>
                    <li data-thumb="/ta_pariwisata/assets/img/thumb/cS-12.jpg">
                        <img src="/ta_pariwisata/assets/img/cS-12.jpg" />
                    </li>
                    <li data-thumb="/ta_pariwisata/assets/img/thumb/cS-13.jpg">
                        <img src="/ta_pariwisata/assets/img/cS-13.jpg" />
                    </li>
                    <li data-thumb="/ta_pariwisata/assets/img/thumb/cS-14.jpg">
                        <img src="/ta_pariwisata/assets/img/cS-14.jpg" />
                    </li>
                    <li data-thumb="/ta_pariwisata/assets/img/thumb/cS-15.jpg">
                        <img src="/ta_pariwisata/assets/img/cS-15.jpg" />
                    </li>
                </ul>
            </div>
        </div>
        <!--/Galery-->
    </div>
</div>

<!--Modal-->
<div class="modal fade" id="set_admin_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Set Admin</h4>
            </div>
            <form action="/ta_pariwisata/action/admin/setadmin.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_spa" value="<?php echo $id; ?>">
                    <?php
                    $query = "SELECT * FROM user_polisi WHERE role='A'";
                    $hasil = pg_query($query);
                    if (pg_num_rows($hasil) > 0) {
                    ?>
                        <select name="admin" class="form-control">
                            <?php
                            while ($user_polisi = pg_fetch_array($hasil)) {
                                $id = $user_polisi['id'];
                                $name = $user_name['name'];
                                echo "<option value='$id'>$name</option>";
                            }
                            ?>
                        </select>
                    <?php
                    }else{
                        echo "<span>No Admin Available, Add Admin First !</span>";
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <?php
                    if (pg_num_rows($hasil) > 0) {
                        ?>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" name="set_admin" class="btn btn-primary" value="Set">
                        <?php
                    }else{
                        ?><a href="?page=adduser" class="btn btn-primary">Add Admin</a><?php
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>
<!--/Modal-->