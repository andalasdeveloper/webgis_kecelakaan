<?php include $_SERVER['DOCUMENT_ROOT'].'/Basisdatalanjut/value/location.php'; ?>
<h3><i class="fa fa-angle-right"></i> List Accident</h3>
<div class="col-sm-12">
    <section class="panel">
        <div class="panel-body">
            <div class="box-body">
                <div class="form-group">
                    <table id="example2" class="table table-hover table-bordered table-striped">
                        <thead>
                            <th>ID Kecelakaan</th>
                            <th>Total Kerugian</th>
                            <th>Keterangan Lokasi</th>
                            <th>Tanggal Kejadian</th>
    
                            <th>Option</th>
                        </thead>
                        <tbody>
                            <?php
                            $sql = pg_query("SELECT * FROM kecelakaan");
                            while($data =  pg_fetch_array($sql)){
                                $id = $data['id_kecelakaan'];
                                $nama = $data['total_kerugian'];
                                $alamat = $data['keterangan_lokasi'];
                            ?>
                                <tr>
                                    <td><?php echo "$id"; ?></td>
                                    <td><?php echo "$nama"; ?></td>
                                    <td><?php echo "$alamat"; ?></td>
                                    <td>sdf</td>
                                    <td><div class="btn-group">
                                            <a href="?page=detail&id=<?php echo $id; ?>" class="btn btn-sm btn-default" title='Detail'><i class="fa fa-eye"></i></a>
                                            <a href="?page=editkecelakaan%id=<?php echo $id;?>" class="btn btn-sm btn-default" title='Edit'><i class="fa fa-edit"></i></a>
                                            <a href="/Basisdatalanjut/action/admin/deletekecelakaan.php?id=<?php echo $id; ?>" class="btn btn-sm btn-default" title='Delete'><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="fab">
                        <a class="btn btn-primary btn-fab" href="?page=addkecelakaan">
                            <i class="fa fa-plus fa-fw"></i><span class="btn-fab-text">Add Accident</span>
                        </a>


                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
         