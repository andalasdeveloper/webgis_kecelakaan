<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/Basisdatalanjut/value/location.php';
require $action.'/connect.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "DELETE FROM spa_user WHERE id='$id'";

    $delete = pg_query($query);
    if ($delete){
        $_SESSION['status'] = 'success';
        $_SESSION['message'] = 'User berhasil dihapus !';
        header('Location:'.$lay.'/admin?page=user');
    }
    else{
        echo 'error';
    }
}
?>