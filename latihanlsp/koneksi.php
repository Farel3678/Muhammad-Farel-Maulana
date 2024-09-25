<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gudang";

$con = new mysqli($servername, $username, $password, $dbname);
 if ($con->connect_error){
    die("koneksi gagal: " . $con->connect_error);
 }
?>