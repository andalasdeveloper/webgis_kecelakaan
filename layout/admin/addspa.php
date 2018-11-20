

<h3><i class="fa fa-angle-right"></i> Add Accident</h3>
<!--Peta-->
<div class="col-sm-6" id="hide2">
    <section class="panel">
        <header class="panel-heading">
            <h3>
                <input id="latlng" type="text" class="form-control" style="width:200px" value="" placeholder="Latitude, Longitude">
                <button class="btn btn-default my-btn" id="btnlatlng" type="button" title="Geocode"><i class="fa fa-search"></i></button>
                <button class="btn btn-default my-btn" id="delete-button" type="button" title="Remove shape"><i class="fa fa-trash"></i></button>
            </h3>
        </header>
        <div class="panel-body">
            <div id="map" style="width:100%;height:420px; z-index:50"></div>
        </div>
    </section>
</div>
<!--/Peta-->
			  
<div class="col-sm-6" id="hide3"> <!-- menampilkan form add Accident-->
    <section class="panel">
        <div class="panel-body">
            <a class="btn btn-compose">Add Accident</a>
            <div class="box-body">
                <div class="form-group" id="hasilcari1">
                    <form role="form" action="/ta_pariwisata/action/admin/insertkecelakaan.php" enctype="multipart/form-data" method="post">
                        <?php
                        $query = pg_query("SELECT MAX(id_kecelakaan) AS id FROM kecelakaan");
                        
                        $id_pelapor = $_SESSION['id_user'];
                        $result = pg_fetch_array($query);
                        $idmax = $result['id'];
                        if ($idmax==null) $idmax=1;
                        else $idmax++;
                        ?>

                        <input type="text" class="form-control hidden" id="id" name="id" value="<?php echo $idmax;?>">
                        <div class="form-group">
                            <label for="geom"><span style="color:red">*</span> Coordinat</label>
                            <textarea class="form-control" id="geom" name="geom" readonly required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="laporan"><span style="color:red">*</span>No Laporan</label>
                            <input type="text" class="form-control" name="no_laporan" value="<?php echo
                             $idmax?>"> 
                        </div>
                        <div class="form-group">
                            <label for="pelapor"><span style="color:red">*</span>ID Pelapor</label>
                            <input type="text" class="form-control" name="id_pelapor" value="<?php
                            echo $id_pelapor ?>" readonly required> 
                        </div>
                        <div class="form-group">
                            <label for="nama"><span style="color:red">*</span>Total Kerugian</label>
                            <input type="text" class="form-control" name="total_kerugian" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Keterangan Lokasi</label>
                            <input type="text" class="form-control" name="alamat" value="">
                        </div>
                        <div class="form-group">
                            <label for="waktu">waktu kejadian</label>
                            <input type="datetime-local" name="waktu_kejadian" class="form-control" value=""/>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Image Upload</label>
                            <div class="col-md-9">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="/ta_pariwisata/data/foto/no.png" alt="" />
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <span class="btn btn-theme02 btn-file">
                                            <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                            <input type="file" class="default" name="image"/>
                                        </span>
                                        <a href="advanced_form_components.html#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Remove</a>
                                    </div>
                                </div>
                                <span class="label label-danger">NOTE!</span>
                                <span>Maximum image size of 500KB</span>
                            </div>
                        </div>
                        <div class="fab">
                                <button type="submit" class="btn btn-primary pull-right">Save <i class="fa fa-floppy-o"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="/ta_pariwisata/action/admin/mapupd.js" type="text/javascript"></script>
<!--                        