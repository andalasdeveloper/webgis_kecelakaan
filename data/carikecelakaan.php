
<?php
include ($_SERVER['DOCUMENT_ROOT']."/ta_pariwisata/value/location.php");
require $action.'/connect.php';

// $cari_nama = $_GET["cari_nama"];
$querysearch	="SELECT DISTINCT a.id_kecelakaan,a.total_kerugian,a.keterangan_lokasi,ST_X(ST_Centroid(a.geom)) AS longitude, ST_Y(ST_CENTROID(a.geom)) AS latitude FROM kecelakaan AS a";
			   
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