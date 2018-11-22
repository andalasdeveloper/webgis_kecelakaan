<?php
session_start();

if (isset($_COOKIE['login'])) {
    header("Location:/Basisdatalanjut/home");
}
else{
  header("Location:/Basisdatalanjut/home");

}


?>