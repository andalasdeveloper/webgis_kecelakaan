<?php
include ('../inc/connect.php');
$id = $_GET['id'];
$periode = $_GET['periode'];
	
	$sql   = "delete from administrators where id_worship_place='$id' and stewardship_period='$periode'";

	
	$delete = pg_query($sql);
	if ($delete){
			echo "<script>
		alert (' Data Successfully Delete');
		eval(\"parent.location='../?page=listpengurus'\");
		</script>";
	}
	else{
		echo 'error';

	}

?>