
<?php
require '../controller/connect.php';

$cari_nama = $_GET["cari_nama"];
 

$querysearch	="SELECT DISTINCT a.id,a.name,a.address, a.diskon,ST_X(ST_Centroid(a.geom)) AS longitude, ST_Y(ST_CENTROID(a.geom)) AS latitude FROM spa AS a";
			   
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
    {
          $id=$row['id'];
          $name=$row['name'];
          $address=$row['address'];
          $diskon=$row['diskon'];
          $longitude=$row['longitude'];
          $latitude=$row['latitude'];
          $dataarray[]=array('id'=>$id,'name'=>$name, 'address'=>$address, 'diskon'=>$diskon, 'longitude'=>$longitude,'latitude'=>$latitude);
    }
echo json_encode ($dataarray);

?>