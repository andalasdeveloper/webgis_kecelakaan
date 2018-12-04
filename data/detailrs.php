<?php
require '../action/connect.php';

$cari = $_GET["cari"];
$querysearch	= "SELECT id_rumahsakit, nama, alamat, ST_X(ST_Centroid(geom)) AS longitude, ST_Y(ST_CENTROID(geom)) As latitude FROM rumah_sakit WHERE id_rumahsakit='$cari'";
			   
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
    {
          $id=$row['id_rumahsakit'];
          $nama=$row['nama'];
          $alamat=$row['alamat'];
          $longitude=$row['longitude'];
          $latitude=$row['latitude'];
          $dataarray[]=array('id'=>$id,'name'=>$nama, 'alamat'=>$alamat,'longitude'=>$longitude,'latitude'=>$latitude);
    }
echo json_encode ($dataarray);
?>