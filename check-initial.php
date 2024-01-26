<?php
    // Koneksi ke database
    require "koneksi.php";
    // (Pastikan Anda sudah terkoneksi ke database sebelumnya)

    // pemeriksaan SN barang otomatis dari goods dan good_incoming_details
    if (isset($_POST['initialCheck'])) {
        $initial = $_POST['initialCheck'];

        // Lakukan pengecekan di database good_incoming_details
        $query1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM users WHERE initial =
        '$initial'"));

        // Lakukan pengecekan di database goods
        $query2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM users WHERE initial = '$initial'"));
        // Eksekusi query dan ambil hasilnya
        // (Pastikan Anda menggunakan metode koneksi ke database yang aman, seperti PDO atau MySQLi)

        $count = $query1["count"] + $query2["count"];

        if ($query1 && $query2) {
            if ($count > 0) {
                echo '<span style="color: red;">Inisial sudah ada dalam database.</span>';
            } else {
                echo '<span style="color: green;">Inisial tersedia.</span>';
            }
        } else {
            echo 'Gagal melakukan pengecekan.';
        }
    } else {
        echo 'Parameter "inisial" tidak diterima.';
    }