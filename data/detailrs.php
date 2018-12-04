<?php
require '../action/connect.php';

$cari = $_GET["cari"];
$querysearch	= "SELECT id_rumahsakit, nama, alamat, ST_X(ST_Centroid(geom)) AS longitude, ST_Y(ST_CENTROID(geom)) As latitude FROM rumah_sakit WHERE id_rumahsakit='$cari'";


			   
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
    {
          $id=$row['id_rumahsakit'];
          $nama=$row['nama'];
          $alamat=$row['alamat'];
          $longitude=$row['longitude'];
          $latitude=$row['latitude'];
          $dataarray[]=array('id'=>$id,'name'=>$nama, 'alamat'=>$alamat,'longitude'=>$longitude,'latitude'=>$latitude);
    }



$querykorban = "SELECT korban_kecelakaan.id_kecelakaan,korban_kecelakaan.nama as nama_korban,rumah_sakit.id_rumahsakit, 
rumah_sakit.nama as nama_rs FROM korban_kecelakaan join korban_rs on korban_kecelakaan.no_ktp=korban_rs.id_korban_kec join rumah_sakit 
on korban_rs.id_rs=rumah_sakit.id_rumahsakit where rumah_sakit.id_rumahsakit='$cari'
Union SELECT korban_kendaraan.id_kecelakaan,korban_kendaraan.nama as nama_korban,rumah_sakit.id_rumahsakit, 
rumah_sakit.nama as nama_rs FROM korban_kendaraan join korban_rs on korban_kendaraan.no_ktp=korban_rs.id_korban_ken join rumah_sakit 
on korban_rs.id_rs=rumah_sakit.id_rumahsakit where rumah_sakit.id_rumahsakit='$cari'";


    $hasil2=pg_query($querykorban);
    while($baris = pg_fetch_array($hasil2)){

        $id_kecelakaan=$baris['id_kecelakaan'];
        $nama_korban=$baris['nama_korban'];
        $id_rs=$baris['id_rumahsakit'];
        $namars=$baris['nama_rs'];
       
        $data_korban[]=array('id_kecelakaan'=>$id_kecelakaan,'nama_korban'=>$nama_korban, 'id_rs'=>$id_rs,'namars'=>$namars);
    }

$arr=array("data_rs"=>$dataarray, "korban"=>$data_korban);
    echo json_encode($arr);
?>