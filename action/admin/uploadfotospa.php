<?php
include $_SERVER['DOCUMENT_ROOT'].'/Basisdatalanjut/value/location.php';
include ($action.'/connect.php');

    $id = $_POST['id'];
    foreach ($_FILES['files']['name'] as $key => $val){
        echo $_FILES['files']['name'][$key]."<br>";
    }


?>