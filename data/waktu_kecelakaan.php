
<?php
include ($_SERVER['DOCUMENT_ROOT']."/Basisdatalanjut/value/location.php");
require $action.'/connect.php';

$tgl_kecelakaan = $_GET["tgl_kecelakaan"];

$querysearch = "SELECT DISTINCT a.id_kecelakaan,a.total_kerugian,a.keterangan_lokasi,user_polisi.name as petugas, 
jenis_kecelakaan.jenis_kecelakaan,a.waktu_kejadian,
ST_X(ST_Centroid(a.geom)) AS longitude, ST_Y(ST_CENTROID(a.geom)) AS latitude FROM kecelakaan AS a JOIN user_polisi on a.id_pelapor=user_polisi.id JOIN jenis_kecelakaan on a.id_jeniskecelakaan=jenis_kecelakaan.id_jenis WHERE 
date(waktu_kejadian) ='".$tgl_kecelakaan."'";




$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
	{
		 $id_kecelakaan=$row['id_kecelakaan'];
          $total_kerugian=$row['total_kerugian'];
          $keterangan_lokasi=$row['keterangan_lokasi'];
          $jenis_kecelakaan=$row['jenis_kecelakaan'];
          $waktu = $row['waktu_kejadian'];
          $petugas=$row['petugas'];
          $longitude=$row['longitude']; 
          $latitude=$row['latitude'];
          $dataarray[]=array('id_kecelakaan'=>$id_kecelakaan,'petugas'=>$petugas,'waktu'=>$waktu,'jenis_kecelakaan'=>$jenis_kecelakaan,'total_kerugian'=>$total_kerugian, 'keterangan_lokasi'=>$keterangan_lokasi, 'longitude'=>$longitude,'latitude'=>$latitude);
	}
echo json_encode ($dataarray);



?>