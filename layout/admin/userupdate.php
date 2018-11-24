<?php
include $_SERVER['DOCUMENT_ROOT'].'/Basisdatalanjut/value/location.php';
?>
<h3><i class="fa fa-angle-right"></i> Edit User</h3>
<div class="col-sm-12">
    <section class="panel">
        <div class="panel-body">
            <div class="box-body"	>
                <div class="form-group">
                <?php
                if (isset($_GET['id'])){
                    $id=$_GET['id'];
                    $sql = pg_query("SELECT * FROM user_polisi where id='$id'");
                    $data = pg_fetch_array($sql)
                    ?>
                    <form class="form-horizontal style-form" role="form" action="/Basisdatalanjut/action/admin/updateuser.php" method="post">
                        <input type="text" class="form-control hidden" id="id" name="id" value="<?php echo $data['id']?>">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" for="nama_user">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_user" value="<?php echo $data['name']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" for="alamat">Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="alamat" value="<?php echo $data['address']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" for="no_hp">Contact</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="no_hp" value="<?php echo $data['hp']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" for="role">Role</label>
                            <div class="col-sm-10">
                                <select required name="role" class="form-control">
                                    <option value="SA" <?php if($data['role'] == 'SA') {echo selected;} ?>>Super Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" for="username">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" value="<?php echo $data['username']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" for="password">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" placeholder="Dont forget to input password again">
                            </div>
                        </div>
<!--                        <button type="submit" class="btn btn-primary pull-right">Save <i class="fa fa-floppy-o"></i></button>-->
                        <div class="fab">
                            <button type="submit" class="btn btn-primary pull-right">Save <i class="fa fa-floppy-o"></i></button>
                        </div>
                    </form>
                <?php } ?>
                </div>
            </div>
        </div>
    </section>
</div>