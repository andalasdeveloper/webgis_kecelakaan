<?php session_start(); ?>
<h3><i class="fa fa-angle-right"></i> List User</h3>
<?php if($_SESSION['status'] == 'success'){?>
<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> <?php echo $_SESSION['message']; $_SESSION['status'] = ''; $_SESSION['message'] = ''; ?>
</div>
<?php } ?>
<div class="col-sm-12">  <!-- menampilkan list event-->
    <section class="panel">
        <div class="panel-body">
            <div class="box-body">
                <div class="form-group">
                    <table id="example1" class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Pangkat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                          <tbody>
                          <?php
                          $sql = pg_query("select user_polisi.id AS id, user_polisi.username AS username, user_polisi.name AS admin_name,user_polisi.pangkat as pangkat FROM user_polisi");
                          while($data =  pg_fetch_array($sql)){
                              $id = $data['id'];
                              $username = $data['username'];
                              $nama = $data['admin_name'];
                              $pangkat = $data['pangkat'];
                              
                              ?>
                              <tr>
                                  <td><?php echo "$username"; ?></td>
                                  <td><?php echo "$nama"; ?></td>
                                  <td><?php echo "$pangkat"; ?></td>
                                  <td>
                                      <div class="btn-group">
                                          <a href="?page=userupdate&id=<?php echo $id; ?>" class="btn btn-sm btn-default" title='Ubah'><i class="fa fa-edit"></i> Update</a>

                                          <a href="#" data-href="/ta_pariwisata/action/admin/deluser.php?id=<?php echo $id; ?>" class="btn btn-sm btn-default" title='Delete' data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
                                     
                                      </div>
                                  </td>
                              </tr>
                    <?php } ?>
                          </tbody>
                    </table>

                    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Confirm Delete</h4>
                                </div>
                                <div class="modal-body">
                                    <span>Do you want to delete this data ?</span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <a class="btn btn-danger btn-ok">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fab">
                        <a class="btn btn-primary btn-fab" href="?page=adduser">
                            <i class="fa fa-plus fa-fw"></i><span class="btn-fab-text">Add User</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
 </div>

<script src="/ta_pariwisata/assets/js/jquery.js"></script>
<script>
    $(document).ready(function() {
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    });
</script>