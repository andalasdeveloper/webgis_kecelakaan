<?php
session_start();
include ($_SERVER['DOCUMENT_ROOT']."/Basisdatalanjut/value/location.php");
include ($action.'/connect.php');

$id = $_POST['id'];
$name = $_POST['nama_user'];
$password = $_POST['password'];
$pass = md5(md5($password));
$role = $_POST['role'];
$no_hp = $_POST['no_hp'];
$$alamat = $_POST['alamat'];
$username = $_POST['username'];

$sql  = "UPDATE user_polisi SET  name='$nama_user', password='$pass', role='$role', hp='$no_hp', address='$alamat', username='$username' WHERE id='$id'";
$update = pg_query($sql);

if ($update){
    $_SESSION['status'] = 'success';
    $_SESSION['message'] = 'User berhasil diupdate !';
    header('Location:'.$lay.'/admin?page=user');;
}else{
	echo 'error';
}
?>