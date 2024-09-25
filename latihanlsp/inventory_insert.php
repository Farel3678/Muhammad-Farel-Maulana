
<!DOCTYPE html><?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gudang";

$con = new mysqli($servername, $username, $password, $dbname);
if (!$con) {
    die('Database connection failed.');
}

$message = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = mysqli_real_escape_string($con, $_POST['Nama_barang']);
    $jenis_barang = mysqli_real_escape_string($con, $_POST['Jenis_barang']);
    $kuantitas_stock = mysqli_real_escape_string($con, $_POST['Kuantitas_stock']);
    $lokasi_gudang = mysqli_real_escape_string($con, $_POST['Lokasi_gudang']);
    $serial_number = mysqli_real_escape_string($con, $_POST['Serial_number']);
    $harga = mysqli_real_escape_string($con, $_POST['harga']);

    $insert_query = "INSERT  INTO  inventory (Nama_barang, Jenis_barang, Kuantitas_stock, Lokasi_gudang, Serial_number, harga) VALUES ('$nama_barang', '$jenis_barang', '$kuantitas_stock', '$lokasi_gudang', '$serial_number', '$harga')";

    if (mysqli_query($con, $insert_query)) {
        $message = 'Data successfully inserted!';
    
        header("Refresh: 2; URL=inventory.php");
    } else {
        $message = 'Error inserting data: ' . mysqli_error($con);
    }
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Inventory</title>
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

        .container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: LIGHTGREY;
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

        input[type="text"], select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 15px;
            background-color: rgba(106, 13, 173, 0.1); /* Ungu muda dengan transparansi */
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

        .back-button {
            background-color: grey; /* Ungu */
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

        .back-button:hover {
            background-color: darkgrey; /* Ungu tua */
        }
    </style>
</head>
<body>
    <video class="video-background" autoplay muted loop>
        <source src="videos/WhatsApp Video 2024-09-05 at 08.00.35.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="container">
        <header><h3>Insert Inventory</h3></header>
        <form method="POST" action="inventory_insert.php">
            <label for="Nama_barang">Nama Barang:</label>
            <select id="Nama_barang" name="Nama_barang" required>
                <option value="" disabled selected>Select Nama Barang</option>
                <?php 
                include 'koneksi.php';
                $query_nama_barang = mysqli_query($con, "SELECT * FROM supplier");
                while ($data = mysqli_fetch_array($query_nama_barang)){
                    echo '<option value="'.$data['Nama_barang']. '">'.$data['Nama_barang'].'</option>';
                }
                ?>
            </select><br>

            <label for="Jenis_barang">Jenis Barang:</label>
            <input type="text" id="Jenis_barang" name="Jenis_barang" required><br>

            <label for="Kuantitas_stock">Kuantitas Stock:</label>
            <input type="text" id="Kuantitas_stock" name="Kuantitas_stock" required><br>

            <label for="Lokasi_gudang">Lokasi Gudang:</label>
            <select id="Lokasi_gudang" name="Lokasi_gudang" required>
                <option value="" disabled selected>Select Lokasi Gudang</option>
                <?php 
                include 'koneksi.php';
                $query_lokasi_gudang = mysqli_query($con, "SELECT * FROM storage_unit");
                while ($data = mysqli_fetch_array($query_lokasi_gudang)){
                    echo '<option value="'.$data['Lokasi_gudang']. '">'.$data['Lokasi_gudang'].'</option>';
                }
                ?>
            </select><br>

            <label for="Serial_number">Serial Number:</label>
            <input type="text" id="Serial_number" name="Serial_number" required><br>

            <label for="harga">Harga:</label>
            <input type="text" id="harga" name="harga" required><br>
           
            <button type="submit" class="submit-button">Insert</button>
            <button type="button" class="back-button" onclick="window.location.href='inventory.php'">Back</button>
        </form>
    </div>
</body>
</html>
