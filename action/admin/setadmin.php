<?php
include $_SERVER['DOCUMENT_ROOT']."/ta_pariwisata/value/location.php";
include $action."/connect.php";

if (isset($_POST['set_admin'])){
    $id_spa =  $_POST['id_spa'];
    $id_admin =  $_POST['admin'];
//    $select = pg_query("SELECT * FROM spa_user WHERE id='$id_admin'");
//    $spa = pg_fetch_array($select);
//    echo var_dump($id_spa);
    $query = "UPDATE spa_user SET id_spa='$id_spa' WHERE id='$id_admin'";
    $insert = pg_query($query);
    if ($insert){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        echo 'error';
    }
}
?>