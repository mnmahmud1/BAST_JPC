<?php
    require "koneksi.php";

	//periksa apakah ada cookie user_log
	if(!isset($_COOKIE["_beta_log"])){
		header("Location: login.php");
	}

    $nameUser = $_COOKIE["_name_log"];
    $idUser = $_COOKIE["_beta_log"];

    $bast_number = $_GET["bast"];
    $queryGetBAST = mysqli_query($conn, "SELECT id FROM bast_report WHERE number = '$bast_number'");
    if($bast_number == '' OR mysqli_num_rows($queryGetBAST) == 0){
		header("Location: berita-acara-serah-terima.php");
	}
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
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="barang.php">Daftar Barang</a>
                                <a class="nav-link" href="lisensi.php">Daftar Lisensi</a>
                                <a class="nav-link" href="barang-masuk.php">Barang Masuk</a>
                                <a class="nav-link" href="perbaikan.php">Perbaikan Barang</a>
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
                    <h3 class="mt-4">Berita Acara Serah Terima Inventaris</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="berita-acara-serah-terima.php">Serah Terima
                                    Inventaris</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Details</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row mb-3">
                                <div class="col-sm">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="mb-4">Deskripsi Berita Acara</h5>
                                            <form action="" method="post">
                                                <div class="row mb-3">
                                                    <div class="col-sm">
                                                        <label for="" class="form-label labeling-form">No Berita
                                                            Acara</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="You Text Here" name="" id="" readonly
                                                            required />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm">
                                                        <label for="" class="form-label labeling-form">Diserahkan
                                                            Oleh</label>
                                                        <select name="" id="" class="form-select" disabled required>
                                                            <option value="">Choose</option>
                                                            <option value="">M Nurhasan Mahmudi</option>
                                                            <option value="">Ali Rakhman</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm">
                                                        <label for=""
                                                            class="form-label labeling-form">Departement</label>
                                                        <input type="text" name="" id="" class="form-control"
                                                            placeholder="HR & GA / IT" readonly />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm">
                                                        <label for="" class="form-label labeling-form">Diterima
                                                            Oleh</label>
                                                        <select name="" id="" class="form-select" disabled required>
                                                            <option value="">Choose</option>
                                                            <option value="">M Nurhasan Mahmudi</option>
                                                            <option value="">Ali Rakhman</option>
                                                            <option value="">Kevin Alniagara</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm">
                                                        <label for=""
                                                            class="form-label labeling-form">Departement</label>
                                                        <input type="text" name="" id="" class="form-control"
                                                            placeholder="Finance Accounting" readonly />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm">
                                                        <label for=""
                                                            class="form-label labeling-form">Keterangan</label>
                                                        <textarea name="" id="" cols="30" rows="2" class="form-control"
                                                            placeholder="Your text here" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary" tabindex="-1">Update
                                                        Data</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
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
                                                                <th>Date</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>MHN-2023-001</td>
                                                                <td>ASUS Vivobook M310A</td>
                                                                <td>123NDIAPP10042</td>
                                                                <td>
                                                                    <h6>
                                                                        <span
                                                                            class="badge bg-success align-middle">BAIK</span>
                                                                    </h6>
                                                                </td>
                                                                <td>2022</td>
                                                                <td>Gunung Putri</td>
                                                                <td>
                                                                    <button class="btn btn-sm" data-bs-toggle="modal"
                                                                        data-bs-target="#modalUpload">
                                                                        <i class="fa-solid fa-paperclip"></i>
                                                                    </button>
                                                                </td>
                                                                <td class="fs-6">10.40 PM 11-11-2022</td>
                                                                <td>
                                                                    <button class="btn btn-sm"
                                                                        onclick="confirm('Yakin ingin menghapus data ini?')">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16" fill="currentColor"
                                                                            class="bi bi-trash3" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                        </svg>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>IT/REG/2023/04/01</td>
                                                                <td>Converter USB HDMI</td>
                                                                <td>HDZNO1241244</td>
                                                                <td>
                                                                    <h6>
                                                                        <span
                                                                            class="badge bg-success align-middle">BAIK</span>
                                                                    </h6>
                                                                </td>
                                                                <td>2022</td>
                                                                <td>Gunung Putri</td>
                                                                <td>
                                                                    <button class="btn btn-sm" data-bs-toggle="modal"
                                                                        data-bs-target="#modalUpload">
                                                                        <i class="fa-solid fa-paperclip"></i>
                                                                    </button>
                                                                </td>
                                                                <td class="fs-6">10.40 PM 11-11-2022</td>
                                                                <td>
                                                                    <button class="btn btn-sm"
                                                                        onclick="confirm('Yakin ingin menghapus data ini?')">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16" fill="currentColor"
                                                                            class="bi bi-trash3" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                        </svg>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <div class="d-grid gap-2">
                                                        <button class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalTambahBarang">Tambah Data
                                                            Barang</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
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
                                            </div>
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
                                                            <th>Date</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>IT-LIC-2023-05-15</td>
                                                            <td>AEC Collection</td>
                                                            <td>123-ASD23121</td>
                                                            <td>12/06/2022 -11/06/2023</td>
                                                            <td>5</td>
                                                            <td class="fs-6">10.40 PM 11-11-2022</td>
                                                            <td>
                                                                <button class="btn btn-sm"
                                                                    onclick="confirm('Yakin ingin menghapus data ini?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-trash3" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>IT-LIC-2023-05-15</td>
                                                            <td>AEC Collection</td>
                                                            <td>123-ASD23121</td>
                                                            <td>12/06/2022 -11/06/2023</td>
                                                            <td>5</td>
                                                            <td class="fs-6">10.40 PM 11-11-2022</td>
                                                            <td>
                                                                <button class="btn btn-sm"
                                                                    onclick="confirm('Yakin ingin menghapus data ini?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-trash3" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <div class="d-grid gap-2">
                                                        <button class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalTambahLisensi">Tambah Data
                                                            Lisensi</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-4">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="col">
                                        <label for="bast-signed" class="form-label labeling-form">UPLOAD BAST
                                            SIGNED</label>
                                        <a href="#"
                                            class="text-decoration-none labeling-form text-decoration-underline">SEE
                                            PDF</a>
                                        <input type="file" name="bast-signed" id="bast-signed" class="form-control"
                                            required />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="row mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class=" mb-4">Inventory Usage History</h5>
                                        <div class="scrollable">
                                            <ul class="timeline mb-5">
                                                <li>
                                                    <span class="fw-bold">New Web Design</span>
                                                    <p class="fs-6">21 March, 2014</p>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque
                                                        scelerisque diam non nisi semper, et elementum lorem ornare.
                                                        Maecenas
                                                        placerat facilisis mollis. Duis sagittis ligula in sodales
                                                        vehicula....
                                                    </p>
                                                </li>
                                                <li>
                                                    <span class="fw-bold">21 000 Job Seekers</span>
                                                    <p class="fs-6">4 March, 2014</p>
                                                    <p>Curabitur purus sem, malesuada eu luctus eget, suscipit sed
                                                        turpis.
                                                        Nam
                                                        pellentesque felis vitae justo accumsan, sed semper nisi
                                                        sollicitudin...
                                                    </p>
                                                </li>
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
                                            <form action="POST">
                                                <div class="mb-3">
                                                    <label for="tittle" class="form-label labeling-form">Tittle</label>
                                                    <input type="text" name="title" id="tittle" class="form-control"
                                                        placeholder="The keyboard is broken" required>
                                                </div>
                                                <div class=" mb-3">
                                                    <label for="description"
                                                        class="form-label labeling-form">Description</label>
                                                    <textarea type="text" class="form-control"
                                                        placeholder="Add an optional extended description"
                                                        name="description" id="description"></textarea>
                                                </div>
                                                <button name="commit" id="commit" class="btn btn-sm btn-success"
                                                    type="submit">Commit</button>
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
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahBarangLabel">Pilih Barang Inventaris</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body px-4">
                    <div class="row">
                        <div class="col-sm">
                            <div class="card">
                                <div class="card-body">
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
                                            <tr>
                                                <td>1</td>
                                                <td>MHN-2023-001</td>
                                                <td>ASUS Vivobook M310A</td>
                                                <td>123NDIAPP10042</td>
                                                <td>
                                                    <h6>
                                                        <span class="badge bg-success align-middle">BAIK</span>
                                                    </h6>
                                                </td>
                                                <td>2022</td>
                                                <td>Gunung Putri</td>
                                                <td>
                                                    <button class="btn btn-sm btn-success rounded-pill"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalUpdateMutasiBarang">Choose</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>MHN-2023-001</td>
                                                <td>ASUS Vivobook M310A</td>
                                                <td>123NDIAPP10042</td>
                                                <td>
                                                    <h6>
                                                        <span class="badge bg-success align-middle">BAIK</span>
                                                    </h6>
                                                </td>
                                                <td>2022</td>
                                                <td>Gunung Putri</td>
                                                <td>
                                                    <button class="btn btn-sm btn-success rounded-pill"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalUpdateMutasiBarang">Choose</button>
                                                </td>
                                            </tr>
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
                                            <tr>
                                                <td>1</td>
                                                <td>IT-LIC-2023-05-15</td>
                                                <td>AEC Collection</td>
                                                <td>123-ASD23121</td>
                                                <td>12/06/2022 -11/06/2023</td>
                                                <td>5</td>
                                                <td>
                                                    <button class="btn btn-sm btn-success rounded-pill"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalUpdateMutasiBarang">Choose</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>IT-LIC-2023-05-15</td>
                                                <td>AEC Collection</td>
                                                <td>123-ASD23121</td>
                                                <td>12/06/2022 -11/06/2023</td>
                                                <td>5</td>
                                                <td>
                                                    <button class="btn btn-sm btn-success rounded-pill"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalUpdateMutasiBarang">Choose</button>
                                                </td>
                                            </tr>
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
                    <h1 class="modal-title fs-5 me-3" id="exampleModalLabel">Upload Serah Terima</h1>
                    <a href="dist/source-pdf/source-1.pdf"
                        class="text-decoration-none labeling-form text-decoration-underline" target="_blank">
                        <i class="fa-solid fa-eye"></i>
                        See Attachment
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-8">
                                    <input type="file" class="form-control" name="importFile" id="importFile"
                                        required />
                                </div>
                                <div class="col-4 d-grid gap-3">
                                    <button type="submit" class="btn btn-sm btn-primary">
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
        $("input[type=text]").keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });
    });
    </script>
</body>

</html>