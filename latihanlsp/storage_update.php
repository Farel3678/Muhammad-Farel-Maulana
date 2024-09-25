<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    die('ID tidak ada.');
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $query = "SELECT * FROM storage_unit WHERE Id = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
}

$id = mysqli_real_escape_string($con, $_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_gudang = mysqli_real_escape_string($con, $_POST['nama_gudang']);
    $lokasi_gudang = mysqli_real_escape_string($con, $_POST['lokasi_gudang']);

    $update_query = "UPDATE storage_unit SET Nama_gudang='$nama_gudang', Lokasi_gudang='$lokasi_gudang' WHERE Id='$id'";

    if (mysqli_query($con, $update_query)) {
        $message = 'Data successfully updated';
        header("Refresh: 2; URL=storage_unit.php");
    } else {
        $message = 'Error updating data: ' . mysqli_error($con);
    }
} else {
    $result = mysqli_query($con, "SELECT * FROM storage_unit WHERE Id='$id'");
    $row = mysqli_fetch_assoc($result);
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Storage Unit</title>
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
        <h2>Update Storage Unit</h2>
        <?php if (isset($message)): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form action="storage_update.php?id=<?php echo htmlspecialchars($id); ?>" method="POST">
            <label for="nama_gudang">Nama Gudang:</label><br>
            <input type="text" id="nama_gudang" name="nama_gudang" value="<?php echo htmlspecialchars($row['Nama_gudang']); ?>" required><br><br>

            <label for="lokasi_gudang">Lokasi Gudang:</label><br>
            <input type="text" id="lokasi_gudang" name="lokasi_gudang" value="<?php echo htmlspecialchars($row['Lokasi_gudang']); ?>" required><br><br>

            <input type="submit" value="Update" class="submit-button">
            <a href="storage_unit.php" class="back-button">Back</a>
        </form>
    </div>
</body>
</html>


