<?php
require '../action/connect.php';

$cari = $_GET["cari"];

$querysearch	= "select id, nama, alamat,status, ST_X(ST_Centroid(geom)) AS longitude, ST_Y(ST_CENTROID(geom)) As latitude from pos_polisi where id='$cari'";
			   
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
    {
          $id=$row['id'];
          $nama=$row['nama'];
          $alamat=$row['alamat'];
          $status=$row['status'];
          $longitude=$row['longitude'];
          $latitude=$row['latitude'];
          $dataarray[]=array('id'=>$id,'name'=>$nama, 'alamat'=>$alamat,'status'=>$status,'longitude'=>$longitude,'latitude'=>$latitude);
    }
echo json_encode ($dataarray);
?>