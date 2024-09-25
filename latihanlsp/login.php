<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['Nama'];
    $email = $_POST['Email'];

    $nama = mysqli_real_escape_string($con, $nama);
    $email = mysqli_real_escape_string($con, $email);

    $sql = "SELECT * FROM Admin WHERE Nama='$nama' AND Email='$email'";
    $result = $con->query($sql);

    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['Nama'] = $nama;
        $_SESSION['Level'] = $row['Level'];

        $_SESSION['login_success'] = "Login berhasil! Selamat datang, " . htmlspecialchars($nama) . ".";

        if ($row['Level'] == 'Admin'){
            header("Location: dashboard.php");
        } else if ($row['Level'] == 'User'){
            header("Location: user.php");
        }
        exit();
    } else {
        echo "Nama atau Email salah. Silahkan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-size: cover;
            background-position: center;
            overflow: hidden;
        }

        /* Background video */
        video#bgVideo {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
            object-fit: cover; /* Agar video menyesuaikan ukuran layar */
            filter: brightness(0.8); /* Menggelapkan video agar form lebih jelas */
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Transparan dengan warna putih */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            z-index: 1; /* Supaya form berada di atas video */
        }

        h2 {
            text-align: center;
            color: #6a0dad; /* Ungu gelap */
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #6a0dad; /* Ungu gelap */
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #cccccc;
            border-radius: 3px;
        }

        button {
            background-color: #9b59b6; /* Ungu terang */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #6a0dad; /* Ungu gelap */
        }

        a {
            text-align: center;
            display: block;
            margin-top: 10px;
            color: #9b59b6; /* Ungu terang */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        p {
            text-align: center;
            color: #777777;
        }

        label[for="Nama"],
        label[for="Email"] {
            color: #6a0dad; /* Ungu gelap */
        }
    </style>
</head>
<body>
    <!-- Video Background -->
    <video id="bgVideo" autoplay muted loop>
        <source src="videos/WhatsApp Video 2024-09-05 at 08.00.35.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="container">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <label for="Nama">Nama:</label>
            <input type="text" name="Nama" required><br>
            <label for="Email">Email:</label>
            <input type="Email" name="Email" required><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>



