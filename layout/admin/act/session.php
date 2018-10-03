<?php
include ('../inc/connect.php');
session_start();
if(isset($_POST['username'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	$pass = md5(md5($password));
	//$pass=$password;
	$sql = pg_query("SELECT * FROM administrators WHERE upper(username)=upper('$username') and password='$pass'");
	$num = pg_num_rows($sql);
	$dt = pg_fetch_array($sql);
	if($num==1){		
		$_SESSION['username'] = $username;
		
		if($dt['role']=='A'){

			$_SESSION['A'] = true;
			?><script language="JavaScript">document.location='../'</script><?php
			echo "<script>
		alert (' hyyy');	
		</script>";
		}
		
		if($dt['role']=='P'){
			$sql=pg_query("select max(stewardship_period) from administrators where id_worship_place='$dt[id_worship_place]'");
			$dt2=pg_fetch_assoc($sql);
			if($dt['stewardship_period']!=$dt2['max'])
			{
			echo "<script>
			alert (' Your Period is Expired !');
			eval(\"parent.location='../login.php '\");	
			</script>";
			}
			$_SESSION['P'] = true;
			$_SESSION['username']=$dt['username'];
			$_SESSION['id_worship_place']=$dt['id_worship_place'];
			$_SESSION['name']=$dt['name'];
			$query=pg_query("select * from worship_place where id='$dt[id_worship_place]'");
			$data=pg_fetch_assoc($query);
			$_SESSION['id']=$data['id'];
			?><script language="JavaScript">document.location='../index1.php'</script><?php
		}
		$result = pg_query("update administrators set last_login = now() where username='$username'");		
	}else{
		echo "<script>
		alert (' Login Failed, Please Fill Your Username and Password Correctly !');
		eval(\"parent.location='../login.php '\");	
		</script>";
	}
}
?>