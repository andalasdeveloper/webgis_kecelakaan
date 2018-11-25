<?php
include $_SERVER['DOCUMENT_ROOT'].'/Basisdatalanjut/value/location.php';
include ($action.'/connect.php');
$no_ktp = $_POST['no_plat'];
$nama = $_POST['nama'];
$kondisi = $_POST['kondisi'];
$no_laporan = $_POST['no_laporan'];
$jenis = $_POST['jenis'];
$status = $_POST['status'];







$sql = pg_query("INSERT INTO kendaraan (no_plat, nama_pemilik, id_kecelakaan, id_detail,kondisi,status_disita) values ('$no_ktp', '$nama','$no_laporan','$jenis','$kondisi','$status')");

if ($sql){
	header('Location:/Basisdatalanjut/layout/admin/?page=listkendaraan');
}else{
	echo 'There is something error whith your SQL ! Check it again !';
}
?>