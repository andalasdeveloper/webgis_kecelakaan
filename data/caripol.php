
<?php
include ($_SERVER['DOCUMENT_ROOT']."/Basisdatalanjut/value/location.php");
require $action.'/connect.php';

// $cari_nama = $_GET["cari_nama"];
$querysearch	="SELECT DISTINCT id , nama, alamat,status,ST_X(ST_Centroid(geom)) AS longitude, ST_Y(ST_CENTROID(geom)) AS latitude FROM pos_polisi ";
			   
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
    {
          $id=$row['id'];
          $nama=$row['nama'];
          $alamat=$row['alamat'];
          $status=$row['status'];
          $longitude=$row['longitude']; 
          $latitude=$row['latitude'];
          $dataarray[]=array('id'=>$id,'nama'=>$nama, 'alamat'=>$alamat,'status'=>$status, 'longitude'=>$longitude,'latitude'=>$latitude);
    }
echo json_encode ($dataarray);

?>