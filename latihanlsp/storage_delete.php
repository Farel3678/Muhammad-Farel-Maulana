<?php
include 'koneksi.php';

$id = $_GET['id']; 
$query = "DELETE FROM storage_unit WHERE Id='$id'";
$result = mysqli_query($con, $query);

if ($result) {
    header("Location: storage_unit.php"); 
} else {
    echo "Gagal menghapus data: " . mysqli_error($con);
}
?>
