
<?php
include ($_SERVER['DOCUMENT_ROOT']."/Basisdatalanjut/value/location.php");
require $action.'/connect.php';

// $cari_nama = $_GET["cari_nama"];
$querysearch	="SELECT DISTINCT kecelakaan.id_kecelakaan, kecelakaan.total_kerugian,kecelakaan.keterangan_lokasi,ST_X(ST_Centroid(kecelakaan.geom)) AS longitude, ST_Y(ST_CENTROID(kecelakaan.geom)) AS latitude,kendaraan.id_detail FROM kecelakaan join kendaraan on kecelakaan.id_kecelakaan=kendaraan.id_kecelakaan where kendaraan.id_detail='2' ";
			   
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
    {
          $id_kecelakaan=$row['id_kecelakaan'];
          $total_kerugian=$row['total_kerugian'];
          $keterangan_lokasi=$row['keterangan_lokasi'];
          $longitude=$row['longitude']; 
          $latitude=$row['latitude'];
          $dataarray[]=array('id_kecelakaan'=>$id_kecelakaan,'total_kerugian'=>$total_kerugian, 'keterangan_lokasi'=>$keterangan_lokasi, 'longitude'=>$longitude,'latitude'=>$latitude);
    }
echo json_encode ($dataarray);

?>