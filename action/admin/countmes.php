<?php
include $_SERVER['DOCUMENT_ROOT'].'/Basisdatalanjut/value/location.php';
include ($action.'/connect.php');

//	$sql = "SELECT(SELECT COUNT(*) from worship_place WHERE id_category=1) AS masjid, (SELECT COUNT(*) FROM worship_place WHERE id_category=2) AS mushalla";
//	$sql = "SELECT COUNT(*) from spa AS spa";
	$sql = "SELECT(SELECT COUNT(*) FROM kecelakaan) AS kecelakaan, (SELECT COUNT(*) FROM user_polisi) AS user";
	$query = pg_query($sql);

	if(pg_num_rows($query)>0){
		$data = pg_fetch_assoc($query);
		return $data;
	}
?>


	
	