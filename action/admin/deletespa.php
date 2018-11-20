<?php
include $_SERVER['DOCUMENT_ROOT'].'/ta_pariwisata/value/location.php';
include ($action.'/connect.php');

$id = $_GET['id'];
$sql = "DELETE FROM kecelakaan where id_kecelakaan='$id'";
$delete = pg_query($sql);
if ($delete){
    header('Location:/ta_pariwisata/layout/admin/?page=listspa');
}
else{
    echo 'There is something error with your SQL ! Check it again !';
}
?>