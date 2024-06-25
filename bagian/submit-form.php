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
$nama = $_POST['name'];
$email = $_POST['email'];
$telepon = $_POST['phone'];
$jenis_beasiswa = $_POST['scholarship_type'];
$komentar = $_POST['comments'];

// Mendapatkan informasi file
$sertifikatFiles = $_FILES['certificates'];
$sertifikatNames = [];
$uploadDirectory = 'uploads/';

if (!is_dir($uploadDirectory)) {
    mkdir($uploadDirectory, 0777, true);
}

for ($i = 0; $i < count($sertifikatFiles['name']); $i++) {
    $sertifikatName = $sertifikatFiles['name'][$i];
    $sertifikatTmpName = $sertifikatFiles['tmp_name'][$i];
    $sertifikatExt = pathinfo($sertifikatName, PATHINFO_EXTENSION);
    $sertifikatNewName = uniqid('', true) . "." . $sertifikatExt;
    $sertifikatDestination = $uploadDirectory . $sertifikatNewName;

    if (move_uploaded_file($sertifikatTmpName, $sertifikatDestination)) {
        $sertifikatNames[] = $sertifikatNewName;
    } else {
        echo "Terjadi kesalahan saat mengupload file: $sertifikatName<br>";
    }
}

// Mengubah array menjadi string yang dipisahkan koma
$sertifikatNamesString = implode(',', $sertifikatNames);

// Menyimpan data ke database
$sql = "INSERT INTO pendaftaran_beasiswa (nama, email, telepon, jenis_beasiswa, sertifikat, komentar) 
        VALUES ('$nama', '$email', '$telepon', '$jenis_beasiswa', '$sertifikatNamesString', '$komentar')";

if ($conn->query($sql) === TRUE) {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <title>Pendaftaran Berhasil</title>
        <link rel='stylesheet' href='design/form.css'> <!-- Tautan ke file CSS eksternal -->
    </head>
    <body>
        <h2>Data berhasil disimpan</h2>
        <table>
            <tr>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Jenis Beasiswa</th>
                <th>Nama File Sertifikat</th>
                <th>Komentar Tambahan</th>
            </tr>
            <tr>
                <td>$nama</td>
                <td>$email</td>
                <td>$telepon</td>
                <td>$jenis_beasiswa</td>
                <td>" . implode('<br>', $sertifikatNames) . "</td>
                <td>$komentar</td>
            </tr>
        </table>
        <button onclick=\"history.back()\">Back</button>
    </body>
    </html>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
