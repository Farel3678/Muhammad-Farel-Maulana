<?php
include 'koneksi.php'; 

if (!$con) {
    die('Database connection failed.');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM supplier WHERE Id = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die('Record not found.');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama = mysqli_real_escape_string($con, $_POST['nama']);
        $kontak = mysqli_real_escape_string($con, $_POST['kontak']);
        $nama_barang = mysqli_real_escape_string($con, $_POST['nama_barang']);
        $nomor_invoice = mysqli_real_escape_string($con, $_POST['nomor_invoice']);

        $check_query = "SELECT * FROM supplier WHERE Nama_barang = '$nama_barang' AND Id != '$id'";
        $check_result = mysqli_query($con, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $message = 'Error: Nama_barang already exists.';
        } else {
            $update_query = "UPDATE supplier SET Nama = '$nama', Kontak = '$kontak', Nama_barang = '$nama_barang', Nomor_invoice = '$nomor_invoice' WHERE Id = '$id'";

            if (mysqli_query($con, $update_query)) {
                $message = 'Data updated successfully';
                header('Refresh: 2; URL=vendor_supplier.php'); 
            } else {
                $message = 'Error updating record: ' . mysqli_error($con);
            }
        }
    }
} else {
    die('No ID specified.');
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Supplier</title>
    <style>
        /* Styling untuk notifikasi */
        .notification {
            background-color: #d4edda; /* Warna latar belakang hijau muda */
            border: 1px solid #c3e6cb; /* Border hijau muda */
            color: #155724; /* Teks hijau tua */
            padding: 15px;
            border-radius: 8px; /* Radius sudut */
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            position: relative;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Bayangan */
            animation: fadeIn 1s ease-out; /* Animasi masuk */
        }

        .notification.success {
            background-color: #d4edda; /* Hijau muda untuk sukses */
            border-color: #c3e6cb; /* Hijau muda untuk border */
            color: #155724; /* Hijau tua untuk teks */
        }

        .notification.error {
            background-color: #f8d7da; /* Merah muda untuk error */
            border-color: #f5c6cb; /* Merah muda untuk border */
            color: #721c24; /* Merah tua untuk teks */
        }

        /* Animasi untuk notifikasi */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Untuk close button */
        .notification .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: #155724; /* Hijau tua */
        }

        /* Styling untuk Video Background */
        video#bgVideo {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%; 
            min-height: 100%;
            z-index: -1;
            object-fit: cover; /* Agar video menutupi seluruh halaman */
            filter: brightness(0.8); /* Agar form lebih jelas */
        }

        body {
            background-color: lightpink; /* Background body */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: white;
        }

        .form-container {
            background-color: lightgrey; /* Latar belakang form container */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
        }

        .form-container h1 {
            color: #6a0dad; /* Ungu aesthetic */
            text-align: center;
        }

        .form-container label {
            display: block;
            margin: 10px 0 5px;
        }

        .form-container input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #6a0dad;
            box-sizing: border-box;
            margin-bottom: 15px;
        }
        /* Styling untuk label */
.form-container label {
    color: #6a0dad; /* Warna teks ungu */
    display: block;
    margin: 10px 0 5px;
}

        .submit-button {
            background-color: #6a0dad; /* Ungu aesthetic */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #dda0dd; /* Ungu muda */
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
    <!-- Video Background -->
    <video id="bgVideo" autoplay muted loop>
        <source src="videos/WhatsApp Video 2024-09-05 at 08.00.35.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="form-container">
        <h1>Update Supplier</h1>
        <?php if (isset($message)): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($row['Nama']); ?>" required><br>

            <label for="kontak">Kontak:</label>
            <input type="text" id="kontak" name="kontak" value="<?php echo htmlspecialchars($row['Kontak']); ?>" required><br>

            <label for="nama_barang">Nama Barang:</label>
            <input type="text" id="nama_barang" name="nama_barang" value="<?php echo htmlspecialchars($row['Nama_barang']); ?>" required><br>

            <label for="nomor_invoice">Nomor Invoice:</label>
            <input type="text" id="nomor_invoice" name="nomor_invoice" value="<?php echo htmlspecialchars($row['Nomor_invoice']); ?>" required><br>

            <input type="submit" value="Update" class="submit-button">
            <a href="vendor_supplier.php" class="back-button">Back</a>
        </form>
    </div>
</body>
</html>
  