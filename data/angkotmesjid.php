<?php
    include("../controller/connect.php");
    $id = $_GET['id'];

    //  $result = pg_query("SELECT detail_worship_place.id_worship_place,angkot.destination, angkot.route_color, detail_worship_place.id_angkot,worship_place.name, detail_worship_place.lat, detail_worship_place.lng, ST_X(ST_Centroid(worship_place.geom)) AS longitude, ST_Y(ST_CENTROID(worship_place.geom)) AS latitude FROM detail_worship_place LEFT JOIN angkot ON detail_worship_place.id_angkot=angkot.id LEFT JOIN worship_place ON detail_worship_place.id_worship_place =worship_place.id WHERE detail_worship_place.id_worship_place='$id' ");
    $result = pg_query("SELECT detail_spa.id_spa, angkot.destination, angkot.route_color, detail_spa.id_angkot, spa.name, detail_spa.lat, detail_spa.lng, ST_X(ST_Centroid(spa.geom)) AS longitude, ST_Y(ST_CENTROID(spa.geom)) AS latitude FROM detail_spa LEFT JOIN angkot ON detail_spa.id_angkot = angkot.id LEFT JOIN spa ON detail_spa.id_spa = spa.id WHERE detail_spa.id_spa='$id' ");

        while($baris = pg_fetch_array($result))
            {
                $id_angkot=$baris['id_angkot'];
                $id_spa=$baris['id_spa'];
                $destination=$baris['destination'];
                $name=$baris['name'];
                $route_color=$baris['route_color'];
                $latitude=$baris['latitude'];
                $longitude=$baris['longitude'];
				$lat=$baris['lat'];
                $lng=$baris['lng'];
                $dataarray[]=array('id_angkot'=>$id_angkot,'id_spa'=>$id_spa,'destination'=>$destination,'name'=>$name, 'route_color'=>$route_color,"latitude"=>$latitude,"longitude"=>$longitude, "lat"=>$lat,"lng"=>$lng);
            }
            echo json_encode ($dataarray);
?>