<?php
session_start();

if (isset($_COOKIE['login'])) {
    header("Location:/ta_pariwisata/home");
}
else{
  header("Location:/ta_pariwisata/home");
  // phpinfo();
}

//$conn = mysqli_connect("localhost", "root", "", "user") or die("Gagal koneksi : ");

/*if(isset($_POST['login'])){
  if(isset($_POST['username']) && isset($_POST['password'])){
    $uname = $_POST['username'];
    $pw = $_POST['password'];
    $qSelect = mysqli_query($conn, "SELECT * FROM user WHERE username='$uname' AND password='$pw'") or die("kkk");
    if (mysqli_num_rows($qSelect) > 0) {
        $row = mysqli_fetch_assoc($qSelect);
        $_SESSION['login'] = true;
        $_SESSION['username'] = $row['username'];
        setcookie('login', true, time()+300);
        setcookie('username', $row['username'], time()+300);
        header("Location:dashboard.php");
      }       
  }

}*/
?>