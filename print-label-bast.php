<?php
    require "koneksi.php";

	//periksa apakah ada cookie user_log
	if(!isset($_COOKIE["_beta_log"])){
		header("Location: login.php");
	}

    $nameUser = $_COOKIE["_name_log"];
    $idUser = $_COOKIE["_beta_log"];

    $bast_number = $_GET["bast"];
    $queryGetBAST = mysqli_query($conn, "SELECT identity FROM bast_report WHERE number = '$bast_number'");
    $getBAST = mysqli_fetch_assoc($queryGetBAST);

    // Mengirimkan data ke JavaScript
    echo "<script>let dataString = " . json_encode($getBAST['identity']) . ";</script>";
    if($bast_number == '' OR mysqli_num_rows($queryGetBAST) == 0){
		header("Location: berita-acara-serah-terima.php");
	}

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
        grid-template-columns: repeat(2, 1fr);
        /* Membagi menjadi 3 kolom */
        grid-gap: 10px;
        /* Jarak antar kolom */
        width: 100%;
        width: 210mm;
        margin: 0 auto;
        padding: 0mm;
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

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

    <div class="container">
        <table>
            <tbody>
                <tr>
                    <th>EMAIL</th>
                    <td class="identityEmail">mahmud@gmail.com</td>
                </tr>
                <tr>
                    <th>PASS</th>
                    <td class="identityPass"></td>
                </tr>
                <tr>
                    <th>DATE</th>
                    <td class="identityDate"></td>
                </tr>
                <tr>
                    <th>BAST</th>
                    <td class="identityBast">IT/BAST/2025/03/01</td>
                </tr>
                <tr>
                    <th>USER</th>
                    <td class="identityUser"></td>
                </tr>
            </tbody>
        </table>

        <table>
            <tbody>
                <tr>
                    <th>EMAIL</th>
                    <td class="identityEmail">mahmud@gmail.com</td>
                </tr>
                <tr>
                    <th>PASS</th>
                    <td class="identityPass"></td>
                </tr>
                <tr>
                    <th>DATE</th>
                    <td class="identityDate"></td>
                </tr>
                <tr>
                    <th>BAST</th>
                    <td class="identityBast">IT/BAST/2025/03/01</td>
                </tr>
                <tr>
                    <th>USER</th>
                    <td class="identityUser"></td>
                </tr>
            </tbody>
        </table>

        <table>
            <tbody>
                <tr>
                    <th>EMAIL</th>
                    <td class="identityEmail">mahmud@gmail.com</td>
                </tr>
                <tr>
                    <th>PASS</th>
                    <td class="identityPass"></td>
                </tr>
                <tr>
                    <th>DATE</th>
                    <td class="identityDate"></td>
                </tr>
                <tr>
                    <th>BAST</th>
                    <td class="identityBast">IT/BAST/2025/03/01</td>
                </tr>
                <tr>
                    <th>USER</th>
                    <td class="identityUser"></td>
                </tr>
            </tbody>
        </table>

        <table>
            <tbody>
                <tr>
                    <th>EMAIL</th>
                    <td class="identityEmail">mahmud@gmail.com</td>
                </tr>
                <tr>
                    <th>PASS</th>
                    <td class="identityPass"></td>
                </tr>
                <tr>
                    <th>DATE</th>
                    <td class="identityDate"></td>
                </tr>
                <tr>
                    <th>BAST</th>
                    <td class="identityBast">IT/BAST/2025/03/01</td>
                </tr>
                <tr>
                    <th>USER</th>
                    <td class="identityUser"></td>
                </tr>
            </tbody>
        </table>
    </div>




    <script>
    $(document).ready(function() {
        $(".preloader").fadeOut("slow");
    });

    $(document).ready(function() {
        // Memisahkan setiap pasangan key:value
        let pairs = dataString.split(";");

        // Loop melalui setiap pasangan key:value
        pairs.forEach(function(pair) {
            let parts = pair.split(":"); // Pisahkan key dan value
            if (parts.length === 2) { // Pastikan format key:value benar
                let key = parts[0].trim(); // Ambil nama variabel (id input)
                let value = parts[1].trim(); // Ambil nilainya

                // Cek apakah ada input dengan id yang sesuai, lalu isi nilainya
                if ($("." + key).length) {
                    $("." + key).text(value);
                }
            }
        });
    });
    </script>
</body>

</html>