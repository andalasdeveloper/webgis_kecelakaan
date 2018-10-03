<?php
require '../controller/connect.php';
$cari = $_GET["cari"];
//$querysearch ="select worship_place.id, worship_place.name as name_mesjid, address, land_size, building_size, park_area_size, capacity, est, last_renovation, imam, jamaah, teenager, category_worship_place.name as name_category, image, ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat from worship_place join category_worship_place on category_worship_place.id=worship_place.id_category where worship_place.id='$cari'";
$querysearch = "SELECT id, spa.name, address, diskon, image, ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat  FROM spa where id='$cari'";
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil)) {
	$id = $row['id'];
	$spa_name = $row['name'];
	$address = $row['address'];
	$diskon = $row['diskon'];
	$image=$row['image'];
	$longitude=$row['lng'];
	$latitude=$row['lat'];
	if ($image=='null' || $image=='' || $image==null){
		$image='foto.jpg';
	}
	$dataarray[]=array('id'=>$id,'spa_name'=>$spa_name,'$address'=>$address, 'diskon'=>diskon, 'image'=>$image,'longitude'=>$longitude,'latitude'=>$latitude);

}
echo json_encode ($dataarray);
?>
