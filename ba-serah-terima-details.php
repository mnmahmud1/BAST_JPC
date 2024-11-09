<?php
    require "koneksi.php";

	//periksa apakah ada cookie user_log
	if(!isset($_COOKIE["_beta_log"])){
		header("Location: login.php");
	}

    $nameUser = $_COOKIE["_name_log"];
    $idUser = $_COOKIE["_beta_log"];
    $numA = 1;
    $numB = 1;
    $numC = 1;
    $numD = 1;
    $numE = 1;

    $bast_number = $_GET["bast"];
    $queryGetBAST = mysqli_query($conn, "SELECT bast_report.number, users_submitted.name AS submitted_user_name, dept_submitted.name AS submitted_dept_name, users_accepted.name AS accepted_user_name, dept_accepted.name AS accepted_dept_name, users_submitted.nik AS submitted_user_nik, users_accepted.nik AS accepted_user_nik, bast_report.notes FROM bast_report INNER JOIN users AS users_submitted ON users_submitted.id = bast_report.id_user_submitted INNER JOIN users AS users_accepted ON users_accepted.id = bast_report.id_user_accepted INNER JOIN dept AS dept_submitted ON dept_submitted.id = users_submitted.id_dept INNER JOIN dept AS dept_accepted ON dept_accepted.id = users_accepted.id_dept WHERE bast_report.number = '$bast_number'");
    $getBAST = mysqli_fetch_assoc($queryGetBAST);
    if($bast_number == '' OR mysqli_num_rows($queryGetBAST) == 0){
		header("Location: berita-acara-serah-terima.php");
	}

    $getAllGoods = mysqli_query($conn, "SELECT goods.id, goods.number, goods.description, goods.sn, goods.year, branch.name branch_name FROM goods INNER JOIN branch ON branch.initial = goods.id_inv_branch WHERE goods.as_dump = 0 AND goods.as_bast = 0");
    $getGoodsInBAST = mysqli_query($conn, "SELECT goods.number, goods.description, goods.sn, inv_condition.name AS kondisi, goods.year, branch.name AS branch, bast_report_details.attach, bast_report_details.id_good FROM bast_report_details INNER JOIN goods ON goods.id = bast_report_details.id_good INNER JOIN branch ON branch.initial = goods.id_inv_branch INNER JOIN inv_condition ON inv_condition.id = goods.id_inv_condition WHERE bast_report_details.id_inv_type = 1 AND bast_report_details.bast_number = '$bast_number'");
    $getHistoryUsage = mysqli_query($conn, "SELECT tittle, description, attach, created_at FROM bast_usage_history WHERE bast_number = '$bast_number' ORDER BY id DESC");
    $getAllLisences = mysqli_query($conn, "SELECT id, number, sn, description, date_start, date_end, seats, as_bast FROM lisences WHERE as_dump = 0 AND as_bast < seats");
    $getLisencesInBAST = mysqli_query($conn, "SELECT lisences.number, lisences.sn, lisences.description, lisences.date_start, lisences.date_end, lisences.as_bast, lisences.seats, bast_report_details.id FROM bast_report_details INNER JOIN lisences ON lisences.id = bast_report_details.id_good WHERE bast_report_details.id_inv_type = 2 AND bast_report_details.bast_number = '$bast_number'");
    $getBASTSigned = mysqli_fetch_assoc(mysqli_query($conn, "SELECT attach FROM bast_report WHERE number = '$bast_number'"));
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
    <link rel="stylesheet" href="dist/css/public.css" />

    <!-- Jquery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Datatables Jquery -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <style>
    ul.timeline {
        list-style-type: none;
        position: relative;
    }

    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
    }

    ul.timeline>li {
        margin: 20px 0;
        padding-left: 20px;
    }

    ul.timeline>li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #d4d9df;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    }

    .scrollable {
        overflow-y: auto;
        max-height: 400px;
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
                        <a class="nav-link" href="index.php">
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
                        <a class="nav-link" href="user.php">
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
                        <div class="collapse show" id="collapseLayoutsBAST" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link active" href="berita-acara-serah-terima.php">Serah Terima
                                    Inventaris</a>
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
                <div class="container-fluid px-4">
                    <div class="row justify-content-between">
                        <div class="col-auto me-auto">
                            <h3 class="mt-4">Berita Acara Serah Terima Inventaris</h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="berita-acara-serah-terima.php">Serah Terima
                                            Inventaris</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-sm btn-outline-primary mt-4"
                                onclick="window.open('print-bast.php?bast=<?= $bast_number ?>', '_blank')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-printer" viewBox="0 0 16 16">
                                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                                    <path
                                        d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <div class="row mb-3">
                                <div class="col-md">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="mb-4">Deskripsi Berita Acara</h5>
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <label for="" class="form-label labeling-form">No Berita
                                                        Acara</label>
                                                    <input type="text" class="form-control" placeholder="You Text Here"
                                                        name="" id="" value="<?= $getBAST['number'] ?>" readonly
                                                        required />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <label for="" class="form-label labeling-form">Diserahkan
                                                        Oleh</label>
                                                    <select name="" id="" class="form-select" disabled required>
                                                        <option value="" selected>
                                                            <?= $getBAST['submitted_user_name'] ?></option>
                                                    </select>
                                                </div>
                                                <div class="col-sm">
                                                    <label for="" class="form-label labeling-form">Departement</label>
                                                    <input type="text" name="" id="" class="form-control"
                                                        placeholder="<?= $getBAST['submitted_dept_name'] ?>" readonly />
                                                </div>
                                                <div class="col-sm">
                                                    <label for="" class="form-label labeling-form">NIP</label>
                                                    <input type="text" name="" id="" class="form-control"
                                                        placeholder="<?= $getBAST['submitted_user_nik'] ?>" readonly />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <label for="" class="form-label labeling-form">Diterima
                                                        Oleh</label>
                                                    <select name="" id="" class="form-select" disabled required>
                                                        <option value="" selected>
                                                            <?= $getBAST['accepted_user_name'] ?></option>
                                                    </select>
                                                </div>
                                                <div class="col-sm">
                                                    <label for="" class="form-label labeling-form">Departement</label>
                                                    <input type="text" name="" id="" class="form-control"
                                                        placeholder="<?= $getBAST['accepted_dept_name'] ?>" readonly />
                                                </div>
                                                <div class="col-sm">
                                                    <label for="" class="form-label labeling-form">NIP</label>
                                                    <input type="text" name="" id="" class="form-control"
                                                        placeholder="<?= $getBAST['accepted_user_nik'] ?>" readonly />
                                                </div>
                                            </div>
                                            <form action="function.php" method="post">
                                                <div class="row mb-3">
                                                    <div class="col-sm">
                                                        <label for="description"
                                                            class="form-label labeling-form">Keterangan</label>
                                                        <textarea name="description" id="description" cols="30" rows="2"
                                                            class="form-control" placeholder="Your text here"
                                                            required><?= $getBAST['notes'] ?></textarea>
                                                        <input type="text" name="bast" value="<?= $bast_number ?>"
                                                            hidden>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="updateDescBAST"
                                                        class="btn btn-outline-primary" tabindex="-1">Update
                                                        Description</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md">
                                    <div class="card">
                                        <div class="card-body table-responsive">
                                            <h5 class="mb-4">Daftar Barang Inventaris</h5>
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <table class="display" name="tableBarang" id="tableBarang">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>No. Inv</th>
                                                                <th>Deskripsi</th>
                                                                <th>SN</th>
                                                                <th>Kondisi</th>
                                                                <th>Tahun</th>
                                                                <th>Alokasi</th>
                                                                <th>Attach</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach($getGoodsInBAST as $good) : ?>
                                                            <tr>
                                                                <td><?= $numB ?></td>
                                                                <td>
                                                                    <a href="barang-details.php?inv=<?= $good["number"] ?>"
                                                                        target="_blank"
                                                                        class="text-reset"><?= $good["number"] ?></a>
                                                                </td>
                                                                <td><?= $good["description"] ?></td>
                                                                <td><?= $good["sn"] ?></td>
                                                                <td>
                                                                    <h6>
                                                                        <?php if($good["kondisi"] === "BAIK") : ?>
                                                                        <span
                                                                            class="badge bg-success align-middle"><?= $good["kondisi"] ?></span>
                                                                        <?php elseif($good["kondisi"] === "KURANG_BAIK") : ?>
                                                                        <span
                                                                            class="badge bg-warning align-middle"><?= $good["kondisi"] ?></span>
                                                                        <?php elseif($good["kondisi"] === "RUSAK") : ?>
                                                                        <span
                                                                            class="badge bg-danger align-middle"><?= $good["kondisi"] ?></span>
                                                                        <?php elseif($good["kondisi"] === "SCRAPT") : ?>
                                                                        <span
                                                                            class="badge bg-dark align-middle"><?= $good["kondisi"] ?></span>
                                                                        <?php endif ?>
                                                                    </h6>
                                                                </td>
                                                                <td><?= $good["year"] ?></td>
                                                                <td><?= $good["branch"] ?></td>
                                                                <td>
                                                                    <?php if($good["attach"] != null OR $good["attach"] != "") : ?>
                                                                    <button
                                                                        onclick="window.open('dist/attach/<?= $good['attach'] ?>', '_blank')"
                                                                        class="btn btn-sm" target="_blank">
                                                                        <i class="fa-solid fa-eye"></i>
                                                                    </button>
                                                                    <?php endif ?>
                                                                    <button class="btn btn-sm uploadButton"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modalUpload"
                                                                        data-bs-barang="<?= $good["id_good"] ?>"
                                                                        data-bs-number="<?= $good["number"] ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16" fill="currentColor"
                                                                            class="bi bi-cloud-arrow-up"
                                                                            viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd"
                                                                                d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708z" />
                                                                            <path
                                                                                d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383m.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z" />
                                                                        </svg>
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-sm" id="delete-button"
                                                                        onclick="confirmDeletion('function.php?deleteInvBAST=<?= $good['id_good'] ?>&bast=<?= $bast_number ?>&number=<?= $good['number'] ?>&desc=<?= $good['description'] ?>', 'Inventaris')">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16" fill="currentColor"
                                                                            class="bi bi-trash3" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                        </svg>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <?php $numB++; endforeach ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <div class="d-grid gap-2">
                                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#modalTambahBarang">Tambah Data
                                                            Barang</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="row mb-3">
                                                <div class="col-sm">
                                                    <label for="" class="form-label labeling-form">Additional
                                                        Information</label>
                                                    <textarea type="text" class="form-control"
                                                        placeholder="Your Text Here" name="" id=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-sm text-end">
                                                    <a href="berita-acara-serah-terima.php"
                                                        class="btn btn-light">Cancel</a>
                                                    <a href="berita-acara-serah-terima.php"
                                                        class="btn btn-primary">Save</a>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-sm">
                                    <div class="card">
                                        <div class="card-body table-responsive">
                                            <div class="row mb-3">
                                                <h5 class="mb-4">Daftar Lisensi Software Inventaris</h5>
                                                <table class="display" name="tableLisensi" id="tableLisensi">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>No Lisence</th>
                                                            <th>Deskripsi</th>
                                                            <th>
                                                                Serial/ <br />
                                                                Subscribtion ID
                                                            </th>
                                                            <th>
                                                                Start Date/ <br />
                                                                End Date
                                                            </th>
                                                            <th>Seats</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($getLisencesInBAST as $lisence) : ?>
                                                        <tr>
                                                            <td><?= $numE ?></td>
                                                            <td>
                                                                <a href="lisensi-details.php?inv=<?= $lisence["number"] ?>"
                                                                    target="_blank"
                                                                    class="text-reset"><?= $lisence["number"] ?></a>
                                                            </td>
                                                            <td><?= $lisence["description"] ?></td>
                                                            <td><?= $lisence["sn"] ?></td>
                                                            <td><?= date("d/m/Y", strtotime($lisence['date_start'])) ?>
                                                                -
                                                                <?php if($lisence["date_end"] == "0000-00-00 00:00:00") : ?>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-infinity" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M5.68 5.792 7.345 7.75 5.681 9.708a2.75 2.75 0 1 1 0-3.916ZM8 6.978 6.416 5.113l-.014-.015a3.75 3.75 0 1 0 0 5.304l.014-.015L8 8.522l1.584 1.865.014.015a3.75 3.75 0 1 0 0-5.304l-.014.015zm.656.772 1.663-1.958a2.75 2.75 0 1 1 0 3.916z" />
                                                                </svg>
                                                                <?php else : ?>
                                                                <?= date("d/m/Y", strtotime($lisence['date_end'])) ?>
                                                                <?php endif ?>
                                                            </td>
                                                            <td><?= $lisence["as_bast"] ?> of <?= $lisence["seats"] ?>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-sm" id="delete-button"
                                                                    onclick="confirmDeletion('function.php?deleteLicBAST=<?= $lisence['id'] ?>&bast=<?= $bast_number ?>&number=<?= $lisence['number'] ?>&desc=<?= $lisence['description'] ?>', 'Lisensi')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-trash3" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php $numE++; endforeach ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <div class="d-grid gap-2">
                                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#modalTambahLisensi">Tambah Data
                                                            Lisensi</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="row mb-3">
                                                <div class="col-sm">
                                                    <label for="" class="form-label labeling-form">Additional
                                                        Information</label>
                                                    <textarea type="text" class="form-control"
                                                        placeholder="Your Text Here" name="" id=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-sm text-end">
                                                    <a href="berita-acara-serah-terima.php"
                                                        class="btn btn-light">Cancel</a>
                                                    <a href="berita-acara-serah-terima.php"
                                                        class="btn btn-primary">Save</a>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-4">
                                <div class="col">
                                    <label for="bastSigned" class="form-label labeling-form">UPLOAD BAST
                                        SIGNED</label>
                                    <?php if(is_null($getBASTSigned['attach'])) : ?>
                                    <?php else : ?>
                                    <a href="javascript:void(0);"
                                        onclick="window.open('dist/attach/<?= $getBASTSigned['attach'] ?>', '_blank')"
                                        class="text-reset">SEE PDF</a>
                                    <?php endif ?>
                                    <form action="function.php" method="post" enctype="multipart/form-data">
                                        <input type="text" name="bastUrl" value="<?= $bast_number ?>" hidden>
                                        <div class="row">
                                            <div class="col-sm-11">
                                                <input type="file" name="bastSigned" id="bastSigned"
                                                    class="form-control" required />
                                            </div>
                                            <div class="col-sm-1">
                                                <button type="submit" name="uploadSigned"
                                                    class="btn btn-sm btn-primary">Upload</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="col-md">
                            <div class="row mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class=" mb-4">Inventory Usage History</h5>
                                        <div class="scrollable">
                                            <ul class="timeline mb-5">
                                                <?php if(mysqli_num_rows($getHistoryUsage) > 0) : ?>
                                                <?php foreach($getHistoryUsage as $history) :  ?>
                                                <?php if(is_null($history['attach']) OR $history['attach'] == '') : ?>
                                                <li>
                                                    <span class="fw-bold"><?= $history["tittle"] ?></span>
                                                    <p class="fs-6"><?= $history["created_at"] ?></p>
                                                    <p><?= $history["description"] ?>
                                                    </p>
                                                </li>
                                                <?php else : ?>
                                                <li>
                                                    <span class="fw-bold"><?= $history["tittle"] ?></span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-paperclip" viewBox="0 0 16 16">
                                                        <path
                                                            d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0z" />
                                                    </svg>
                                                    <p class="fs-6"><?= $history["created_at"] ?></p>
                                                    <p><?= $history["description"] ?>
                                                    </p>
                                                </li>
                                                <?php endif ?>
                                                <?php endforeach ?>
                                                <?php else : ?>
                                                <li>
                                                    <span class="fw-bold">No Data Available</span>
                                                    <p class="fs-6">Now</p>
                                                    <p>No History Available</p>
                                                </li>
                                                <?php endif ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="card p-3">
                                    <div class="card-body">
                                        <h5 class="mb-4">Commit History</h5>
                                        <div class="col">
                                            <form action="function.php" method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label for="tittle" class="form-label labeling-form">Tittle</label>
                                                    <input type="text" name="tittle" id="tittle" class="form-control"
                                                        placeholder="The keyboard is broken" maxlength="50" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description"
                                                        class="form-label labeling-form">Description</label>
                                                    <textarea type="text" class="form-control"
                                                        placeholder="Add an optional extended description"
                                                        name="description" id="description"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="attach" class="form-label">Attachment</label>
                                                    <input type="file" name="attach" id="attach" class="form-control">
                                                    <input type="text" name="bast" value="<?= $bast_number ?>" hidden>
                                                </div>

                                                <button name="commitHistory" id="commit" class="btn btn-sm btn-success"
                                                    type="submit">Commit Changes</button>
                                            </form>
                                        </div>
                                    </div>
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

    <!-- Modal Tambah Barang -->
    <div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-labelledby="modalTambahBarangLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahBarangLabel">Pilih Barang Inventaris</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body px-4">
                    <div class="row">
                        <div class="col-sm">
                            <div class="card">
                                <div class="card-body table-responsive">
                                    <h5 class="mb-4">Daftar Barang Inventaris</h5>
                                    <table class="display" name="tableTambahDariBarangMasuk"
                                        id="tableTambahDariBarangMasuk">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>No. Inv</th>
                                                <th>Deskripsi</th>
                                                <th>SN</th>
                                                <th>Kondisi</th>
                                                <th>Tahun</th>
                                                <th>Alokasi</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($getAllGoods as $good) : ?>
                                            <tr>
                                                <td><?= $numA ?></td>
                                                <td><?= $good["number"] ?></td>
                                                <td><?= $good["description"] ?></td>
                                                <td><?= $good["sn"] ?></td>
                                                <td>
                                                    <h6>
                                                        <span class="badge bg-success align-middle">BAIK</span>
                                                    </h6>
                                                </td>
                                                <td><?= $good["year"] ?></td>
                                                <td><?= $good["branch_name"] ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-success rounded-pill"
                                                        onclick="window.location.href = 'function.php?addGoodtoBAST=<?= $good['id'] ?>&goodDesc=<?= $good['description'] ?>&goodNumber=<?= $good['number'] ?>&bast=<?= $getBAST['number'] ?>'">Choose</button>
                                                </td>
                                            </tr>
                                            <?php $numA++; endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Lisensi -->
    <div class="modal fade" id="modalTambahLisensi" tabindex="-1" aria-labelledby="modalTambahLisensiLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahLisensiLabel">Pilih Lisensi Dari Daftar Lisensi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <div class="row">
                        <div class="col-sm">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-4">Daftar Lisensi</h5>
                                    <table class="display" name="tableTambahLisensi" id="tableTambahLisensi">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>No Lisence</th>
                                                <th>Deskripsi</th>
                                                <th>
                                                    Serial/ <br />
                                                    Subscribtion ID
                                                </th>
                                                <th>
                                                    Start Date/ <br />
                                                    End Date
                                                </th>
                                                <th>Seats</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($getAllLisences as $lisence): ?>
                                            <tr>
                                                <td><?= $numD ?></td>
                                                <td><?= $lisence["number"] ?></td>
                                                <td><?= $lisence["description"] ?></td>
                                                <td><?= $lisence["sn"] ?></td>
                                                <td><?= date("d/m/Y", strtotime($lisence['date_start'])) ?> -
                                                    <?php if($lisence["date_end"] == "0000-00-00 00:00:00") : ?>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-infinity" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.68 5.792 7.345 7.75 5.681 9.708a2.75 2.75 0 1 1 0-3.916ZM8 6.978 6.416 5.113l-.014-.015a3.75 3.75 0 1 0 0 5.304l.014-.015L8 8.522l1.584 1.865.014.015a3.75 3.75 0 1 0 0-5.304l-.014.015zm.656.772 1.663-1.958a2.75 2.75 0 1 1 0 3.916z" />
                                                    </svg>
                                                    <?php else : ?>
                                                    <?= date("d/m/Y", strtotime($lisence['date_end'])) ?>
                                                    <?php endif ?>
                                                </td>
                                                <td><?= $lisence["as_bast"] ?> of <?= $lisence["seats"] ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-success rounded-pill"
                                                        onclick="window.location.href = 'function.php?addLicencetoBAST=<?= $lisence['id'] ?>&lisenceDesc=<?= $lisence['description'] ?>&lisenceNumber=<?= $lisence['number'] ?>&bast=<?= $getBAST['number'] ?>'">Choose</button>
                                                </td>
                                            </tr>
                                            <?php $numD++; endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Upload Bukti Serah Terima Tambah Barang -->
    <div class="modal fade" id="modalUpload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 me-3" id="exampleModalLabel">Upload Serah Terima - <span
                            id="numberSelected-list"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="function.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-8">
                                    <input type="file" class="form-control" name="importFile" id="importFile"
                                        required />
                                    <input type="text" name="bastUrl" id="bastInput" hidden>
                                </div>
                                <div class="col-4 d-grid gap-3">
                                    <button type="submit" name="UploadAttachInvBAST" class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-file-import"></i>
                                        Upload
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Image Preview
    <div class="modal fade" id="imageModalTambah" tabindex="-1" role="dialog" aria-labelledby="imageModalTambahLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalTambahLabel">Image Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="modalImagePreview" src="#" alt="Image Preview" style="max-width: 100%; max-height: 400px;">
                </div>
            </div>
        </div>
    </div> -->

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
        $("#tableLisensi").DataTable();
        $("#tableTambahLisensi").DataTable();
        $("#tableTambahDariBarangMasuk").DataTable();
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
        $("#description").keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });
    });

    // function showImageModal(imageName) {
    //     var modalImage = document.getElementById('modalImage');
    //     modalImage.src = 'dist/img/history-img/' + imageName;
    //     $('#imageModal').modal('show');
    // }

    document.getElementById('attach').addEventListener('change', function() {
        const file = this.files[0];
        if (file.size > 1048576) { // 1 MB in bytes
            alert('File size exceeds the limit of 1 MB.');
            this.value = ''; // Reset the input file
        }
    });

    function getCookie(name) {
        let cookieArr = document.cookie.split(";");
        for (let i = 0; i < cookieArr.length; i++) {
            let cookiePair = cookieArr[i].split("=");
            if (name == cookiePair[0].trim()) {
                return decodeURIComponent(cookiePair[1]);
            }
        }
        return null;
    }

    // Function untuk memilih tombol attach agar ID barang yang dipilih masuk ke cookiie 
    $(document).ready(function() {
        $('.uploadButton').on('click', function() {
            // Ambil nilai branch dari atribut data-bs-barang
            var goodValue = $(this).attr('data-bs-barang');
            var numberValue = $(this).attr('data-bs-number');

            // Fungsi untuk menambahkan cookie
            function setCookie(name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }

            // Tambahkan cookie dengan nama "branch" dan nilai dari atribut data-bs-barang
            setCookie('goodSelected-list', goodValue, 1); // Cookie berlaku selama 1 hari
            setCookie('numberSelected-list', numberValue, 1); // Cookie berlaku selama 1 hari

            // Mengirimkan number selected list kedalam modal upload serah terima/attach
            // Event handler untuk tombol trigger

            // Reset teks di dalam span
            $("#numberSelected-list").text('');

            // Dapatkan nilai cookie
            let numberSelected = getCookie("numberSelected-list");

            // Jika nilai cookie ditemukan, masukkan ke dalam span
            if (numberSelected) {
                $("#numberSelected-list").text(numberSelected);
            }

        });
    });

    // Mengambil parameter url bast ke dalam form input
    $(document).ready(function() {
        // Fungsi untuk mendapatkan nilai parameter dari URL
        function getParameterByName(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }

        // Ambil nilai parameter bast dari URL
        var bastValue = getParameterByName('bast');

        // Masukkan nilai parameter bast ke dalam input dengan name="bastUrl"
        $('input[name="bastUrl"]').val(bastValue);
    });

    // Delete Confirm dengan sweetAlert
    function confirmDeletion(url, item) {
        Swal.fire({
            title: 'Yakin ingin menghapus ' + item + ' ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#F2404C',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Display success message
                Swal.fire(
                    'Terhapus!',
                    item + ' berhasil dihapus.',
                    'success'
                )
                setTimeout(function() {
                    // Redirect to the URL
                    window.location.href = url;
                }, 800); // Delay for 800 milliseconds

            }
        });
    }
    </script>
</body>

</html>