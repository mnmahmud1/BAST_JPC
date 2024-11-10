<?php
    require "koneksi.php";

	//periksa apakah ada cookie user_log
	if(!isset($_COOKIE["_beta_log"])){
		header("Location: login.php");
	}

    $nameUser = $_COOKIE["_name_log"];
    $idUser = $_COOKIE["_beta_log"];

	$bast_number = $_GET["bast"];
	$queryGetBAST = mysqli_query($conn, "SELECT bast_report.number, users_submitted.name AS submitted_user_name, dept_submitted.name AS submitted_dept_name, users_accepted.name AS accepted_user_name, dept_accepted.name AS accepted_dept_name, users_submitted.nik AS submitted_user_nik, users_accepted.nik AS accepted_user_nik, bast_report.notes FROM bast_report INNER JOIN users AS users_submitted ON users_submitted.id = bast_report.id_user_submitted INNER JOIN users AS users_accepted ON users_accepted.id = bast_report.id_user_accepted INNER JOIN dept AS dept_submitted ON dept_submitted.id = users_submitted.id_dept INNER JOIN dept AS dept_accepted ON dept_accepted.id = users_accepted.id_dept WHERE bast_report.number = '$bast_number'");
	$getBAST = mysqli_fetch_assoc($queryGetBAST);
	if($bast_number == '' OR mysqli_num_rows($queryGetBAST) == 0){
		header("Location: berita-acara-serah-terima.php");
	}

	$getOneGoodsInBAST = mysqli_query($conn, "SELECT * FROM (SELECT goods.number, goods.description, goods.specification, goods.sn, goods.img, ROW_NUMBER() OVER (ORDER BY goods.number DESC) AS row_num FROM bast_report_details INNER JOIN goods ON goods.id = bast_report_details.id_good WHERE bast_report_details.id_inv_type = 1 AND bast_report_details.bast_number = '$bast_number') AS subquery WHERE row_num < 2");
	$getGoodsInBASTAfter = mysqli_query($conn, "SELECT * FROM (SELECT goods.number, goods.description, goods.specification, goods.sn, goods.img, ROW_NUMBER() OVER (ORDER BY goods.number DESC) AS row_num FROM bast_report_details INNER JOIN goods ON goods.id = bast_report_details.id_good WHERE bast_report_details.id_inv_type = 1 AND bast_report_details.bast_number = '$bast_number') AS subquery WHERE row_num > 1");
	$getOneLisenceInBAST = mysqli_query($conn, "SELECT * FROM (SELECT lisences.number, lisences.description, lisences.date_start, lisences.date_end, ROW_NUMBER() OVER (ORDER BY lisences.number DESC) AS row_num FROM bast_report_details INNER JOIN lisences ON lisences.id = bast_report_details.id_good WHERE bast_report_details.id_inv_type = 2 AND bast_report_details.bast_number = '$bast_number') AS subquery WHERE row_num < 2");
	$getLisenceInBASTAfter = mysqli_query($conn, "SELECT * FROM (SELECT lisences.number, lisences.description, lisences.date_start, lisences.date_end, ROW_NUMBER() OVER (ORDER BY lisences.number DESC) AS row_num FROM bast_report_details INNER JOIN lisences ON lisences.id = bast_report_details.id_good WHERE bast_report_details.id_inv_type = 2 AND bast_report_details.bast_number = '$bast_number') AS subquery WHERE row_num > 1");
	// Membuat objek IntlDateFormatter untuk bahasa Indonesia
	$formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'EEEE');

	// Mengambil tanggal saat ini
	$now = new DateTime();

	// Mengambil bagian-bagian dari tanggal
	$day = $formatter->format($now);
	$date = $now->format('d');
	$month = $now->format('F');
	$year = $now->format('Y');

	// Mengganti nama bulan ke bahasa Indonesia (jika diperlukan)
	$months = array(
		'January' => 'Januari',
		'February' => 'Februari',
		'March' => 'Maret',
		'April' => 'April',
		'May' => 'Mei',
		'June' => 'Juni',
		'July' => 'Juli',
		'August' => 'Agustus',
		'September' => 'September',
		'October' => 'Oktober',
		'November' => 'November',
		'December' => 'Desember'
	);
	$month = $months[$month];

    $numA = 1;
    $numB = 1;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Print Table</title>
    <style>
    /* CSS for print */
    @media print {

        /* Set paper size to A4 */
        @page {
            size: A4;
        }

        /* Ensure that content fits within A4 size */
        body {
            width: 210mm;
            height: 297mm;
            margin: 0;
            padding: 0;
            font-family: "Carlito", sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            font-size: 12pt;
        }

        footer {
            position: fixed;
            bottom: 0;
            right: 0;
            text-align: right;
            font-size: 12pt;
            display: block;
            position: fixed;
            /* Tetap di bagian bawah halaman */
            bottom: 0;
            width: 100%;
            z-index: 1000;
            /* Sesuaikan sesuai kebutuhan */
        }

        footer:after {
            content: "Page "counter(page) " of "counter(pages);
        }
    }

    /* Style for screen view */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    .container {
        width: 210mm;
        margin: 0 auto;
        padding: 10mm;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        page-break-inside: auto;
        /* Membolehkan pemutusan halaman di dalam tabel */
    }

    tr {
        page-break-inside: avoid;
        /* Hindari pemutusan halaman di tengah baris tabel */
        page-break-after: auto;
    }

    thead {
        display: table-header-group;
        /* Pastikan header tabel muncul di setiap halaman */
    }

    tfoot {
        display: table-footer-group;
        /* Memastikan footer tabel muncul di setiap halaman, jika ada */
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

    <!-- Start of First Page -->
    <div class="container">
        <!-- Header Section -->
        <table class="header-table">
            <tr>
                <td class="no-border" style="text-align: center" rowspan="2"><img src="dist/img/bast/jpc.png"
                        alt="Logo JPC" /></td>
                <td class="no-border">
                    <div style="text-align: center; font-weight: bold">BERITA ACARA SERAH TERIMA INVENTARIS</div>
                    <div style="text-align: center; font-weight: bold">PT. JAKARTA PRIMA CRANES</div>
                </td>
                <td class="no-border" style="text-align: center" rowspan="2"><img src="dist/img/bast/k3.png"
                        alt="Logo k3" style="width: 45px" /></td>
            </tr>
            <tr>
                <td>
                    <div style="text-align: center">Nomor : <?= $bast_number ?></div>
                </td>
            </tr>
        </table>

        <!-- Information Section -->
        <table>
            <tr style="text-align: justify">
                <td colspan="4">Pada hari ini <b><?= $day ?></b>, tanggal <b><?= $date ?></b>, bulan
                    <b><?= $month ?></b>, Tahun <b><?= $year ?></b>
                    akan dilakukan serah terima inventaris dengan rincian sebagai berikut.
                </td>
            </tr>
        </table>

        <!-- Pihak Yang Melakukan Serah Terima Section -->
        <table>
            <tr>
                <th colspan="4">Pihak Yang Melakukan Serah Terima</th>
            </tr>
            <tr>
                <th>Nama</th>
                <th>Departemen</th>
                <th>NIP</th>
                <th>Pihak</th>
            </tr>
            <tr>
                <td><?= $getBAST['accepted_user_name'] ?></td>
                <td><?= $getBAST['accepted_dept_name'] ?></td>
                <td><?= $getBAST['accepted_user_nik'] ?></td>
                <td>PENERIMA</td>
            </tr>
            <tr>
                <td><?= $getBAST['submitted_user_name'] ?></td>
                <td><?= $getBAST['submitted_dept_name'] ?></td>
                <td><?= $getBAST['submitted_user_nik'] ?></td>
                <td>PEMBERI</td>
            </tr>
        </table>

        <!-- Rincian Inventaris Diserahkan Section -->
        <table>
            <tr>
                <th colspan="5">Inventaris Diserahkan</th>
            </tr>
            <tr>
                <th>No.</th>
                <th>No. Inventaris</th>
                <th>Deskripsi</th>
                <th>Spesifikasi & Kelengkapan</th>
                <th>Gambar</th>
            </tr>
            <?php if(mysqli_num_rows($getOneGoodsInBAST) == 0) : ?>
            <tr>
                <td colspan="5" style="text-align: center">Tidak ada data inventaris</td>
            </tr>
            <?php else : ?>
            <?php foreach($getOneGoodsInBAST as $one) : ?>
            <tr>
                <td>1</td>
                <td><?= $one["number"] ?></td>
                <td><?= $one["description"] ?></td>
                <td><?= $one["specification"] ?></td>
                <td><img src="dist/img/<?= $one["img"] ?>" alt="Gambar Laptop" width="100" /></td>
            </tr>
            <?php endforeach ?>
            <?php endif ?>
        </table>

        <!-- Lisences Details Section -->
        <table>
            <tr>
                <th colspan="4">Lisensi Software Digunakan</th>
            </tr>
            <tr>
                <th>No.</th>
                <th>No. Lisensi</th>
                <th>Deskripsi</th>
                <th>Start Date / End Date</th>
            </tr>
            <?php if(mysqli_num_rows($getOneLisenceInBAST) == 0) : ?>
            <tr>
                <td colspan="4" style="text-align: center">Tidak ada data lisensi software</td>
            </tr>
            <?php else : ?>
            <?php foreach( $getOneLisenceInBAST as $one ) : ?>
            <tr>
                <td>1</td>
                <td><?= $one["number"] ?></td>
                <td><?= $one["description"] ?></td>
                <td><?= date("d/m/Y", strtotime($one['date_start'])) ?>
                    -
                    <?php if($one["date_end"] == "0000-00-00 00:00:00") : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-infinity" viewBox="0 0 16 16">
                        <path
                            d="M5.68 5.792 7.345 7.75 5.681 9.708a2.75 2.75 0 1 1 0-3.916ZM8 6.978 6.416 5.113l-.014-.015a3.75 3.75 0 1 0 0 5.304l.014-.015L8 8.522l1.584 1.865.014.015a3.75 3.75 0 1 0 0-5.304l-.014.015zm.656.772 1.663-1.958a2.75 2.75 0 1 1 0 3.916z" />
                    </svg>
                    <?php else : ?>
                    <?= date("d/m/Y", strtotime($one['date_end'])) ?>
                    <?php endif ?>
                </td>
            </tr>
            <?php endforeach ?>
            <?php endif ?>
        </table>

        <!-- Keterangan Tambahan Section -->
        <table>
            <tr>
                <th>Keterangan Tambahan</th>
            </tr>
            <tr>
                <td><?= $getBAST["notes"] ?></td>
            </tr>
        </table>

        <!-- Signature Section -->
        <table class="signature-table">
            <tr>
                <th colspan="4">
                    Tanda Tangan <br />
                    <span style="font-size: small; font-weight: lighter">(Dengan menandatangani dokumen ini maka
                        karyawan
                        setuju dengan ketentuan-ketentuan yang sudah di tetapkan perusahaan)</span>
                </th>
            </tr>
            <tr>
                <th style="text-align: center">Menyerahkan</th>
                <th style="text-align: center">Menerima</th>
                <th style="text-align: center">Mengetahui</th>
                <th style="text-align: center">Menyetujui</th>
            </tr>
            <tr style="height: 100px; font-weight: bold">
                <td id="submitted"
                    style="text-align: center; vertical-align: bottom; padding-bottom: 0; display: table-cell; width: 25%">
                    <?= $getBAST['submitted_user_name'] ?></td>
                <td id="accepted"
                    style="text-align: center; vertical-align: bottom; padding-bottom: 0; display: table-cell; width: 25%">
                    <?= $getBAST['accepted_user_name'] ?></td>
                <td
                    style="text-align: center; vertical-align: bottom; padding-bottom: 0; display: table-cell; width: 25%">
                    Ali Rakhman</td>
                <td
                    style="text-align: center; vertical-align: bottom; padding-bottom: 0; display: table-cell; width: 25%">
                    Bramantya Zain</td>
            </tr>
        </table>

        <footer>
            <div class="page-number" style="text-align: right; padding-top: 5px"></div>
        </footer>
    </div>


    <!-- Start of Second Page -->
    <div class="container" style="page-break-before: always;">
        <!-- Header Section -->
        <table class="header-table">
            <tr>
                <td class="no-border" style="text-align: center" rowspan="2"><img src="dist/img/bast/jpc.png"
                        alt="Logo JPC" /></td>
                <td class="no-border">
                    <div style="text-align: center; font-weight: bold">BERITA ACARA SERAH TERIMA INVENTARIS</div>
                    <div style="text-align: center; font-weight: bold">PT. JAKARTA PRIMA CRANES</div>
                </td>
                <td class="no-border" style="text-align: center" rowspan="2"><img src="dist/img/bast/k3.png"
                        alt="Logo k3" style="width: 45px" /></td>
            </tr>
            <tr>
                <td>
                    <div style="text-align: center">Nomor : <?= $bast_number ?></div>
                </td>
            </tr>
        </table>
        <!-- Rincian Inventaris Diserahkan Section -->
        <table>
            <tr>
                <th colspan="5">Daftar Tambahan Inventaris Diserahkan</th>
            </tr>
            <tr>
                <th>No.</th>
                <th>No. Inventaris</th>
                <th>Deskripsi</th>
                <th>Spesifikasi & Kelengkapan</th>
                <th>Gambar</th>
            </tr>
            <?php if(mysqli_num_rows($getGoodsInBASTAfter) == 0) : ?>
            <tr>
                <td colspan="5" style="text-align: center">Tidak ada data inventaris tambahan</td>
            </tr>
            <?php else : ?>
            <?php foreach($getGoodsInBASTAfter as $after) : ?>
            <tr>
                <td><?= $numA ?></td>
                <td><?= $after["number"] ?></td>
                <td><?= $after["description"] ?></td>
                <td><?= $after["specification"] ?></td>
                <td><img src="dist/img/<?= $after["img"] ?>" alt="Gambar Laptop" width="100" /></td>
            </tr>
            <?php $numA++; endforeach ?>
            <?php endif ?>
        </table>

        <!-- Lisences Details Section -->
        <table>
            <tr>
                <th colspan="4">Daftar Tambahan Lisensi Software Digunakan</th>
            </tr>
            <tr>
                <th>No.</th>
                <th>No. Lisensi</th>
                <th>Deskripsi</th>
                <th>Start Date / End Date</th>
            </tr>
            <?php if(mysqli_num_rows($getLisenceInBASTAfter) == 0) : ?>
            <tr>
                <td colspan="4" style="text-align: center">Tidak ada data lisensi software tambahan</td>
            </tr>
            <?php else : ?>
            <?php foreach( $getLisenceInBASTAfter as $one ) : ?>
            <tr>
                <td><?= $numB ?></td>
                <td><?= $one["number"] ?></td>
                <td><?= $one["description"] ?></td>
                <td><?= date("d/m/Y", strtotime($one['date_start'])) ?>
                    -
                    <?php if($one["date_end"] == "0000-00-00 00:00:00") : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-infinity" viewBox="0 0 16 16">
                        <path
                            d="M5.68 5.792 7.345 7.75 5.681 9.708a2.75 2.75 0 1 1 0-3.916ZM8 6.978 6.416 5.113l-.014-.015a3.75 3.75 0 1 0 0 5.304l.014-.015L8 8.522l1.584 1.865.014.015a3.75 3.75 0 1 0 0-5.304l-.014.015zm.656.772 1.663-1.958a2.75 2.75 0 1 1 0 3.916z" />
                    </svg>
                    <?php else : ?>
                    <?= date("d/m/Y", strtotime($one['date_end'])) ?>
                    <?php endif ?>
                </td>
            </tr>
            <?php $numB++; endforeach ?>
            <?php endif ?>
        </table>

        <!-- Additional Signature Section -->
        <table class="signature-table">
            <tr>
                <th>Ketentuan-Ketentuan</th>
            </tr>
            <tr style="height: 100px">
                <td style="text-align: justify; padding-right: 30px">
                    <ol style="margin-left: 0">
                        <li>Karyawan bertanggung jawab atas keamanan dan kehati-hatian dalam menggunakan barang
                            inventaris terkait.</li>
                        <li>Karyawan harus menggunakan barang inventaris sesuai dengan kebijakan perusahaan, termasuk
                            untuk kepentingan kerja dan tidak untuk tujuan pribadi yang melanggar kebijakan perusahaan.
                        </li>
                        <li>Karyawan dilarang mengubah konfigurasi atau menginstal perangkat lunak lain pada laptop
                            tanpa izin dari departemen IT atau pihak berwenang lainnya.</li>
                        <li>Jika barang inventaris mengalami kerusakan atau masalah teknis lainnya yang disebabkan oleh
                            kelalaian karyawan tersebut dan tidak terjamin oleh garansi, maka biaya perbaikan dibebankan
                            kepada karyawan sesuai dengan kebijakan perusahaan.</li>
                        <li>Karyawan harus memahami bahwa pelanggaran terhadap ketentuan penggunaan barang inventaris
                            kantor dapat mengakibatkan sanksi sesuai dengan kebijakan perusahaan.</li>
                        <li>Jika karyawan
                            berhenti atau mengakhiri masa kerja dengan perusahaan, karyawan wajib mengembalikan semua
                            barang inventaris kantor sesuai dengan prosedur yang ditetapkan.</li>
                    </ol>
                </td>
            </tr>
        </table>
        <footer>
            <div class="page-number" style="text-align: right; padding-top: 5px"></div>
        </footer>
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


    // Script untuk menghitung halaman
    window.onload = function() {
        const totalPages = Math.ceil(document.body.scrollHeight / window.innerHeight);
        const footers = document.querySelectorAll('footer .page-number');

        footers.forEach(function(footer, index) {
            footer.textContent = `Page ${index + 1} of ${totalPages}`;
        });
    };
    </script>
</body>

</html>