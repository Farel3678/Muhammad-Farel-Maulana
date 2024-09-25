<?php
include 'koneksi.php';

// Mendapatkan query pencarian
$query = isset($_GET['query']) ? mysqli_real_escape_string($con, $_GET['query']) : '';

// Menyusun query SQL untuk pencarian
$sql = "
    SELECT 'inventory' AS table_name, Id AS id, Nama_barang AS name 
    FROM inventory 
    WHERE Nama_barang LIKE '%$query%' OR Lokasi_gudang LIKE '%$query%' OR Jenis_barang LIKE '%$query%' OR Serial_number LIKE '%$query%'
    UNION ALL
    SELECT 'storage_unit' AS table_name, Id AS id, Nama_gudang AS name 
    FROM storage_unit 
    WHERE Nama_gudang LIKE '%$query%' OR Lokasi_gudang LIKE '%$query%'
    UNION ALL
    SELECT 'supplier' AS table_name, Id AS id, Nama AS name 
    FROM supplier 
    WHERE Nama LIKE '%$query%' OR Nama_barang LIKE '%$query%' OR Nomor_invoice LIKE '%$query%'
";

// Menjalankan query
$result = mysqli_query($con, $sql);

if (!$result) {
    die("Query error: " . mysqli_error($con));
}

// Menampilkan hasil dan redireksi ke halaman form
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        switch ($row['table_name']) {
            case 'inventory':
                $url = "inventory.php?id=" . urlencode($row['id']);
                break;
            case 'storage_unit':
                $url = "storage_unit.php?id=" . urlencode($row['id']);
                break;
            case 'supplier':
                $url = "vendor_supplier.php?id=" . urlencode($row['id']);
                break;
        }

        // Debugging URL
        echo 'Redirecting to URL: ' . htmlspecialchars($url) . '<br>';

        // Redirect to the corresponding form page
        header("Location: " . $url);
        exit();
    }
} else {
    echo 'Tidak ada hasil yang ditemukan.';
}

// Menutup koneksi
mysqli_close($con);
?>
