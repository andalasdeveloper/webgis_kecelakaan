<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT']."/Basisdatalanjut/value/location.php";
    include $action."/connect.php";
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_hp = $_POST['no_hp'];
	$role = $_POST['role'];
	$no_anggota = $_POST['no_anggota'];
	$user = $_POST['username'];
	$password = $_POST['password'];
	$pass = md5(md5($password));
	$query = "INSERT INTO user_polisi (id,name, address, hp, role, username, password) values ('$no_anggota','$nama', '$alamat', '$no_hp','$role', '$user', '$pass')";
    
    $insert = pg_query($query);
	if ($insert){
	    $_SESSION['status'] = 'success';
	    $_SESSION['message'] = 'User berhasil ditambah !';
        header('Location:'.$lay.'/admin?page=user');
    }else{
	    echo 'error';
    }
?>