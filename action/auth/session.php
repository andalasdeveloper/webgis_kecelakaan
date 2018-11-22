<?php
include $_SERVER['DOCUMENT_ROOT'].'/Basisdatalanjut/value/location.php';
include ($action.'/connect.php');
session_start();
if(isset($_POST['username'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	$pass = md5(md5($password));
	//$pass=$password;
	$sql = pg_query("SELECT * FROM user_polisi WHERE upper(username)=upper('$username') and password='$pass'");
	$num = pg_num_rows($sql);
	$dt = pg_fetch_array($sql);
	if($num==1){
		$_SESSION['username'] = $username;
        $_SESSION['name'] = $dt['name'];
        $_SESSION['id_user'] = $dt['id'];
        
		if($dt['role']=='SA'){
			$_SESSION['SA'] = true;
			$_SESSION['status'] = 'success';
			header("Location:/Basisdatalanjut/admin");
		}
		
		if($dt['role']=='A'){
			$_SESSION['A'] = true;
//			$_SESSION['username'] = $dt['username'];
			
			?><script language="JavaScript">document.location='/Basisdatalanjut/layout/user'</script><?php
		}
		$result = pg_query("update administrators set last_login = now() where username='$username'");		
	}else{
		echo "<script>
		alert (' Login Failed, Please Fill Your Username and Password Correctly !');
		eval(\"parent.location='/Basisdatalanjut/layout/login.php '\");	
		</script>";
	}
}
?>