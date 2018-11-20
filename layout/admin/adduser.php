<?php include $_SERVER['DOCUMENT_ROOT'].'/ta_pariwisata/value/location.php'; ?>
<!-- menampilkan form add user-->
<h3><i class="fa fa-angle-right"></i> Add User</h3>
<div class="col-sm-12">
    <section class="panel">
        <div class="panel-body">
            <div class="box-body">
                <div class="form-group">
                    <?php ?>
                        <form class="form-horizontal style-form" role="form" action="/ta_pariwisata/action/admin/insertuser.php" method="post">
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label" for="no_anggota">No Anggota</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="no_anggota" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label" for="nama">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label" for="alamat">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alamat" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label" for="no_hp">Contact</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="no_hp" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label" for="role">Role</label>
                                <div class="col-sm-10">
                                    <select required name="role" class="form-control">
                                        <option value="SA">Admin</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label" for="user">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label" for="pass">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" value="">
                                </div>
                            </div>
                            <div class="fab">
                                <button type="submit" class="btn btn-primary pull-right">Save <i class="fa fa-floppy-o"></i></button>
                            </div>
                        </form>
                    <?php //} ?>
                </div>
            </div>
        </div>
    </section>
</div>