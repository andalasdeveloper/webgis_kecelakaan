<?php
require '../action/connect.php';
$cari = $_GET["cari"];
//$querysearch ="select worship_place.id, worship_place.name as name_mesjid, address, land_size, building_size, park_area_size, capacity, est, last_renovation, imam, jamaah, teenager, category_worship_place.name as name_category, image, ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat from worship_place join category_worship_place on category_worship_place.id=worship_place.id_category where worship_place.id='$cari'";
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
