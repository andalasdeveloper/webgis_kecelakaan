<?php include $_SERVER['DOCUMENT_ROOT'].'/Basisdatalanjut/value/location.php'; ?>
<h3><i class="fa fa-angle-right"></i> List Kendaraan</h3>
<div class="col-sm-12">
    <section class="panel">
        <div class="panel-body">
            <div class="box-body">
                <div class="form-group">
                    <table id="example2" class="table table-hover table-bordered table-striped">
                        <thead>
                            <th>No Polisi</th>
                            <th>Nama Pemilik</th>
                            <th>No Laporan</th>
                            <th>Jenis Kendaraan</th>
                            <th>Kondisi Kendaraan</th>
                            <th>Status Disita</th>
                            
    
                            <th>Option</th>
                        </thead>
                        <tbody>
                            <?php
                            $sql = pg_query("SELECT * FROM kendaraan");
                            while($data =  pg_fetch_array($sql)){
                                $no_plat = $data['no_plat'];
                                $nama = $data['nama_pemilik'];
                                $no_laporan = $data['id_kecelakaan'];
                                $kondisi = $data['kondisi'];
                                $status = $data['status_disita'];
                                $detail = $data['id_detail'];
                            ?>
                                <tr>
                                    <td><?php echo "$no_plat"; ?></td>
                                    <td><?php echo "$nama"; ?></td>
                                    <td><?php echo "$no_laporan"; ?></td>
                                    
                                    <td><?php  if($detail==1){
                                        echo "Motor";
                                    }
                                    elseif($detail==2){
                                        echo "Motor";
                                    }
                                    elseif($detail==2){
                                        echo "Bus";
                                    }
                                    ?></td>
                                    <td><?php echo "$kondisi"; ?></td>
                                    <td><?php echo "$status"; ?></td>
                                    
                               
                                    <td><div class="btn-group">
                                            <a href="?page=detail&id=<?php echo $id; ?>" class="btn btn-sm btn-default" title='Detail'><i class="fa fa-eye"></i></a>
                                            <a href="?page=editkendaraan%id=<?php echo $id;?>" class="btn btn-sm btn-default" title='Edit'><i class="fa fa-edit"></i></a>
                                            <a href="/Basisdatalanjut/action/admin/deletekendaraan.php?id=<?php echo $id; ?>" class="btn btn-sm btn-default" title='Delete'><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="fab">
                        <a class="btn btn-primary btn-fab" href="?page=addkendaraan">
                            <i class="fa fa-plus fa-fw"></i><span class="btn-fab-text">Add Kendaraan</span>
                        </a>


                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
         