<?php
include ('../inc/connect.php');
$id = $_GET['id'];
	
	$sql   = "delete from worship_place where id='$id' ON DELETE CASCADE ";

	
	$delete = pg_query($sql);
	if ($delete){
			echo "<script>
		alert (' Data Successfully Delete');
		eval(\"parent.location='../?page=homeadmin'\");
		</script>";
	}
	else{
		echo 'error';

	}

?>