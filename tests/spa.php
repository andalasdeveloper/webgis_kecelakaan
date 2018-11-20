<?php
include $_SERVER['DOCUMENT_ROOT'].'/ta_pariwisata/value/location.php';
require $action.'/connect.php';

$query = "SELECT * FROM spa_user WHERE role='A' AND id_spa IS NULL ";
$hasil = pg_query($query);
$baris = pg_fetch_array($hasil);

$sql = pg_query("SELECT * FROM spa_user LEFT JOIN spa ON spa_user.id_spa = spa.id");
$data =  pg_fetch_array($sql);

echo var_dump($baris);
?>