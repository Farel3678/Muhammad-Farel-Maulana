<?php
include 'koneksi.php';

$id = $_GET['id']; 
$query = "DELETE FROM supplier WHERE Id='$id'";
$result = mysqli_query($con, $query);

if ($result) {
    header("Location: vendor_supplier.php"); 
} else {
    echo "Delete Fail: " . mysqli_error($con);
}
?>
