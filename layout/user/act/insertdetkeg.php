<?php
include ('../inc/connect.php');
session_start();
$id_detail_keg = $_POST['id_detail_keg'];
$keg = $_POST['keg'];
$jam = $_POST['jam'];
$tgl = $_POST['tgl'];
$ustad = $_POST['ustad'];
$penyelenggara = $_POST['penyelenggara'];
$sql = pg_query("insert into detail_event values ('$tgl','$jam', '$ustad','$keg','$_SESSION[id]', '$penyelenggara')");

if ($sql){
	echo "<script>
		alert ('Data Successfully Added');
		eval(\"parent.location='../index1.php?page=listevent '\");
		</script>";
}else{
	echo 'error';
}
?>