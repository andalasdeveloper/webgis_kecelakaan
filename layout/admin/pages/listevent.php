 <div class="col-sm-12">  <!-- menampilkan list event-->
    <section class="panel">
                    <div class="panel-body">
                        <a href="?page=addevent" title="Add Event" class="btn btn-compose"><i class="fa fa-plus"></i>List Event</a>
                        <div class="box-body">
             
                      <div class="form-group">
                       <table id="example1" class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                        <th>Name</th>
                        <th>Time</th>
                        <th>Date</th>
						<th>Ustad</th>
						<th>Description</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                       
                        $sql = pg_query("SELECT event.name as event_name, detail_event.id_worship_place ,worship_place.name as worship_place_name, detail_event.date, ustad.name as ustad_name, detail_event.description, detail_event.time FROM detail_event join event on detail_event.id_event=event.id join worship_place on detail_event.id_worship_place=worship_place.id join ustad on detail_event.id_ustad=ustad.id where detail_event.id_worship_place='$id'");
                        while($data =  pg_fetch_array($sql)){
                        $nama_keg = $data['event_name'];
                        $id = $data['id_worship_place'];
                        $jam = $data['time'];
                        $tgl_keg = $data['date'];
                        $nama_ustad = $data['ustad_name'];
                        $materi = $data['description'];
                        ?>
                        <tr>
                        <td><?php echo "$nama_keg"; ?></td>
                        <td><?php echo "$jam"; ?></td>
                        <td><?php echo "$tgl_keg"; ?></td>
                        <td><?php echo "$nama_ustad"; ?></td>
                        <td><?php echo "$materi"; ?></td>
                        <td><div class="btn-group">
                        <a href="?page=updatekegiatanuser&id=<?php echo $id; ?>&jam=<?php echo $jam; ?>&date=<?php echo $tgl_keg; ?>" class="btn btn-sm btn-default" title='Ubah'><i class="fa fa-edit"></i> Update</a>
                        </div>
                        <a href="act/delevent.php?id=<?php echo $id; ?>" class="btn btn-sm btn-default" title='Delete'><i class="fa fa-trash-o"></i></a>
                        </div>
                        </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                        </table> 
                      </div>                   
                  </div>
                    </div>
                </section>
                 </div>