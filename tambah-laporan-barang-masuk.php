<?php
    require "koneksi.php";

	//periksa apakah ada cookie user_log
	if(!isset($_COOKIE["_beta_log"])){
		header("Location: login.php");
	}

    $urutBarang = 1;

    $nameUser = $_COOKIE["_name_log"];
    $rrNumber = $_COOKIE["_rr_number_log"];

    // ambil data created_at untuk Memformat kembali timestamp sesuai dengan format yang diinginkan
    $getDetailsRR = mysqli_query($conn, "SELECT id, notes, created_at FROM good_incoming WHERE number = '$rrNumber'");
    $getDetailRR = mysqli_fetch_assoc($getDetailsRR); 
    
    // ambil data incoming detail berdasar id good_incoming
    $idIncoming = $getDetailRR["id"];
    $getDetailGoodIncoming = mysqli_query($conn, "SELECT id, description, sn, pwr, po, type, notes FROM good_incoming_details WHERE id_incoming = $idIncoming")

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Tambah Laporan Barang Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="dist/temp/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="dist/css/public.css" />

    <!-- Jquery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Datatables Jquery -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
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
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Overview
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
                        <div class="collapse show" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="barang.php">Daftar Barang</a>
                                <a class="nav-link" href="lisensi.html">Daftar Lisensi</a>
                                <a class="nav-link active" href="barang-masuk.php">Barang Masuk</a>
                                <a class="nav-link" href="perbaikan.html">Perbaikan Barang</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="user.html">
                            <div class="sb-nav-link-icon">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            Pengguna
                        </a>
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
                                <a class="nav-link" href="berita-acara-serah-terima.html">Serah Terima Inventaris</a>
                                <a class="nav-link" href="barang-acara-scrapt.html">Scrapt Inventaris</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            Profiles
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
                <div class="container-fluid px-4">
                    <h3 class="mt-4">Barang Masuk</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="barang-masuk.php">Barang Masuk</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Laporan Barang Masuk</li>
                        </ol>
                    </nav>

                    <div class="row">
                        <div class="col-sm">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-4">Tambah Laporan Barang Masuk</h5>
                                    <div class="row mb-4">
                                        <div class="col-sm">
                                            <label for="" class="form-label labeling-form">No. RR</label>
                                            <input type="text" class="form-control" placeholder="You Text Here" name=""
                                                id="" value="<?= $rrNumber ?>" required readonly />
                                        </div>
                                        <div class="col-sm">
                                            <label for="" class="form-label labeling-form">Date</label>
                                            <input type="date" class="form-control"
                                                value="<?= date("d/m/Y", strtotime($getDetailRR['created_at'])); ?>"
                                                name="" id="datePicker" required readonly />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <table class="display" name="tableBarang" id="tableBarang">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Deskripsi</th>
                                                        <th>SN</th>
                                                        <th>No. PWR</th>
                                                        <th>No. PO</th>
                                                        <th>Type</th>
                                                        <th>Notes</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($getDetailGoodIncoming as $getDetail) : ?>
                                                    <tr>
                                                        <td><?= $urutBarang ?></td>
                                                        <td><?= $getDetail["description"] ?></td>
                                                        <td><?= $getDetail["sn"] ?></td>
                                                        <td><?= $getDetail["pwr"] ?></td>
                                                        <td><?= $getDetail["po"] ?></td>
                                                        <td>
                                                            <?php if($getDetail["type"] == 1) : ?>
                                                            <i class="fa-solid fa-screwdriver-wrench"></i>
                                                            <?php elseif($getDetail["type"] == 2) : ?>
                                                            <i class="fa-regular fa-newspaper"></i>
                                                            <?php elseif($getDetail["type"] == 3) : ?>
                                                            <i class="fa-solid fa-layer-group"></i>
                                                            <?php endif ?>
                                                        </td>
                                                        <td><?= $getDetail["notes"] ?></td>
                                                        <td>
                                                            <button class="btn btn-sm"
                                                                onclick="hapusDetailBarang(' <?= $getDetail['id'] ?> ')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-trash3"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                </svg>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php $urutBarang++; endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <div class="d-grid gap-2">
                                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modalTambahBarang">Tambah Data Barang</button>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="function.php" method="post">
                                        <div class="row mb-3">
                                            <div class="col-sm">
                                                <label for="notes" class="form-label labeling-form">Additional
                                                    Information</label>
                                                <textarea type="text" class="form-control" placeholder="Your Text Here"
                                                    name="notes" id="notes"><?= $getDetailRR["notes"] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-sm text-end">
                                                <a href="barang-masuk.php" class="btn btn-light">Back</a>
                                                <button type="submit" class="btn btn-primary"
                                                    name="updateNotesBarangMasuk">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-center small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-labelledby="modalTambahBarangLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahBarangLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="function.php" method="post">
                    <div class="modal-body px-4">
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">Deskripsi</label>
                                <input type="text" class="form-control" placeholder="Your text here" name="desc"
                                    id="desc" autofocus required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">Serial Number</label>
                                <input type="text" class="form-control" placeholder="Your text here" name="sn" id="sn"
                                    onchange="validateSN()" required />
                                <span id="snError"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">No. PWR</label>
                                <input type="text" class="form-control" placeholder="Your text here" name="pwr" id="pwr"
                                    required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">No. PO</label>
                                <input type="text" class="form-control" placeholder="Your text here" name="po" id="po"
                                    required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">Tipe Barang Masuk</label>
                                <select name="type" id="type" class="form-select" required>
                                    <option value="">Choose</option>
                                    <option value="1">Goods</option>
                                    <option value="2">Lisence</option>
                                    <option value="3">Consummable</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">Notes</label>
                                <input type="text" class="form-control" placeholder="Your text here" name="notes"
                                    id="notes" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" tabindex="-1" name="tambahBarangMasuk"
                            id="tambahBarangMasuk" disabled>Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="dist/temp/js/scripts.js"></script>
    <script src="dist/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="dist/temp/assets/demo/chart-area-demo.js"></script>
    <script src="dist/temp/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="dist/temp/js/datatables-simple-demo.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.5.0/css/select.bootstrap5.min.css" />
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>

    <script>
    $(document).ready(function() {
        $("#tableBarang").DataTable();
    });

    $(document).ready(function() {
        $(".preloader").fadeOut("slow");
    });

    // Every time a modal is shown, if it has an autofocus element, focus on it.
    $(".modal").on("shown.bs.modal", function() {
        $(this).find("[autofocus]").focus();
    });

    $(document).ready(function() {
        var now = new Date();
        var month = now.getMonth() + 1;
        var day = now.getDate();
        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;
        var today = now.getFullYear() + "-" + month + "-" + day;
        $("#datePicker").val(today);
    });

    $(document).ready(function() {
        $("input[type=text]").keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });
    });
    </script>
</body>

</html>