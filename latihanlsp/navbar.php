<?php 
include 'koneksi.php';
session_start();

if (isset($_SESSION['login_success'])) {
    echo '<div class="notification success">' . $_SESSION['login_success'] . '</div>';
    unset($_SESSION['login_success']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman dengan Background Video</title>
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

.navbar {
    background: linear-gradient(to right, #6a0dad, #ff00ff); /* Gradasi ungu tua ke magenta */
    padding: 15px;
    margin-bottom: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 1; /* Supaya navbar berada di atas video */
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar h1 {
    font-size: 26px;
    color: #fff;
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.navbar nav {
    display: flex;
    gap: 20px;
}

.navbar a {
    color: #ffffff;
    font-size: 18px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
    padding: 8px 15px;
    border-radius: 20px;
}

.navbar a:hover {
    background-color: rgba(255, 255, 255, 0.2); /* Efek hover pada navbar */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

.search-form {
    display: flex;
    align-items: center;
    gap: 5px;
}

.search-form input[type="text"] {
    padding: 10px;
    font-size: 16px;
    border-radius: 20px;
    border: 1px solid #6a0dad;
    outline: none;
    color: #6a0dad;
    background-color: #f3e5f5;
}

.search-form button {
    padding: 8px 15px;
    font-size: 16px;
    color: white;
    background-color: #6a0dad; /* Ungu aesthetic */
    border: none;
    border-radius: 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.search-form button:hover {
    background-color: #dda0dd; /* Ungu muda */
}

.konten {
    margin-left: 240px;
    padding: 20px;
    z-index: 1; /* Supaya konten berada di atas video */
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #f8f0fa; /* Latar belakang tabel berwarna ungu pastel */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
}

table, th, td {
    border: none;
}

th {
    background-color: #6a0dad; /* Warna ungu gelap untuk header */
    color: white;
    font-weight: bold;
    text-align: center;
    padding: 15px;
    font-size: 16px;
}

td {
    background-color: #f3e5f5; /* Ungu pastel untuk sel tabel */
    text-align: center;
    padding: 12px;
    color: #6a0dad;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

tr:hover td {
    background-color: #e1bee7; /* Efek hover */
}

h3 {
    background: linear-gradient(to right, #6a0dad, #ff00ff); /* Gradasi ungu tua ke magenta */
    color: white;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
    text-align: center;
}

.footer {
    background: linear-gradient(to right, #6a0dad, #ff00ff); /* Gradasi ungu tua ke magenta */
    color: white;
    text-align: center;
    padding: 15px;
    position: fixed;
    bottom: 0;
    width: 100%;
    box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
}

.footer p {
    margin: 0;
    font-size: 14px;
}

    </style>
</head>
<body>
    <!-- Video Background -->
    <video id="bgVideo" autoplay muted loop>
        <source src="videos/WhatsApp Video 2024-09-05 at 08.00.35.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="navbar">
        <h1>Selamat Datang</h1>
        <br><br>
        <nav>
            <a href="dashboard.php">Menu</a>
            <a href="inventory.php">Inventory</a>
            <a href="storage_unit.php">Storage</a>
            <a href="vendor_supplier.php">Supplier</a>
            <a href="logout.php">Logout</a>
            <form class="search-form" action="searching.php" method="GET">
            <input type="text" name="query" placeholder="Cari..." required>
            <button type="submit">Cari</button>
           </form>
        </nav>
    </div>

    <div class="konten">
        <!-- Isi halaman lainnya -->
    </div>

    <div class="footer">
        <p>&copy; Footer @2024 Angjay.Id.</p>
    </div>
</body>
</html>
