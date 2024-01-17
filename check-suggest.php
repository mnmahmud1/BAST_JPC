<?php

    require "koneksi.php";

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil nilai input dari permintaan AJAX
    $inputText = $_POST['inputText'];

    // Query untuk mendapatkan saran dari database
    $query = "SELECT DISTINCT description FROM good_incoming_details WHERE description LIKE '%$inputText%'";
    $result = $conn->query($query);

    // Tampilkan saran dalam bentuk HTML (misalnya, dalam daftar ul)
    if ($result->num_rows > 0) {
        echo '<ul>';
        while ($row = $result->fetch_assoc()) {
            echo '<li>' . $row['description'] . '</li>';
        }
        echo '</ul>';
    } else {
        echo 'Tidak ada saran.';
    }

    $conn->close();