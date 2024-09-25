<?php 
include 'koneksi.php';
session_start();

if (isset($_SESSION['login_success'])) {
    echo '<div class="notification success">' . $_SESSION['login_success'] . '</div>';
    unset($_SESSION['login_success']);
}

// Query untuk mengecek barang yang stoknya 0
$sql = "SELECT * FROM inventory WHERE Kuantitas_stock = 0";
$result = $con->query($sql);

// Menampilkan pesan jika ada stok barang habis
if ($result->num_rows > 0) {
    echo "<div class='alert'>";
    echo "<button class='close-btn' onclick='this.parentElement.style.display=\"none\";'>&times;</button>";
    echo "Stok barang berikut habis:";
    while ($row = $result->fetch_assoc()) {
        echo "<p class='info-barang'>Nama Barang: <span class='nama-barang'>" . $row['Nama_barang'] . "</span> - Lokasi: <span class='lokasi'>" . $row['Lokasi_gudang'] . "</span></p>";
    }
    echo "</div>";
} else {
    echo "<div class='alert'>";
    echo "<button class='close-btn' onclick='this.parentElement.style.display=\"none\";'>&times;</button>";
    echo "Tidak ada barang yang habis stok.";
    echo "</div>";
}

// Tutup koneksi
$con->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman dengan Background Video</title>
    <style>
/* Styling untuk alert */
.alert {
    background-color: #f8d7da; /* Warna merah muda untuk alert */
    border: 1px solid #f5c6cb; /* Border merah muda */
    color: #721c24; /* Warna teks merah tua */
    padding: 15px;
    margin: 20px auto;
    border-radius: 8px; /* Sudut kotak melengkung */
    width: 80%;
    max-width: 600px;
    text-align: left;
    position: relative;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Efek bayangan */
}

/* Gaya untuk tombol close */
.alert .close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    color: #721c24; /* Warna teks merah tua */
}

/* Styling untuk informasi Nama Barang dan Lokasi */
.info-barang {
    margin: 10px 0;
}

.nama-barang {
    font-weight: bold;
    color: #721c24; /* Warna merah tua */
}

.lokasi {
    font-style: italic;
    color: #155724; /* Warna hijau tua */
}

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
    background: linear-gradient(to right, #4b0082, #ff00ff); /* Gradasi ungu tua ke magenta */
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
    border: 1px solid #ff00ff;
    outline: none;
    color: #4b0082;
    background-color: #f3e5f5;
}

.search-form button {
    padding: 8px 15px;
    font-size: 16px;
    color: white;
    background-color: #4b0082; /* Ungu tua */
    border: none;
    border-radius: 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.search-form button:hover {
    background-color: #ff00ff; /* Magenta */
}

.konten {
    margin-left: 240px;
    padding: 20px;
    z-index: 1; /* Supaya konten berada di atas video */
}
h3 {
    background: linear-gradient(to right, #4b0082, #ff00ff); /* Gradasi ungu tua ke magenta */
    color: white;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
    text-align: center;
}

.footer {
    background: linear-gradient(to right, #4b0082, #ff00ff); /* Gradasi ungu tua ke magenta */
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

/* General Styling */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    color: #333;
    background-color: #f3e5f5; /* Background color */
}

/* Heading */
.heading {
    text-align: center;
    padding: 20px;
    background-color: #9900CC; /* Background color for heading */
    color: white;
}

.heading h2 {
    margin: 0;
    font-size: 28px;
}

.heading p {
    font-size: 18px;
    margin: 10px 0 0;
}

/* Card Layout */
.card-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    padding: 20px;
}

.card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 10px;
    padding: 20px;
    text-align: center;
    flex: 1;
    max-width: 300px;
}

.card h3 {
    margin-top: 0;
    color: white;
}

.card p {
    font-size: 16px;
    color: #555;
}

.card .btn {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 20px;
    background-color: #4b0082; /* Ungu tua */
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 16px;
}

.card .btn:hover {
    background-color: #ff00ff; /* Magenta */
}

/* Call-to-Action Section */
.cta {
    text-align: center;
    padding: 30px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 20px auto;
    max-width: 600px;
}

.cta h3 {
    margin-top: 0;
    color: white;
}

.cta p {
    font-size: 18px;
    color: #555;
}

.cta .cta-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4b0082; /* Ungu tua */
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 16px;
}

.cta .cta-btn:hover {
    background-color: #ff00ff; /* Magenta */
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

<!-- Heading -->
<div class="heading">
    <h2>Selamat Datang di Platform Kami</h2>
    <p>Jelajahi fitur dan layanan kami di bawah ini!</p>
</div>

<!-- Card Layout -->
<div class="card-container">
    <div class="card">
        <h3>Fitur 1</h3>
        <p>Temukan bagaimana fitur pertama kami dapat membantu Anda mencapai tujuan Anda.</p>
        <a href="#feature1" class="btn">Pelajari Lebih Lanjut</a>
    </div>
    <div class="card">
        <h3>Fitur 2</h3>
        <p>Ketahui lebih lanjut tentang fitur kedua kami dan bagaimana manfaatnya bagi Anda.</p>
        <a href="#feature2" class="btn">Pelajari Lebih Lanjut</a>
    </div>
    <div class="card">
        <h3>Fitur 3</h3>
        <p>Jelajahi manfaat dari fitur ketiga kami secara detail.</p>
        <a href="#feature3" class="btn">Pelajari Lebih Lanjut</a>
    </div>
</div>

<!-- Call-to-Action -->
<div class="cta">
    <h3>Ayo Mulai Sekarang!</h3>
    <p>Daftar hari ini dan mulai menjelajahi semua fitur luar biasa yang kami tawarkan.</p>
    <a href="signup.php" class="btn cta-btn">Daftar</a>
</div>
<div class="footer">
        <p>&copy; Footer @2024 Angjay.Id.</p>
    </div>