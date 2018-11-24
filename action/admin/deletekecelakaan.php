<?php
include $_SERVER['DOCUMENT_ROOT'].'/Basisdatalanjut/value/location.php';
include ($action.'/connect.php');

$id = $_GET['id'];
$sql = "DELETE FROM kecelakaan where id_kecelakaan='$id'";
$delete = pg_query($sql);
if ($delete){
    header('Location:/Basisdatalanjut/layout/admin/?page=listkecelakaan');
}
else{
    echo 'There is something error with your SQL ! Check it again !';
}
?>