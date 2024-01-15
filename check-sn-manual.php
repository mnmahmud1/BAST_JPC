<?php
    // Koneksi ke database
    require "koneksi.php";
    // (Pastikan Anda sudah terkoneksi ke database sebelumnya)

    // pemeriksaan SN barang otomatis dari goods dan good_incoming_details
    if (isset($_POST['snBarang'])) {
        $sn = $_POST['snBarang'];

        // Lakukan pengecekan di database good_incoming_details
        $query1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM good_incoming_details WHERE sn =
        '$sn'"));

        // Lakukan pengecekan di database goods
        $query2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM goods WHERE sn = '$sn'"));
        // Eksekusi query dan ambil hasilnya
        // (Pastikan Anda menggunakan metode koneksi ke database yang aman, seperti PDO atau MySQLi)

        $count = $query1["count"] + $query2["count"];

        if ($query1 && $query2) {
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