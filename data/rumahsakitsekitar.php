<?php

	include("../action/connect.php");
    $latit = $_GET['lat'];
    $longi = $_GET['long'];
	$rad=$_GET['rad'];

	$querysearch="SELECT id_rumahsakit, nama, alamat, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), geom) as jarak FROM rumah_sakit where st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), geom) <= ".$rad.""; 

	$hasil=pg_query($querysearch);

        while($baris = pg_fetch_array($hasil))
            {
                $id=$baris['id_rumahsakit'];
                $nama=$baris['nama'];
                $alamat=$baris['alamat'];
                $latitude=$baris['lat'];
                $longitude=$baris['lng'];
                $dataarray[]=array('id'=>$id,'name'=>$nama,'alamat'=>$alamat, 'latitude'=>$latitude,'longitude'=>$longitude);
            }
            echo json_encode ($dataarray);
?>