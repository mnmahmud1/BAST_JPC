<?php

include "../../koneksi.php";

// Query untuk mengambil data Desc dari tabel inv_group
$sql = "SELECT `description` FROM inv_group";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    // Memasukkan data ke dalam array
    while($row = $result->fetch_assoc()) {
        $data[] = $row['description'];
    }
} else {
    echo "0 results";
}

// Menutup koneksi database
$conn->close();

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);