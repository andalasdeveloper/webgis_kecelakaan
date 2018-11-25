

<h3><i class="fa fa-angle-right"></i> Add Victim</h3>
<!--Peta-->

<!--/Peta-->
			  
<div class="col-sm" id="hide3"> <!-- menampilkan form add Accident-->
    <section class="panel">
        <div class="panel-body">
            <a class="btn btn-compose">Add Victim</a>
            <div class="box-body">
                <div class="form-group" id="hasilcari1">
                    <form role="form" action="/Basisdatalanjut/action/admin/insertkorban.php" enctype="multipart/form-data" method="post">
                        
                        <div class="form-group">
                            <label for="no_ktp"><span style="color:red">*</span>No KTP</label>
                            <input type="text" class="form-control" name="no_ktp" value=""> 
                        </div>

                         <div class="form-group">
                            <label for="no_ktp"><span style="color:red">*</span>Nama</label>
                            <input type="text" class="form-control" name="nama" value=""> 
                        </div>


                        <div class="form-group">
                            <label for="jenis_kelamin"><span style="color:red">*</span>Jenis Kelamin</label>
                            <input type="text" class="form-control" name="jenis_kelamin" value=""> 
                        </div>


                        <div class="form-group">
                            <label for="Kondisi"><span style="color:red">*</span>Kondisi</label>
                            <input type="text" class="form-control" name="kondisi" value=""> 
                        </div>


                        <div class="form-group">
                            <label for="no_laporan"><span style="color:red">*</span>No Laporan</label>
                              <select name="no_laporan" class="form-control" >
                                  <?php
                                    $sql = pg_query("SELECT * FROM kecelakaan");
                                    while($data =  pg_fetch_array($sql)){
                                        $id = $data['id_kecelakaan'];
                                     ?>
                                  <option value="<?php echo "$id"; ?>"><?php echo "$id"; ?></option> 
                                   <?php
                            }
                            ?>
                              </select>

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
