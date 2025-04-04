<?php
	//fungsi ini digunakan jika beberapa kali gagal, dan jika berhasil login failed_log nya di reset/ dihapus 
	setcookie("failed_log", "", time() - 1, "/");
    require "koneksi.php";

	//periksa apakah ada cookie user_log
	if(!isset($_COOKIE["_beta_log"])){
		header("Location: login.php");
	}

    $nameUser = $_COOKIE["_name_log"];

    $getRecentGoods = mysqli_query($conn, "SELECT number, description FROM goods ORDER BY id DESC LIMIT 5");
    $getCountGoods = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS total FROM goods"));
    $getCountLisences = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS total FROM lisences"));
    $getCountBast = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS total FROM bast_report"));
    $getCountUsers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS total FROM users"));
    $getChartGoods = mysqli_query($conn, "WITH last_6_months AS ( SELECT DATE_FORMAT(DATE_SUB(NOW(), INTERVAL n MONTH), '%Y-%m') AS bulan FROM ( SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 ) AS numbers ) SELECT l.bulan, COALESCE(g.jumlah_item, 0) AS jumlah_item FROM last_6_months l LEFT JOIN ( SELECT DATE_FORMAT(created_at, '%Y-%m') AS bulan, COUNT(*) AS jumlah_item FROM goods WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH) GROUP BY bulan ) g ON l.bulan = g.bulan ORDER BY l.bulan ASC");
    $getChartBast = mysqli_query($conn, "WITH last_6_months AS ( SELECT DATE_FORMAT(DATE_SUB(NOW(), INTERVAL n MONTH), '%Y-%m') AS bulan FROM ( SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 ) AS numbers ) SELECT l.bulan, COALESCE(g.jumlah_item, 0) AS jumlah_item FROM last_6_months l LEFT JOIN ( SELECT DATE_FORMAT(created_at, '%Y-%m') AS bulan, COUNT(*) AS jumlah_item FROM bast_report WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH) GROUP BY bulan ) g ON l.bulan = g.bulan ORDER BY l.bulan ASC");

    // Untuk Chart Goods/Inventaris
    $labelsGoods = [];
    $valuesGoods = [];
    
    while ($row = mysqli_fetch_assoc($getChartGoods)) {
        // Format label jadi seperti 'Apr 25'
        $bulanFormatted = date('M y', strtotime($row['bulan'] . '-01'));
        $labelsGoods[] = $bulanFormatted;
        $valuesGoods[] = (int) $row['jumlah_item'];
    }
    
    $labelsGoods_json = json_encode($labelsGoods);
    $valuesGoods_json = json_encode($valuesGoods);

    // Untuk Chart BAST
    $labelsBast = [];
    $valuesBast = [];
    
    while ($row = mysqli_fetch_assoc($getChartBast)) {
        // Format label jadi seperti 'Apr 25'
        $bulanFormatted = date('M y', strtotime($row['bulan'] . '-01'));
        $labelsBast[] = $bulanFormatted;
        $valuesBast[] = (int) $row['jumlah_item'];
    }
    
    $labelsBast_json = json_encode($labelsBast);
    $valuesBast_json = json_encode($valuesBast);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="dist/temp/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Jquery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <link rel="stylesheet" href="dist/css/public.css" />
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap');

    body {
        background-color: #F4F5F7;
    }

    .summary-card-label {
        font-family: 'Manrope', sans-serif;
        color: #999999;
        font-size: 13px;
        font-weight: 500;
        margin-bottom: 10px;
    }

    .summary-card-count {
        font-family: 'Manrope', sans-serif;
        color: #000;
        font-size: 26px;
        font-weight: 700;
    }

    .summary-chart-label {
        font-family: 'Manrope', sans-serif;
        color: #000;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .summary-chart-desc {
        font-family: 'Manrope', sans-serif;
        color: #999999;
        font-size: 13px;
        font-weight: 500;
    }

    .fs-6 {
        color: #000 !important;
    }
    </style>
</head>

<body class="sb-nav-fixed">
    <div class="preloader">
        <div class="loading">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Start Bootstrap</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link active" href="index.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                            aria-expanded="true" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-columns"></i>
                            </div>
                            Inventaris
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="barang-masuk.php">Daftar Barang Masuk</a>
                                <a class="nav-link" href="barang.php">Daftar Barang</a>
                                <a class="nav-link" href="lisensi.php">Daftar Lisensi</a>
                                <a class="nav-link" href="perbaikan.html">Perbaikan Barang <span
                                        class="badge text-bg-info">WIP</span></a>
                            </nav>
                        </div>
                        <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsBAST"
                            aria-expanded="true" aria-controls="collapseLayoutsBAST">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-columns"></i>
                            </div>
                            Berita Acara
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseLayoutsBAST" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="berita-acara-serah-terima.php">Serah Terima Inventaris</a>
                                <a class="nav-link" href="barang-acara-scrapt.php">Scrapt Inventaris <span
                                        class="badge text-bg-info">WIP</span></a>
                            </nav>
                        </div>
                        <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsMaster"
                            aria-expanded="true" aria-controls="collapseLayoutsMaster">
                            <div class="sb-nav-link-icon">
                                <i class="fa fa-database" aria-hidden="true"></i>
                            </div>
                            Master Data
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseLayoutsMaster" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="user.php">Pengguna</a>
                                <a class="nav-link" href="data-support.php">Data Support <span
                                        class="badge text-bg-info">WIP</span></a>
                            </nav>
                        </div>
                        <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsReport"
                            aria-expanded="true" aria-controls="collapseLayoutsReport">
                            <div class="sb-nav-link-icon">
                                <i class="fa fa-file-text" aria-hidden="true"></i>
                            </div>
                            Reports
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseLayoutsReport" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="#">Daftar Barang</a>
                                <a class="nav-link" href="#">Daftar Lisensi</a>
                                <a class="nav-link" href="#">Daftar BAST (Users) <span
                                        class="badge text-bg-info">WIP</span></a>
                            </nav>
                        </div>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            Profiles <span class="badge text-bg-info">WIP</span>
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?= $nameUser ?>
                    <br>
                    <button type="button" class="btn btn-sm text-white"
                        onclick="return window.location.href='function.php?logout=1'">
                        <i class="fa-solid fa-right-from-bracket"></i> Sign Out
                    </button>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 mb-3">
                    <h3 class="mt-4">Dashboard</h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>

                    <div class="row">
                        <div class="col">
                            <div class="card border-0 bg-transparent">
                                <div class="card-body">
                                    <p class="summary-card-label">
                                        Jumlah Barang
                                    </p>
                                    <h3 class="summary-card-count">
                                        <?= $getCountGoods['total'] ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card border-0 bg-transparent">
                                <div class="card-body">
                                    <p class="summary-card-label">
                                        Jumlah Lisensi
                                    </p>
                                    <h3 class="summary-card-count">
                                        <?= $getCountLisences['total'] ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card border-0 bg-transparent">
                                <div class="card-body">
                                    <p class="summary-card-label">
                                        Jumlah BAST
                                    </p>
                                    <h3 class="summary-card-count">
                                        <?= $getCountBast['total'] ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card border-0 bg-transparent">
                                <div class="card-body">
                                    <p class="summary-card-label">
                                        Jumlah Users
                                    </p>
                                    <h3 class="summary-card-count">
                                        <?= $getCountUsers['total'] ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid px-4">
                    <div class="row">
                        <div class="col-8">
                            <div class="card bg-white border-0 mb-3">
                                <div class="card-body">
                                    <p class="summary-chart-label">Performa Inventaris</p>
                                    <p class="summary-chart-desc">Performa Penambahan Inventaris 6 Bulan Terakhir</p>
                                    <div>
                                        <canvas id="performaBarang" height="50"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="card bg-white border-0">
                                <div class="card-body">
                                    <p class="summary-chart-label">Performa BAST</p>
                                    <p class="summary-chart-desc">Performa Pembuatan BAST 6 Bulan Terakhir</p>
                                    <div>
                                        <canvas id="performaBAST" height="50"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-white border-0 mb-3">
                                <div class="card-body">
                                    <p class="summary-chart-label">Inventaris Terakhir Ditambahkan</p>
                                    <p class="summary-chart-desc">5 Barang Inventaris terakhir ditambahkan</p>
                                    <table class="table table-responsive table-hover">
                                        <?php foreach($getRecentGoods as $good) : ?>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)"
                                                    class="summary-chart-label fs-6 mb-0 mb-0 text-success"
                                                    onclick="window.open('barang-details.php?inv=<?= $good['number'] ?>', '_blank')">
                                                    <?= $good["number"] ?></a>
                                                <p class="summary-chart-desc mb-1"><?= $good["description"] ?></p>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </table>
                                </div>
                            </div>

                            <div class="card border-0">
                                <div class="card-body">
                                    <p class="summary-chart-label">Kondisi Inventaris</p>
                                    <p class="summary-chart-desc">Kondisi Inventaris Secara Keseluruhan</p>
                                    <div>
                                        <canvas id="barangStatus" width="50"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-8">

                        </div>
                    </div>
                </div>
            </main>

            <footer class="py-4 bg-light mt-5">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-center small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="dist/temp/js/scripts.js"></script>
    <script src="dist/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="dist/temp/js/datatables-simple-demo.js"></script>
    <script>
    $(document).ready(function() {
        $(".preloader").fadeOut("slow");
    });

    const canvas1 = document.getElementById('performaBarang');
    const canvas2 = document.getElementById('performaBAST');
    const canvas3 = document.getElementById('barangStatus');

    new Chart(canvas1, {
        type: 'line',
        data: {
            labels: <?= $labelsGoods_json ?>,
            datasets: [{
                label: 'Jumlah Penambahan',
                data: <?= $valuesGoods_json ?>,
                borderWidth: 1,
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    new Chart(canvas2, {
        type: 'line',
        data: {
            labels: <?= $labelsBast_json ?>,
            datasets: [{
                label: 'Jumlah Pembuatan',
                data: <?= $valuesBast_json ?>,
                borderWidth: 1,
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    new Chart(canvas3, {
        type: 'doughnut',
        data: {
            labels: [
                'Baik',
                'Rusak',
                'Diluar Masa Pakai'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100],
                backgroundColor: [
                    'rgb(102, 255, 102)',
                    'rgb(255, 255, 153)',
                    'rgb(255, 102, 102)'
                ],
                hoverOffset: 4
            }]
        }
    });
    </script>
</body>

</html>