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
$nama = $_POST['nama'];
$email = $_POST['email'];
$telepon = $_POST['telepon'];

// Mendapatkan informasi file
$ijazah = $_FILES['ijazah'];
$ijazahName = $ijazah['name'];
$ijazahTmpName = $ijazah['tmp_name'];
$ijazahSize = $ijazah['size'];
$ijazahError = $ijazah['error'];
$ijazahType = $ijazah['type'];

// Mengecek apakah folder 'uploads' ada, jika tidak maka buat folder tersebut
if (!is_dir('uploads')) {
    mkdir('uploads', 0777, true);
}

// Mengecek apakah file berhasil diupload
if ($ijazahError === 0) {
    $ijazahExt = pathinfo($ijazahName, PATHINFO_EXTENSION);
    $ijazahNewName = uniqid('', true) . "." . $ijazahExt;
    $ijazahDestination = 'uploads/' . $ijazahNewName;

    // Memindahkan file ke folder 'uploads'
    if (move_uploaded_file($ijazahTmpName, $ijazahDestination)) {
        // Menyimpan data ke database
        $sql = "INSERT INTO pendaftaran (nama, email, telepon, ijazah) VALUES ('$nama', '$email', '$telepon', '$ijazahNewName')";

        if ($conn->query($sql) === TRUE) {
            echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <title>Pendaftaran Berhasil</title>
                <link rel='stylesheet' href='design/submit.css'> <!-- Tautan ke file CSS eksternal -->
            </head>
            <body>
                <h2>Data berhasil disimpan</h2>
                <table>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Nama File Ijazah</th>
                    </tr>
                    <tr>
                        <td>$nama</td>
                        <td>$email</td>
                        <td>$telepon</td>
                        <td>$ijazahNewName</td>
                    </tr>
                </table>
                <button onclick=\"history.back()\">Back</button>
            </body>
            </html>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Terjadi kesalahan saat mengupload file.";
    }
} else {
    echo "Terjadi kesalahan: $ijazahError";
}

// Menutup koneksi
$conn->close();
?>
