<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Jika form dikirim
    if (isset($_POST['confirm_logout'])) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Logout</title>
    <style>
        body {
            background-color: #f0f4f7; /* Warna latar belakang lembut */
            font-family: Arial, sans-serif; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
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
            background-color: rgba(211, 211, 211, 0.9); /* Light grey dengan transparansi */
            padding: 20px;
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #6a0dad; /* Ungu */
        }

        p {
            color: #555555; /* Abu-abu gelap */
        }

        form {
            margin-top: 20px;
        }

        button {
            background-color: #6a0dad; /* Ungu untuk tombol logout */
            color: white; 
            border: 2px solid lightgrey; /* Border light grey untuk tombol logout */
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 0 10px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #4b0082; /* Ungu tua untuk hover */
            transform: scale(1.05); 
        }

        .cancel-button {
            background-color: #f44336; /* Merah untuk tombol batal */
            color: white; /* Teks putih pada tombol batal */
            border: none; /* Menghapus border default */
        }

        .cancel-button:hover {
            background-color: #d32f2f; /* Merah tua untuk hover */
        }

        a {
            color: #6a0dad; /* Ungu untuk tautan */
            text-decoration: none;
            font-size: 16px;
            margin: 0 10px;
        }

        a:hover {
            text-decoration: underline; 
        }
    </style>
</head>
<body>
    <video class="video-background" autoplay muted loop>
        <source src="videos/WhatsApp Video 2024-09-05 at 08.00.35.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="container">
        <h1>Konfirmasi Logout</h1>
        <p>Apakah Anda yakin ingin logout?</p>
        <form method="post" action="">
            <button type="submit" name="confirm_logout">Ya, Logout</button>
            <button type="button" class="cancel-button" onclick="window.location.href='dashboard.php'">Batal</button>
        </form>
    </div>
</body>
</html>
