

<h3><i class="fa fa-angle-right"></i> Add Kendaraan</h3>
<!--Peta-->

<!--/Peta-->
			  
<div class="col-sm" id="hide3"> <!-- menampilkan form add Accident-->
    <section class="panel">
        <div class="panel-body">
            <a class="btn btn-compose">Add Kendaraan</a>
            <div class="box-body">
                <div class="form-group" id="hasilcari1">
                    <form role="form" action="/Basisdatalanjut/action/admin/insertkendaraan.php" enctype="multipart/form-data" method="post">
                        
                        <div class="form-group">
                            <label for="no_ktp"><span style="color:red">*</span>Nomor Polisi</label>
                            <input type="text" class="form-control" name="no_plat" value=""> 
                        </div>

                         <div class="form-group">
                            <label for="no_ktp"><span style="color:red">*</span>Nama Pemilik</label>
                            <input type="text" class="form-control" name="nama" value=""> 
                        </div>

                        <div class="form-group">
                            <label for="jenis"><span style="color:red">*</span>Jenis Kendaraan</label>
                            <select name='jenis' class="form-control">
                              <option value="1">Sepeda Motor</option>
                              <option value="2">Mobil</option>
                              <option value="3">Bus</option>
                          
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="Kondisi"><span style="color:red">*</span>Kondisi Kendaraan</label>
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
                            
                        <div class="form-group">
                            <label for="status"><span style="color:red">*</span>Status Kendaraan</label>
                            <select name='status' class="form-control">
                              <option value="disita">Disita</option>
                              <option value="tidak_disita">Tidak disita</option>
                          
                          
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
