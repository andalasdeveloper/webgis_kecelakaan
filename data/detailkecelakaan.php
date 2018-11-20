<?php
require '../action/connect.php';
$cari = $_GET["cari"];

$querysearch = "SELECT kecelakaan.id_kecelakaan AS id, kecelakaan.total_kerugian AS total_kerugian, kecelakaan.keterangan_lokasi AS keterangan_lokasi, kecelakaan.image AS image, ST_X(ST_Centroid(kecelakaan.geom)) AS lng, ST_Y(ST_CENTROID(kecelakaan.geom)) AS lat FROM kecelakaan WHERE id_kecelakaan='$cari'";
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
	{
		  $id=$row['id'];
		  $total_kerugian=$row['total_kerugian'];
		  $keterangan_lokasi=$row['keterangan_lokasi'];
		  $image=$row['image'];
		  $longitude=$row['lng'];
		  $latitude=$row['lat'];
		  $dataarray[]=array('id'=>$id,'total_kerugian'=>$total_kerugian,'keterangan_lokasi'=>$keterangan_lokasi,
		  	'image'=>$image, 'longitude'=>$longitude,'latitude'=>$latitude);
		  echo json_encode($dataarray);

		
	}
	
	
?>
