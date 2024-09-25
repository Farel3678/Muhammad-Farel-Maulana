<?php
include 'koneksi.php'; 

if (!$con) {
    die('Database connection failed.');
}

$message = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $kontak = mysqli_real_escape_string($con, $_POST['kontak']);
    $nama_barang = mysqli_real_escape_string($con, $_POST['nama_barang']);
    $nomor_invoice = mysqli_real_escape_string($con, $_POST['nomor_invoice']);

    $insert_query = "INSERT INTO supplier (Nama, Kontak, Nama_barang, Nomor_invoice) VALUES ('$nama', '$kontak', '$nama_barang', '$nomor_invoice')";

    if (mysqli_query($con, $insert_query)) {
        $message = 'Data successfully inserted!';
        header("Refresh: 2; URL=vendor_supplier.php");
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
    <title>Insert New Supplier</title>
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

        .form-container h2 {
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
    <!-- Video Background -->
    <video id="bgVideo" autoplay muted loop>
        <source src="videos/WhatsApp Video 2024-09-05 at 08.00.35.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="form-container">
        <h2>Insert New Supplier</h2>
        <?php if ($message): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form action="vendor_insert.php" method="POST">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required><br>

            <label for="kontak">Kontak:</label>
            <input type="text" id="kontak" name="kontak" required><br>

            <label for="nama_barang">Nama Barang:</label>
            <input type="text" id="nama_barang" name="nama_barang" required><br>

            <label for="nomor_invoice">Nomor Invoice:</label>
            <input type="text" id="nomor_invoice" name="nomor_invoice" required><br>

            <input type="submit" value="Insert" class="submit-button">
            <a href="vendor_supplier.php" class="back-button">Back</a>
        </form>
    </div>
</body>
</html>
