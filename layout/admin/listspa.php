<?php include $_SERVER['DOCUMENT_ROOT'].'/ta_pariwisata/value/location.php'; ?>
<h3><i class="fa fa-angle-right"></i> List Accident</h3>
<div class="col-sm-12">
    <section class="panel">
        <div class="panel-body">
<!--            <a href="?page=addspa" title="Add SPA" class="btn btn-compose"><i class="fa fa-plus"></i>Add SPA</a>-->
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
                                    <td><div class="btn-group">
                                            <a href="?page=detail&id=<?php echo $id; ?>" class="btn btn-sm btn-default" title='Detail'><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-sm btn-default" title='Edit'><i class="fa fa-edit"></i></a>
                                            <a href="/ta_pariwisata/action/admin/deletespa.php?id=<?php echo $id; ?>" class="btn btn-sm btn-default" title='Delete'><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="fab">
                        <a class="btn btn-primary btn-fab" href="?page=addspa">
                            <i class="fa fa-plus fa-fw"></i><span class="btn-fab-text">Add SPA</span>
                        </a>

<!--                        <div class="fab-group">-->
<!--                            <a class="btn btn-default btn-fab fab-group-item">-->
<!--                                <i class="fa fa-save fa-fw"></i><span class="btn-fab-text">保存</span>-->
<!--                            </a>-->
<!--                            <a class="btn btn-danger btn-fab fab-group-item">-->
<!--                                <i class="fa fa-share-alt fa-fw"></i><span class="btn-fab-text">シェア</span>-->
<!--                            </a>-->
<!--                            <a class="btn btn-warning btn-fab fab-group-item">-->
<!--                                <i class="fa fa-envelope fa-fw"></i><span class="btn-fab-text">メール</span>-->
<!--                            </a>-->
<!--                            <a class="btn btn-info btn-fab fab-group-item">-->
<!--                                <i class="fa fa-edit fa-fw"></i><span class="btn-fab-text">編集</span>-->
<!--                            </a>-->
<!--                            <a class="btn-fab fab-group-item">-->
<!--                                <img src="face.jpg" class="img-circle" /><span class="btn-fab-text">アカウント</span>-->
<!--                            </a>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
         