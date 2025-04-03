<?php
    require "koneksi.php";

	//periksa apakah ada cookie user_log
	if(!isset($_COOKIE["_beta_log"])){
		header("Location: login.php");
	}

    if(!isset($_COOKIE["selectedLabels"])){
		header("Location: barang.php");
	}

    $nameUser = $_COOKIE["_name_log"];
    $idUser = $_COOKIE["_beta_log"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Print Table</title>
    <style>
    /* Style untuk Container */
    .container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        /* Membagi menjadi 3 kolom */
        grid-gap: 10px;
        /* Jarak antar kolom */
        width: 100%;
        width: 210mm;
        margin: 0 auto;
        padding: 10mm;
    }

    /* Style untuk Tabel */
    table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        margin-bottom: 5px;
        /* Memberi jarak antar tabel */
    }

    td {
        border: 1px solid black;
        padding: 0px 30px 0px 30px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
        border: 1px solid black;
    }

    td {
        text-align: left;
        white-space: nowrap;
        /* Mencegah teks terpotong */
    }

    /* Style untuk gambar di dalam tabel */
    img {
        max-width: 50px;
        height: auto;
        display: block;
        margin: auto;
        padding: 0;
    }
    </style>

    <!-- Jquery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="dist/css/public.css" />
    <link href="https://fonts.googleapis.com/css2?family=Carlito&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="preloader">
        <div class="loading">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <?php
        $selectedLabels = $_COOKIE["selectedLabels"];
        // var_dump($selectedLabels);

        // Mendekode JSON menjadi array
        $dataArray = json_decode($selectedLabels, true);
    ?>


    <div class="container">
        <?php foreach($dataArray as $data) : ?>
        <table>
            <tbody>
                <tr>
                    <th rowspan="2"><img src="dist\img\inv\logo.webp" alt="" srcset=""></th>
                    <td style="background-color: #f2f2f2;">NOMOR INVENTARIS</td>
                </tr>
                <tr>
                    <td><?= $data ?></td>
                </tr>
            </tbody>
        </table>
        <?php endforeach ?>

    </div>











    <script>
    $(document).ready(function() {
        $(".preloader").fadeOut("slow");
    });

    // Function penamaan pada tanda tangan
    function capitalizeText(text) {
        return text.toLowerCase().split(' ').map(function(word, index) {
            // Keep the first letter of the first word uppercase, and capitalize other words
            return index === 0 ? word.toUpperCase() : word.charAt(0).toUpperCase() + word.slice(1);
        }).join(' ');
    }

    // Select the td element by id
    const submittedElement = document.getElementById("submitted");
    const acceptedElement = document.getElementById("accepted");

    // Get the current text content
    const submittedText = submittedElement.textContent;
    const acceptedText = acceptedElement.textContent;

    // Apply the transformation
    const transformedTextSubmitted = capitalizeText(submittedText);
    const transformedTextAccepted = capitalizeText(acceptedText);

    // Update the td element's content with the transformed text
    submittedElement.textContent = transformedTextSubmitted;
    acceptedElement.textContent = transformedTextAccepted;
    </script>
</body>

</html>