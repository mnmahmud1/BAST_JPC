<?php
    require "koneksi.php";

	//periksa apakah ada cookie user_log
	if(!isset($_COOKIE["_beta_log"])){
		header("Location: login.php");
	}

    $nameUser = $_COOKIE["_name_log"];
    $idUser = $_COOKIE["_beta_log"];

    $urutDaftar = 1;
    $urutDaftarI = 1;
	$getBranch = mysqli_query($conn, "SELECT id, name FROM branch");
	$getSource = mysqli_query($conn, "SELECT id, name FROM source");
	$getDept = mysqli_query($conn, "SELECT id, name FROM dept");

	$getDaftarLisensi = mysqli_query($conn, "SELECT number, sn, description, seats, date_start, date_end, created_at FROM lisences WHERE as_dump = 0");
	$getLisensiBarangMasuk = mysqli_query($conn, "SELECT good_incoming_details.description, good_incoming_details.sn, good_incoming_details.pwr, good_incoming_details.po, good_incoming.number, good_incoming_details.notes FROM good_incoming_details INNER JOIN good_incoming ON good_incoming_details.id_incoming = good_incoming.id WHERE good_incoming_details.as_dump = 0 AND good_incoming_details.as_inv = 0 and good_incoming_details.type = 2");

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
                                <a class="nav-link active" href="lisensi.php">Daftar Lisensi</a>
                                <a class="nav-link" href="barang-masuk.php">Barang Masuk</a>
                                <a class="nav-link" href="perbaikan.html">Perbaikan Barang</a>
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
                        <div class="collapse" id="collapseLayoutsBAST" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="berita-acara-serah-terima.php">Serah Terima Inventaris</a>
                                <a class="nav-link" href="barang-acara-scrapt.php">Scrapt Inventaris</a>
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
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h3 class="mt-4">Lisensi</h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Lisensi</li>
                    </ol>

                    <div class="row mb-3">
                        <div class="col-sm">
                            <button type="button" class="btn btn-primary" data-bs-toggle="dropdown"
                                aria-expanded="false"><i class="fa-solid fa-plus"></i> Tambah Lisensi</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#modalTambahDariBarangMasuk">Dari Barang Masuk</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#modalTambah">Manual</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <div class="card table-responsive">
                                <div class="card-body">
                                    <h5 class="mb-4">Daftar Lisensi</h5>
                                    <table class="display" name="tableBarang" id="tableBarang">
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
                                                <th>Date</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($getDaftarLisensi as $lisensi) : ?>
                                            <tr>
                                                <td><?= $urutDaftarI ?></td>
                                                <td><?= $lisensi['number'] ?></td>
                                                <td><?= $lisensi['description'] ?></td>
                                                <td><?= $lisensi['sn'] ?></td>
                                                <td><?= date("d/m/Y", strtotime($lisensi['date_start'])) ?> -
                                                    <?php if($lisensi["date_end"] == "0000-00-00 00:00:00") : ?>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-infinity" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.68 5.792 7.345 7.75 5.681 9.708a2.75 2.75 0 1 1 0-3.916ZM8 6.978 6.416 5.113l-.014-.015a3.75 3.75 0 1 0 0 5.304l.014-.015L8 8.522l1.584 1.865.014.015a3.75 3.75 0 1 0 0-5.304l-.014.015zm.656.772 1.663-1.958a2.75 2.75 0 1 1 0 3.916z" />
                                                    </svg>
                                                    <?php else : ?>
                                                    <?= date("d/m/Y", strtotime($lisensi['date_end'])) ?>
                                                    <?php endif ?>
                                                </td>
                                                <td><?= $lisensi['seats'] ?></td>
                                                <td class="fs-6"><?= $lisensi['created_at'] ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-white"
                                                        onclick="window.location.href = 'lisensi-details.php'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-info-circle"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path
                                                                d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php $urutDaftarI++; endforeach ?>

                                        </tbody>
                                    </table>
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
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahLabel">Tambah Lisensi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="function.php" method="post">
                    <div class="modal-body px-4">
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <label for="invM" class="form-label labeling-form">No Lisensi</label>
                                <input type="text" class="form-control" placeholder="You Text Here" name="invM"
                                    id="invM" readonly required />
                            </div>
                            <div class="col-sm-8">
                                <label for="snM" class="form-label labeling-form">Serial/Subscribtion ID</label>
                                <input type="text" class="form-control" placeholder="Your text here" name="snM" id="snM"
                                    autofocus required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-8">
                                <label for="descriptionM" class="form-label labeling-form">Deskripsi Lisensi</label>
                                <input type="text" class="form-control" placeholder="Your text here" name="descriptionM"
                                    id="descriptionM" required />
                            </div>
                            <div class="col-sm-4">
                                <label for="type_lisenceM" class="form-label labeling-form">Type Lisence</label>
                                <select name="type_lisenceM" id="type_lisenceM" class="form-select type_lisence"
                                    required>
                                    <option value="">Choose</option>
                                    <option value="1">PERPETUAL LISENCE</option>
                                    <option value="2">SUBSCRIBTION LISENCE</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="seatsM" class="form-label labeling-form">Seats</label>
                                <input type="number" class="form-control" placeholder="Your text here" name="seatsM"
                                    id="seatsM" required />
                            </div>
                            <div class="col-sm">
                                <label for="date_startM" class="form-label labeling-form">Date Start</label>
                                <input type="date" class="form-control" placeholder="Your text here" name="date_startM"
                                    id="date_startM" required />
                            </div>
                            <div class="col-sm">
                                <label for="date_endM" class="form-label labeling-form">Date End <span
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Jika Perpetual Lisence maka form ini dibiarkan kosong">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                                        </svg>
                                    </span></label>
                                <input type="date" class="form-control date_end" placeholder="Your text here"
                                    name="date_endM" id="date_endM" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="deptM" class="form-label labeling-form">Departemen</label>
                                <select name="deptM" id="deptM" class="form-select">
                                    <option value="">Choose</option>
                                    <?php foreach($getDept as $dept) : ?>
                                    <option value="<?= $dept['id'] ?>"><?= $dept['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-sm">
                                <label for="branchM" class="form-label labeling-form">Lokasi</label>
                                <select name="branchM" id="branchM" class="form-select" required>
                                    <option value="">Choose</option>
                                    <?php foreach($getBranch as $branch) : ?>
                                    <option value="<?= $branch['id'] ?>"><?= $branch['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-sm">
                                <label for="sourceM" class="form-label labeling-form">Asal Usul</label>
                                <select name="sourceM" id="sourceM" class="form-select" required
                                    onchange="updateTextarea()">
                                    <option value="">Choose</option>
                                    <option value="1">PWR</option>
                                    <option value="2">HIBAH</option>
                                    <option value="3">LAIN-LAIN</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="notesM" class="form-label labeling-form">Keterangan</label>
                                <textarea name="notesM" id="notesM" cols="30" rows="2" class="form-control"
                                    placeholder="Your text here" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal"
                            tabindex="-1">Cancel</button>
                        <button type="submit" name="tambahLisensiManual" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Lisensi dari barang masuk -->
    <div class="modal fade" id="modalTambahDariBarangMasuk" tabindex="-1"
        aria-labelledby="modalTambahDariBarangMasukLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahDariBarangMasukLabel">Pilih Lisensi Dari Barang Masuk
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body px-4">
                    <div class="row">
                        <div class="col-sm">
                            <div class="card table-responsive">
                                <div class="card-body">
                                    <h5 class="mb-4">Daftar Barang Masuk</h5>
                                    <table class="display" name="tableTambahDariBarangMasuk"
                                        id="tableTambahDariBarangMasuk">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Deskripsi</th>
                                                <th>
                                                    Serial/ <br />
                                                    Subscribtion
                                                </th>
                                                <th>No. PWR</th>
                                                <th>No. PO</th>
                                                <th>No. RR IT</th>
                                                <th>Notes</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($getLisensiBarangMasuk as $lisensi) : ?>
                                            <tr>
                                                <td><?= $urutDaftar ?></td>
                                                <td><?= $lisensi["description"] ?></td>
                                                <td><?= $lisensi["sn"] ?></td>
                                                <td><?= $lisensi["pwr"] ?></td>
                                                <td><?= $lisensi["po"] ?></td>
                                                <td><?= $lisensi["number"] ?></td>
                                                <td><?= $lisensi["notes"] ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-success send-modal"
                                                        data-bs-toggle="modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-check-circle-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                        </svg></button>
                                                </td>
                                            </tr>
                                            <?php $urutDaftar++; endforeach ?>
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

    <!-- Modal Mutasi Data dari Barang Masuk -->
    <div class="modal fade" id="modalUpdateMutasiLisensi" tabindex="-1" aria-labelledby="modalUpdateMutasiLisensiLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalUpdateMutasiLisensiLabel">Tambah Lisensi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="function.php" method="post">
                    <div class="modal-body px-4">
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <label for="inv" class="form-label labeling-form">No Lisensi</label>
                                <input type="text" class="form-control" placeholder="You Text Here" name="inv" id="inv"
                                    readonly required />
                            </div>
                            <div class="col-sm-8">
                                <label for="sn" class="form-label labeling-form">Serial/Subscribtion ID</label>
                                <input type="text" class="form-control" placeholder="Your text here" value="" name="sn"
                                    id="sn" required readonly />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-8">
                                <label for="description" class="form-label labeling-form">Deskripsi Lisensi</label>
                                <input type="text" class="form-control" placeholder="Your text here" value=""
                                    name="description" id="description" required readonly />
                            </div>
                            <div class="col-sm-4">
                                <label for="type_lisence" class="form-label labeling-form">Type
                                    Lisence</label>
                                <select name="type_lisence" id="type_lisence" class="form-select type_lisence" autofocus
                                    required>
                                    <option value="">Choose</option>
                                    <option value="1">PERPETUAL LISENCE</option>
                                    <option value="2">SUBSCRIBTION LISENCE</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="seats" class="form-label labeling-form">Seats</label>
                                <input type="number" class="form-control" placeholder="Your text here" name="seats"
                                    id="seats" required />
                            </div>
                            <div class="col-sm">
                                <label for="date_start" class="form-label labeling-form">Date Start</label>
                                <input type="date" class="form-control" placeholder="Your text here" name="date_start"
                                    id="date_start" required />
                            </div>
                            <div class="col-sm">
                                <label for="date_end" class="form-label labeling-form">Date End <span
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Jika Perpetual Lisence maka form ini dibiarkan kosong">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                                        </svg>
                                    </span></label>
                                <input type="date" class="form-control date_end" placeholder="Your text here"
                                    name="date_end" id="date_end" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="dept" class="form-label labeling-form">Departemen</label>
                                <select name="dept" id="dept" class="form-select">
                                    <option value="">Choose</option>
                                    <?php foreach($getDept as $dept) : ?>
                                    <option value="<?= $dept['id'] ?>"><?= $dept['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-sm">
                                <label for="branch" class="form-label labeling-form">Lokasi</label>
                                <select name="branch" id="branch" class="form-select" required>
                                    <option value="">Choose</option>
                                    <?php foreach($getBranch as $branch) : ?>
                                    <option value="<?= $branch['id'] ?>"><?= $branch['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-sm">
                                <label for="source" class="form-label labeling-form">Asal Usul</label>
                                <select name="source" id="source" class="form-select" required aria-readonly="">
                                    <option value="1" selected>PWR</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="notes" class="form-label labeling-form">Keterangan</label>
                                <textarea name="notes" id="notes" cols="30" rows="2" class="form-control"
                                    placeholder="Your text here" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal"
                            tabindex="-1">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="mutasiBarangMasukKeLisensi"
                            name="mutasiBarangMasukKeLisensi">Tambah</button>
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
        $("#tableBarang").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print"],
            select: true,
        });
        $("#tableTambahDariBarangMasuk").DataTable();
    });

    $(document).ready(function() {
        $(".preloader").fadeOut("slow");
    });

    // Every time a modal is shown, if it has an autofocus element, focus on it.
    $(".modal").on("shown.bs.modal", function() {
        $(this).find("[autofocus]").focus();
    });

    // buat form input validation agar uppercase
    $(document).ready(function() {
        $("input[type=text], textarea").on("input", function() {
            // Simpan posisi kursor
            var caretPos = this.selectionStart;

            // Ubah nilai menjadi huruf kapital
            $(this).val($(this).val().toUpperCase());

            // Kembalikan posisi kursor
            this.setSelectionRange(caretPos, caretPos);
        });
    });

    // tombol untuk kirim baris ke modal html
    $(document).ready(function() {
        $('.send-modal').click(function() {
            let row = $(this).closest('tr');
            let data1 = row.find('td:eq(0)').text(); //no
            let data2 = row.find('td:eq(1)').text(); //desc
            let data3 = row.find('td:eq(2)').text(); //sn
            let data4 = row.find('td:eq(3)').text(); //pwr
            let data5 = row.find('td:eq(4)').text(); //po
            let data6 = row.find('td:eq(5)').text(); //rr
            let data7 = row.find('td:eq(6)').text(); //notes
            // ...

            $('#description').val(data2);
            $('#sn').val(data3);
            $('#notes').val(`REFF PWR ${data4}; REFF PO ${data5}; RR IT ${data6}; ${data7}`);

            $('#modalUpdateMutasiLisensi').modal('show');
        });
    });

    // fungsi penomoran inventaris lisensi langsung
    $(document).ready(function() {
        // Dapatkan tanggal saat ini
        var currentDate = new Date();

        // Dapatkan tahun dari tanggal saat ini
        var year = currentDate.getFullYear();

        // Dapatkan bulan dari tanggal saat ini (tambah 1 karena bulan dimulai dari 0)
        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');

        // Bangun nomor invoice tanpa urutan terlebih dahulu
        var invWithoutOrder = 'IT/LIC/' + year + '/' + month + '/';

        // Lakukan AJAX request ke server untuk memeriksa urutan terakhir di database
        $.ajax({
            url: 'automatic-add-no-inv-lic.php',
            method: 'POST',
            data: {
                invWithoutOrder: invWithoutOrder
            },
            success: function(response) {
                // Tanggapan dari server berisi urutan terakhir dari database
                var lastOrder = parseInt(response);

                // Tambahkan 1 ke urutan terakhir
                var newOrder = (lastOrder).toString().padStart(2, '0');

                // Bangun nomor invoice lengkap
                var invoiceNumber = invWithoutOrder + newOrder;

                // Set nilai nomor invoice ke input dengan id #inv
                $('#inv, #invM').val(invoiceNumber);
            },
            error: function() {
                // Penanganan kesalahan jika terjadi
                console.error('Error checking database for order number.');
            }
        });
    });

    $(document).ready(function() {
        // Tambahkan event listener pada perubahan nilai select
        $('.type_lisence').on('change', function() {
            // Ambil nilai terpilih
            var selectedValue = $(this).val();

            // Cek apakah "PERPETUAL LISENCE" terpilih
            if (selectedValue === '1') {
                // Nonaktifkan input date
                $('.date_end').prop('disabled', true);
            } else {
                // Aktifkan kembali input date
                $('.date_end').prop('disabled', false);
            }
        });
    });

    // enable tooltip 
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    function updateTextarea() {
        var selectElement = document.getElementById("sourceM");
        var textareaElement = document.getElementById("notesM");

        // Mendapatkan nilai yang dipilih
        var selectedValue = selectElement.value;

        // Periksa nilai yang dipilih
        if (selectedValue === "1") {
            // Jika PWR dipilih, tambahkan teks ke textarea
            textareaElement.value = "REFF PWR ; REFF PO ;";
        } else {
            // Jika pilihan selain PWR dipilih, tidak menghapus teks yang telah dimasukkan manual
            // Hanya menambahkan teks berdasarkan pilihan
            textareaElement.value += "REFF " + selectElement.options[selectElement.selectedIndex].text + "; ";
        }
    }
    </script>
</body>

</html>