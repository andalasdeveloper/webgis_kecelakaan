<?php include $_SERVER['DOCUMENT_ROOT'].'/Basisdatalanjut/value/location.php'; ?>
<h3><i class="fa fa-angle-right"></i> List Victim</h3>
<div class="col-sm-12">
    <section class="panel">
        <div class="panel-body">
            <div class="box-body">
                <div class="form-group">
                    <table id="example2" class="table table-hover table-bordered table-striped">
                        <thead>
                            <th>Nomor Kartu Tanda Penududuk</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Kondisi</th>
                            <th>No Laporan Kecelakaan</th>
    
                            <th>Option</th>
                        </thead>
                        <tbody>
                            <?php
                            $sql = pg_query("select korban_kecelakaan.id_kecelakaan, korban_kecelakaan.nama, korban_kecelakaan.kondisi, korban_kecelakaan.jenis_kelamin,korban_kecelakaan.no_ktp from korban_kecelakaan
                                union select korban_kendaraan.id_kecelakaan, korban_kendaraan.nama, korban_kendaraan.kondisi, korban_kendaraan.jenis_kelamin, korban_kendaraan.no_ktp from korban_kendaraan ");

                            while($data =  pg_fetch_array($sql)){
                                $no_ktp = $data['no_ktp'];
                                $nama = $data['nama'];
                                $kondisi = $data['kondisi'];
                                $jenis_kelamin = $data['jenis_kelamin'];
                                $id_kecelakaan = $data['id_kecelakaan'];
                                
                            ?>
                                <tr>
                                    <td><?php echo "$no_ktp"; ?></td>
                                    <td><?php echo "$nama"; ?></td>
                                    <td><?php echo "$kondisi"; ?></td>
                                    <td><?php echo "$jenis_kelamin"; ?></td>
                                    <td><?php echo "$id_kecelakaan"; ?></td>
                              
                                    <td><div class="btn-group">
                                            <a href="?page=detail&id=<?php echo $id; ?>" class="btn btn-sm btn-default" title='Detail'><i class="fa fa-eye"></i></a>
                                            <a href="?page=editkorban%id=<?php echo $id;?>" class="btn btn-sm btn-default" title='Edit'><i class="fa fa-edit"></i></a>
                                            <a href="/Basisdatalanjut/action/admin/deletekorban.php?id=<?php echo $id; ?>" class="btn btn-sm btn-default" title='Delete'><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="fab">
                        <a class="btn btn-primary btn-fab" href="?page=addkorban">
                            <i class="fa fa-plus fa-fw"></i><span class="btn-fab-text">Add Victim</span>
                        </a>


                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
         