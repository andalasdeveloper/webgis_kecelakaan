<?php
include $_SERVER['DOCUMENT_ROOT'].'/Basisdatalanjut/value/location.php';
include ($action.'/connect.php');
$querysearch="	SELECT row_to_json(fc) 
				FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features 
				FROM (SELECT 'Feature' As type , ST_AsGeoJSON(kecamatan.geom)::json As geometry , row_to_json((SELECT l 
				FROM (SELECT kecamatan.nama,ST_X(ST_Centroid(kecamatan.geom)) AS lon, ST_Y(ST_CENTROID(kecamatan.geom)) As lat) As l )) As properties 
				FROM kecamatan As kecamatan  
				) As f ) As fc ";

$hasil=pg_query($querysearch);
while($data=pg_fetch_array($hasil))
	{
		$load=$data['row_to_json'];
	}
	echo $load;
?>