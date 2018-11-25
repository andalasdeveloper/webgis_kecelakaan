
<?php
include ($_SERVER['DOCUMENT_ROOT']."/Basisdatalanjut/value/location.php");
require $action.'/connect.php';

$cari_nama = $_GET["cari_nama"];

$querysearch = "select korban_kecelakaan.id_kecelakaan from korban_kecelakaan where nama='ferguso' union select korban_kendaraan.id_kecelakaan from korban_kendaraan where lower(nama)like lower('%$cari_nama%')";


$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
	{
		  $id=$row['id_kecelakaan'];
		  $dataarray[]=array('id'
		  	=>$id);
	}
echo json_encode ($dataarray);



?>