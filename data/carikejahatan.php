
<?php
include ($_SERVER['DOCUMENT_ROOT']."/Basisdatalanjut/value/location.php");
require $action.'/connect.php';

// $cari_nama = $_GET["cari_nama"];
$querysearch	="SELECT DISTINCT no_laporan , kronologis, jenis_kejahatan,ST_X(ST_Centroid(geom)) AS longitude, ST_Y(ST_CENTROID(geom)) AS latitude FROM kejahatan ";
			   
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
    {
          $id=$row['no_laporan'];
          $kronologis=$row['kronologis'];
          $jenis_kejahatan=$row['jenis_kejahatan'];
          $longitude=$row['longitude']; 
          $latitude=$row['latitude'];
          $dataarray[]=array('id'=>$id,'kronologis'=>$kronologis,'jenis_kejahatan'=>$jenis_kejahatan, 'longitude'=>$longitude,'latitude'=>$latitude);
    }
echo json_encode ($dataarray);

?>