<?php
	include ('../inc/connect.php');
	$nama = $_POST['nama'];
	$periode_pengurusan = $_POST['periode_pengurusan'];
	$alamat = $_POST['alamat_pengurus'];
	$no_hp = $_POST['no_hp'];
	$role = $_POST['role'];
	$id_mesjid = $_POST['id_mesjid'];
	$user = $_POST['username'];
	$password = $_POST['password'];
	$pass = md5(md5($password));
	$sql = pg_query("insert into administrators (name, id_worship_place, stewardship_period, address, hp, role, username, password) values ('$nama', '$id_mesjid', '$periode_pengurusan', '$alamat', '$no_hp','$role', '$user', '$pass')");
	
	if ($sql){
		echo "<script>
		alert (' Data Successfully Added');
		eval(\"parent.location='../?page=listpengurus'\");
		</script>";
	
}else{
	echo 'error';
}
?>