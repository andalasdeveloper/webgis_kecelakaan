<?php
include $_SERVER['DOCUMENT_ROOT'].'/Basisdatalanjut/value/location.php';
include ($action.'/connect.php');
$id = $_POST['no_laporan'];
$total_kerugian = $_POST['total_kerugian'];
$alamat = $_POST['alamat'];
$id_pelapor = $_POST['id_pelapor'];
$geom = $_POST['geom'];

$sql = pg_query("INSERT INTO kecelakaan (id_kecelakaan, total_kerugian, keterangan_lokasi, geom,id_pelapor) values ('$id', '$total_kerugian', '$alamat', ST_GeomFromText('$geom'),'$id_pelapor')");

if ($sql){
	header('Location:/Basisdatalanjut/layout/admin/?page=listkecelakaan');
}else{
	echo 'There is something error whith your SQL ! Check it again !';
}
?>