<?php
    // Koneksi ke database
    require "koneksi.php";
    // (Pastikan Anda sudah terkoneksi ke database sebelumnya)

    if (isset($_POST['sn'])) {
    $sn = $_POST['sn'];

    // Lakukan pengecekan di database
    $query = "SELECT COUNT(*) as count FROM good_incoming_details WHERE sn = '$sn'";
    // Eksekusi query dan ambil hasilnya
    // (Pastikan Anda menggunakan metode koneksi ke database yang aman, seperti PDO atau MySQLi)
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];

        if ($count > 0) {
            echo '<span style="color: red;">Serial Number sudah ada dalam database.</span>';
        } else {
            echo '<span style="color: green;">Serial Number tersedia.</span>';
        }
    } else {
        echo 'Gagal melakukan pengecekan.';
    }
    } else {
    echo 'Parameter "sn" tidak diterima.';
    }
?>