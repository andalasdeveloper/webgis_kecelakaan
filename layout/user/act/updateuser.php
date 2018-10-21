<?php
include ('../inc/connect.php');
$id = $_POST['id'];
$stewardship_period = $_POST['stewardship_period'];
$id_mesjid = $_POST['id_mesjid'];
$nama_pengurus = $_POST['nama_pengurus'];
$password = $_POST['password'];
$pass = md5(md5($password));
$role = $_POST['role'];
$no_hp = $_POST['no_hp'];
$alamat_pengurus = $_POST['alamat_pengurus'];
$periode_pengurusan = $_POST['periode_pengurusan'];
$username = $_POST['username'];

$sql  = "update administrators set id_worship_place='$id_mesjid', name='$nama_pengurus', password='$pass', role='$role', hp='$no_hp', address='$alamat_pengurus', stewardship_period='$periode_pengurusan', username='$username' where id_worship_place='$id' and stewardship_period='$stewardship_period'";
$update = pg_query($sql);

if ($update){
	echo "<script>
		alert (' Data Successfully Change');
		eval(\"parent.location='../?page=listpengurus'\");
		</script>";
}else{
	echo 'error';
}
?>