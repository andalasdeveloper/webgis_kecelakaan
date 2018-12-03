
<?php
include ($_SERVER['DOCUMENT_ROOT']."/Basisdatalanjut/value/location.php");
require $action.'/connect.php';

$cari_nama = $_GET["cari_nama"];

$querysearch = "SELECT korban_kecelakaan.id_kecelakaan FROM korban_kecelakaan WHERE nama='%$cari_nama%' 
UNION SELECT korban_kendaraan.id_kecelakaan FROM korban_kendaraan WHERE lower(nama)LIKE lower('%$cari_nama%')";


$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
	{
		  $id=$row['id_kecelakaan'];
		  $dataarray[]=array('id'
		  	=>$id);
	}
echo json_encode ($dataarray);



?>