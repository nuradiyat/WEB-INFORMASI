<?php
// Konfigurasi database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "ubsi"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan data dari formulir
$namaDepan = $_POST['nama-depan'];
$namaBelakang = $_POST['nama-belakang'];
$email = $_POST['email'];
$noHp = $_POST['no-hp'];
$message = $_POST['message'];

// Menyimpan data ke database
$sql = "INSERT INTO contacts (nama_depan, nama_belakang, email, no_hp, message) VALUES ('$namaDepan', '$namaBelakang', '$email', '$noHp', '$message')";

// Jika query berhasil
if ($conn->query($sql) === TRUE) {


    // Menampilkan data yang disimpan dalam bentuk tabel
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <title>Data Berhasil Disimpan</title>
        <link rel='stylesheet' href='style/contact.css'> <!-- Tautan ke file CSS eksternal -->
    </head>
    <body>
        <h2>Data berhasil disimpan</h2>
        <table>
            <tr>
                <th>Nama Depan</th>
                <th>Nama Belakang</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Pesan</th>
            </tr>
            <tr>
                <td>$namaDepan</td>
                <td>$namaBelakang</td>
                <td>$email</td>
                <td>$noHp</td>
                <td>$message</td>
            </tr>
        </table>

        <button onclick=\"history.back()\">Back</button>
    </body>
    </html>";
    
} else {
    // Menampilkan pesan error jika query gagal
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>