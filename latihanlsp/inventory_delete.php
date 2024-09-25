<?php
include 'koneksi.php';

$id = $_GET['id']; 
$query = "DELETE FROM inventory WHERE Id='$id'";
$result = mysqli_query($con, $query);

if ($result) {
    header("Location: inventory.php"); 
} else {
    echo "Gagal menghapus data: " . mysqli_error($con);
}
?>
