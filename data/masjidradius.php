<?php
include ($_SERVER['DOCUMENT_ROOT']."/Basisdatalanjut/value/location.php");
require $action.'/connect.php';
$latit=$_GET["lat"];
$longi=$_GET["lng"];
$rad=$_GET["rad"];

/*$querysearch="SELECT id, name,st_x(st_centroid(geom)) AS lon,st_y(st_centroid(geom)) AS lat,
	st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), worship_place.geom) AS jarak
	FROM worship_place where st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1),
	worship_place.geom) <= ".$rad." ORDER BY jarak"; */

$querysearch = "SELECT id, name,st_x(st_centroid(geom)) AS lon,st_y(st_centroid(geom)) AS lat,
	st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), kecelakaan.geom) AS jarak 
	FROM kecelakaan WHERE st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1),
	spa.geom) <= ".$rad." ORDER BY jarak";

$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
	{
		  $id=$row['id_kecelakaan'];
		  $name=$row['total_kerugian'];
		  $longitude=$row['lon'];
		  $latitude=$row['lat'];
		  $dataarray[]=array('id'=>$id,'name'=>$name,
		  'longitude'=>$longitude,'latitude'=>$latitude);
	}
echo json_encode ($dataarray);
?>