<?php
include $_SERVER['DOCUMENT_ROOT'].'/Basisdatalanjut/value/location.php';
include ($action.'/connect.php');
$no_ktp = $_POST['no_ktp'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$kondisi = $_POST['kondisi'];
$no_laporan = $_POST['no_laporan'];





$sql = pg_query("INSERT INTO korban_kecelakaan (no_ktp, nama, jenis_kelamin, kondisi,id_kecelakaan) values ('$no_ktp', '$nama', '$jenis_kelamin','$kondisi','$no_laporan')");

if ($sql){
	header('Location:/Basisdatalanjut/layout/admin/?page=listkorban');
}else{
	echo 'There is something error whith your SQL ! Check it again !';
}
?>