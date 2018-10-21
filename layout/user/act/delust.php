<?php
include ('../inc/connect.php');
$id = $_GET['id'];
	$sql   = "delete from detail_event where id_det_event=$id";
	$sql   = "delete from ustad where id=$id";
	$delete1 = pg_query($sql1);
	$delete = pg_query($sql);
	if ($delete1){
			echo "<script>
		alert (' Data Successfully Delete');
		eval(\"parent.location='../?page=listustad'\");
		</script>";
	}
	else{
		echo 'error';

	}
	if ($delete){
			echo "<script>
		alert (' Data Successfully Delete');
		eval(\"parent.location='../?page=listustad'\");
		</script>";
	}
	else{
		echo 'error';

	}

?>