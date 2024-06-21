<html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='style/style.css'>
        <title>Pengiriman Berhasil</title>
        <link rel="icon" href="img/bsi.png" />
        <script type="text/javascript">
            function message()
            {
                alert("Pengiriman Berhasil !! Akan segera kami hubungi kembali")
            }
        </script>
    </head>
    <body onload="message()">
    </body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namadepan = htmlspecialchars($_POST['nama-depan']);
    $namabelakang = htmlspecialchars($_POST['nama-belakang']);
    $email = htmlspecialchars($_POST['email']);
    $nohp = htmlspecialchars($_POST['no-hp']);
    $message = htmlspecialchars($_POST['message']);

    echo "<!DOCTYPE html>
    <body>
        <div class='confirmation-message'>
            <center><h1>Terima kasih telah menghubungi kami, $namadepan!</h1><br></center>
            <center><p>Kami telah menerima pesan Anda dan kami akan segera menghubungi Anda kembali.</p><br></center>
            <center><a href='index.html'>Kembali ke Home</a></center>
        </div>
    </body>
    </html>";
}
?>