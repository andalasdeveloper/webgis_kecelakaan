<?php
include ('../inc/connect.php');


$id	= $_POST['id'];
$time = $_POST['time'];
$date = $_POST['date'];
$id_keg = $_POST['id_keg'];
$jam = $_POST['jam'];
$tgl_keg = $_POST['tgl_keg'];
$id_ustad = $_POST['id_ustad'];
$materi = $_POST['materi'];

$sql  = "update detail_event set id_event='$id_keg', time='$jam', date='$tgl_keg', id_ustad='$id_ustad', description='$materi' where time='$time' and date='$date' and id_worship_place='$id'";
$update = pg_query($sql);

if ($update){
	echo "<script>
		alert (' Data Successfully Change');
		eval(\"parent.location='../index1.php?page=listevent'\");
		</script>";
}else{
	echo 'error';
}
?>