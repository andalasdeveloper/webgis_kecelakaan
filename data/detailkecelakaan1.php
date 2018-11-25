<?php
require '../action/connect.php';
$cari = $_GET["cari"];
$querysearch = "SELECT id_kecelakaan, kecelakaan.total_kerugian, keterangan_lokasi, image, ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat  FROM kecelakaan where id_kecelakaan='$cari'";
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil)) {
	$id = $row['id_kecelakaan'];
    $total_kerugian = $row['total_kerugian'];
    $address = $row['keterangan_lokasi'];
    $image=$row['image'];
	$longitude=$row['lng'];
	$latitude=$row['lat'];
	if ($image=='null' || $image=='' || $image==null){
		$image='foto.jpg';
	}
	$dataarray[]=array('id_kecelakaan'=>$id,'total_kerugian'=>$total_kerugian,'$address'=>$address, 'image'=>$image,'longitude'=>$longitude,'latitude'=>$latitude);

}
echo json_encode ($dataarray);
?>
