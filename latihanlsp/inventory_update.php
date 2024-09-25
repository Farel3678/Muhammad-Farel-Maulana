<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM inventory WHERE Id = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['Id'];
    $nama_barang = $_POST['Nama_barang'];
    $jenis_barang = $_POST['Jenis_barang'];
    $kuantitas_stock = $_POST['Kuantitas_stock'];
    $lokasi_gudang = $_POST['Lokasi_gudang'];
    $serial_number = $_POST['Serial_number'];
    $harga = $_POST['harga'];

    $query = "UPDATE inventory SET Nama_barang='$nama_barang', Jenis_barang='$jenis_barang', Kuantitas_stock='$kuantitas_stock', Lokasi_gudang='$lokasi_gudang', Serial_number='$serial_number', harga='$harga' WHERE Id=$id";
    $result = mysqli_query($con, $query);

    if ($result) {
        $message = 'Data updated successfully';
        header("Location: inventory.php");
        exit();
    } else {
        die("Query error: " . mysqli_error($con));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Inventory</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            overflow: hidden; /* Menyembunyikan scrollbars jika video meluas */
        }

        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; /* Menempatkan video di belakang konten lainnya */
        }

        .form-container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: LIGHTGREY; /* Latar belakang putih untuk formulir */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        header {
            margin-bottom: 20px;
        }

        h3 {
            color: #6a0dad; /* Ungu */
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 15px;
        }

        .submit-button {
            background-color: #6a0dad; /* Ungu */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            display: inline-block;
            text-decoration: none;
        }

        .submit-button:hover {
            background-color: #4b0082; /* Ungu tua */
        }

        .form-container .back-button {
    background-color: #ddd; /* Light grey for back button */
    color: #6a0dad; /* Ungu gelap */
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 5px;
    border: 1px solid #6a0dad; /* Ungu gelap border */
    transition: background-color 0.3s ease;
}

.form-container .back-button:hover {
    background-color: #ccc; /* Grey background on hover */
}
    </style>
</head>
<body>
    <video class="video-background" autoplay muted loop>
        <source src="videos/WhatsApp Video 2024-09-05 at 08.00.35.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="form-container">
        <header><h3>Update Inventory</h3></header>
        <form method="POST" action="inventory_update.php">
            <input type="hidden" name="Id" value="<?php echo $row['Id']; ?>">
            <label for="Nama_barang">Nama Barang:</label>
            <input type="text" id="Nama_barang" name="Nama_barang" value="<?php echo htmlspecialchars($row['Nama_barang']); ?>" required><br>

            <label for="Jenis_barang">Jenis Barang:</label>
            <input type="text" id="Jenis_barang" name="Jenis_barang" value="<?php echo htmlspecialchars($row['Jenis_barang']); ?>" required><br>

            <label for="Kuantitas_stock">Kuantitas Stock:</label>
            <input type="text" id="Kuantitas_stock" name="Kuantitas_stock" value="<?php echo htmlspecialchars($row['Kuantitas_stock']); ?>" required><br>

            <label for="Lokasi_gudang">Lokasi Gudang:</label>
            <input type="text" id="Lokasi_gudang" name="Lokasi_gudang" value="<?php echo htmlspecialchars($row['Lokasi_gudang']); ?>" required><br>

            <label for="Serial_number">Serial Number:</label>
            <input type="text" id="Serial_number" name="Serial_number" value="<?php echo htmlspecialchars($row['Serial_number']); ?>" required><br>

            <label for="harga">Harga:</label>
            <input type="text" id="harga" name="harga" value="<?php echo htmlspecialchars($row['harga']); ?>" required><br>
           
            <button class="submit-button" type="submit">Update</button>
            <a href="inventory.php" class="back-button">Back</a>
        </form>
    </div>
</body>
</html>
