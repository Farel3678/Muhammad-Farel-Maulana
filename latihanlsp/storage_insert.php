<?php
include 'koneksi.php'; 

if (!$con) {
    die('Database connection failed.');
}

$message = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Nama_gudang = mysqli_real_escape_string($con, $_POST['Nama_gudang']);
    $Lokasi_gudang = mysqli_real_escape_string($con, $_POST['Lokasi_gudang']);

    // Query insert data, pastikan tidak ada koma berlebih
    $insert_query = "INSERT INTO storage_unit (Nama_gudang, Lokasi_gudang) VALUES ('$Nama_gudang', '$Lokasi_gudang')";

    if (mysqli_query($con, $insert_query)) {
        $message = 'Data successfully inserted!';
        header("Refresh: 2; URL=storage_unit.php");
        exit(); // Pastikan script berhenti setelah header
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
    <title>Insert New Storage</title>
    <style>
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

/* Styling untuk Form Container */
.form-container {
    background-color: #f0f0f0; /* Light grey background */
    padding: 20px;
    border-radius: 8px;
    max-width: 500px;
    margin: 100px auto; /* Center the container */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: relative; /* Relative positioning for overlaying content */
    z-index: 1; /* Ensure the form is above the background video */
}

/* Styling untuk Teks dan Form */
.form-container h2 {
    color: #6a0dad; /* Ungu gelap */
    text-align: center;
}

.form-container label {
    display: block;
    margin: 10px 0 5px;
    font-weight: bold;
    color: #6a0dad; /* Ungu gelap */
}

.form-container input[type="text"] {
    width: calc(100% - 22px); /* Full width minus padding */
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #6a0dad; /* Ungu gelap border */
    outline: none;
    box-sizing: border-box;
    color: #6a0dad; /* Ungu gelap */
    background-color: #f9f9f9; /* Light grey background */
    margin-bottom: 15px;
}

.form-container .submit-button {
    background-color: #6a0dad; /* Ungu aesthetic */
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.form-container .submit-button:hover {
    background-color: #4a0080; /* Ungu lebih gelap saat hover */
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

    <!-- Form Container -->
    <div class="form-container">
        <h2>Insert New Storage</h2>
        <?php if ($message): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form action="storage_insert.php" method="POST">
            <label for="Nama_gudang">Nama Gudang:</label>
            <input type="text" id="Nama_gudang" name="Nama_gudang" required><br>

            <label for="Lokasi_gudang">Lokasi Gudang:</label>
            <input type="text" id="Lokasi_gudang" name="Lokasi_gudang" required><br>

            <input type="submit" value="Insert" class="submit-button">
            <a href="storage_unit.php" class="back-button">Back</a>
        </form>
    </div>
</body>
</html>
