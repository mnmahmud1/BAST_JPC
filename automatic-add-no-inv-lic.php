<?php
// Koneksi ke database MySQL
require "koneksi.php";
// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Dapatkan data invWithoutOrder dari permintaan POST
$invWithoutOrder = $_POST['invWithoutOrder'];

// Query untuk mendapatkan urutan terakhir berdasarkan invWithoutOrder
$sql = "SELECT MAX(SUBSTRING_INDEX(number, '/', -1)) AS lastOrder FROM lisences WHERE number LIKE '$invWithoutOrder%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Jika data ditemukan, ambil urutan terakhir
    $row = $result->fetch_assoc();
    $lastOrder = $row['lastOrder'];

    // Periksa apakah lastOrder adalah NULL
    if ($lastOrder !== NULL) {
        // Jika tidak NULL, tambahkan 1 ke urutan terakhir
        $lastOrder = (int)$lastOrder + 1;
    } else {
        // Jika NULL, atur urutan pertama ke '00'
        $lastOrder = 1;
    }

    // Format ulang urutan sebagai dua digit angka
    $lastOrder = sprintf("%02d", $lastOrder);

    echo $lastOrder;
} else {
    // Jika tidak ada data, atur urutan pertama ke '00'
    echo '01';
}

// Tutup koneksi database
$conn->close();
?>