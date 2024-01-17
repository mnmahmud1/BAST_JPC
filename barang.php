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
	$getDaftarBarangMasuk = mysqli_query($conn, "SELECT good_incoming.number, good_incoming_details.description, good_incoming_details.sn, good_incoming_details.pwr, good_incoming_details.po, good_incoming_details.notes FROM good_incoming_details INNER JOIN good_incoming ON good_incoming_details.id_incoming = good_incoming.id WHERE good_incoming_details.as_dump = 0 AND good_incoming_details.type = 1 AND good_incoming_details.as_inv = 0");

	$getInvGroup = mysqli_query($conn, "SELECT id, name FROM inv_group");
	$getBranch = mysqli_query($conn, "SELECT id, name FROM branch");
	$getSource = mysqli_query($conn, "SELECT id, name FROM source");
	$getDept = mysqli_query($conn, "SELECT id, name FROM dept");

    $getDaftarBarangInv = mysqli_query($conn, "SELECT goods.number, goods.description, goods.sn, inv_condition.name AS kondisi, goods.year, branch.name AS branch, goods.img FROM goods INNER JOIN inv_condition ON goods.id_inv_condition = inv_condition.id INNER JOIN branch ON goods.id_inv_branch = branch.id");

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

    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/vi2wp2m2ujq5iv8tc0kaxpph3s7c7wnhhcdiiu3dcx8ybhwj/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

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
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
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
                        <a class="nav-link" href="index.html">
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
                                <a class="nav-link active" href="barang.html">Daftar Barang</a>
                                <a class="nav-link" href="lisensi.html">Daftar Lisensi</a>
                                <a class="nav-link" href="barang-masuk.php">Barang Masuk</a>
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
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h3 class="mt-4">Barang</h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Barang</li>
                    </ol>

                    <div class="row mb-3">
                        <div class="col-sm">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <button class="btn btn-sm btn-light" data-bs-toggle="modal"
                                    data-bs-target="#modalImport">
                                    <i class="fa-solid fa-file-import"></i>
                                    Import
                                </button>

                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-plus"></i>
                                        Tambah Barang</button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#modalTambahDariBarangMasuk">Dari Barang Masuk</a></li>
                                        <li><a class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#modalTambah">Manual</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-4">Daftar Barang</h5>
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
                                                <th>Img</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($getDaftarBarangInv as $barangInv) : ?>
                                            <tr>
                                                <td><?= $urutDaftarI ?></td>
                                                <td><?= $barangInv["number"] ?></td>
                                                <td><?= $barangInv["description"] ?></td>
                                                <td><?= $barangInv["sn"] ?></td>
                                                <td>
                                                    <h6>
                                                        <?php if($barangInv["kondisi"] === "BAIK") : ?>
                                                        <span
                                                            class="badge bg-success align-middle"><?= $barangInv["kondisi"] ?></span>
                                                        <?php elseif($barangInv["kondisi"] === "KURANG_BAIK") : ?>
                                                        <span
                                                            class="badge bg-warning align-middle"><?= $barangInv["kondisi"] ?></span>
                                                        <?php elseif($barangInv["kondisi"] === "RUSAK") : ?>
                                                        <span
                                                            class="badge bg-danger align-middle"><?= $barangInv["kondisi"] ?></span>
                                                        <?php elseif($barangInv["kondisi"] === "SCRAPT") : ?>
                                                        <span
                                                            class="badge bg-dark align-middle"><?= $barangInv["kondisi"] ?></span>
                                                        <?php endif ?>
                                                    </h6>
                                                </td>
                                                <td><?= $barangInv["year"] ?></td>
                                                <td><?= $barangInv["branch"] ?></td>
                                                <td>
                                                    <button class="btn btn-sm"
                                                        onclick="showImageModal('<?= $barangInv['img'] ?>')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-eye-fill"
                                                            viewBox="0 0 16 16">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                            <path
                                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                                        </svg>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-white"
                                                        onclick="window.location.href = 'barang-details.html'">
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

    <!-- Modal Import -->
    <div class="modal fade" id="modalImport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Import Data Barang</h1>
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
                                    <div class="btn-group" role="group">
                                        <a href="#" class="btn btn-sm btn-white" download><i
                                                class="fa-solid fa-download"></i></a>
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-file-import"></i>
                                            Import
                                        </button>
                                    </div>
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

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahLabel">Tambah Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="function.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body px-4">
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="invM" class="form-label labeling-form">No Inventaris</label>
                                <input type="text" class="form-control" placeholder="You Text Here" name="invM"
                                    id="invM" required readonly />
                            </div>
                            <div class="col-sm">
                                <label for="snM" class="form-label labeling-form">Serial Number</label>
                                <input type="text" class="form-control" placeholder="Your text here" name="snM" id="snM"
                                    onchange="validateSNManual()" autofocus required />
                                <span id="snError"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="descriptionM" class="form-label labeling-form">Deskripsi</label>
                                <input type="text" class="form-control" placeholder="Your text here" name="descriptionM"
                                    id="descriptionM" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="spekM" class="form-label labeling-form">Spesifikasi</label>
                                <textarea name="spekM" id="spekM" cols="30" rows="2" class="form-control"
                                    placeholder="Your text here"
                                    required>PROSESOR : <br> MEMORI :<br> HARD DRIVE :</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="type_invM" class="form-label labeling-form">Tipe Inventaris</label>
                                <select name="type_invM" id="type_invM" class="form-select" required>
                                    <option value="">Choose</option>
                                    <option value="1">HAK MILIK PERUSAHAAN</option>
                                    <option value="2">SEWAAN</option>
                                </select>
                            </div>
                            <div class="col-sm">
                                <label for="group_invM" class="form-label labeling-form">Grup Inventaris</label>
                                <select name="group_invM" id="group_invM" class="form-select">
                                    <option value="">Choose</option>
                                    <?php foreach($getInvGroup as $invGroup) : ?>
                                    <option value="<?= $invGroup['id'] ?>"><?= $invGroup['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-sm">
                                <label for="allotment_invM" class="form-label labeling-form">Peruntukan
                                    Inventaris</label>
                                <select name="allotment_invM" id="allotment_invM" class="form-select" required>
                                    <option value="">Choose</option>
                                    <option value="1">INFRASTRUKTUR</option>
                                    <option value="2">INVENTARIS USER</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
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
                            <div class="col-sm">
                                <label for="deptM" class="form-label labeling-form">Departemen</label>
                                <select name="deptM" id="deptM" class="form-select">
                                    <option value="">Choose</option>
                                    <?php foreach($getDept as $dept) : ?>
                                    <option value="<?= $dept['id'] ?>"><?= $dept['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="yearM" class="form-label labeling-form">Tahun Pengadaan</label>
                                <select name="yearM" id="yearM" class="form-select years">
                                    <option value="">Choose</option>
                                </select>
                            </div>
                            <div class="col-sm">
                                <label for="useful_invM" class="form-label labeling-form">Masa Manfaat (Tahun)</label>
                                <input type="number" class="form-control" placeholder="Your text here"
                                    name="useful_invM" id="useful_invM" required />
                            </div>
                            <div class="col-sm">
                                <label for="condition_invM" class="form-label labeling-form">Kondisi</label>
                                <select name="condition_invM" id="condition_invM" class="form-select" required>
                                    <option value="">Choose</option>
                                    <option value="1">BAIK</option>
                                    <option value="2">KURANG BAIK</option>
                                    <option value="3">RUSAK</option>
                                    <option value="4">SCRAPT</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="notesM" class="form-label labeling-form">Keterangan</label>
                                <textarea name="notesM" id="notesM" cols="30" rows="2" class="form-control"
                                    placeholder="Your text here" required></textarea>
                            </div>
                            <div class="col-sm">
                                <label for="imageM" class="form-label labeling-form">Upload Image</label>
                                <input type="file" class="form-control" name="imageM" id="imageM" accept="image/*"
                                    onchange="compressAndPreviewImage()" required />
                            </div>
                            <div class="col-sm">
                                <p id="imageInfo"></p>
                                <img id="imagePreview" src="#" alt="Image Preview"
                                    style="max-width: 100%; max-height: 50px; margin-top: 10px; display: none;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="tambahBarangInvManual"
                            id="tambahBarangInvManual" tabindex="-1">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Barang dari barang masuk -->
    <div class="modal fade" id="modalTambahDariBarangMasuk" tabindex="-1"
        aria-labelledby="modalTambahDariBarangMasukLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahDariBarangMasukLabel">Pilih Barang Dari Barang Masuk
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body px-4">
                    <div class="row">
                        <div class="col-sm">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-4">Daftar Barang Masuk</h5>
                                    <table class="display table-responsive" name="tableTambahDariBarangMasuk"
                                        id="tableTambahDariBarangMasuk">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Deskripsi</th>
                                                <th>SN</th>
                                                <th>No. PWR</th>
                                                <th>No. PO</th>
                                                <th>No. RR IT</th>
                                                <th>Notes</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($getDaftarBarangMasuk as $barangMasuk) : ?>
                                            <tr>
                                                <td><?= $urutDaftar ?></td>
                                                <td><?= $barangMasuk["description"] ?></td>
                                                <td><?= $barangMasuk["sn"] ?></td>
                                                <td><?= $barangMasuk["pwr"] ?></td>
                                                <td><?= $barangMasuk["po"] ?></td>
                                                <td><?= $barangMasuk["number"] ?></td>
                                                <td><?= $barangMasuk["notes"] ?></td>
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

    <!-- Modal Update dan Mutasi Barang dari barang masuks -->
    <div class="modal fade" id="modalUpdateMutasiBarang" tabindex="-1" aria-labelledby="modalUpdateMutasiBarangLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalUpdateMutasiBarangLabel">Tambah Barang Dari Barang Masuk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="function.php" method="post">
                    <div class="modal-body px-4">
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="inv" class="form-label labeling-form">No Inventaris</label>
                                <input type="text" class="form-control" placeholder="You Text Here" name="inv" id="inv"
                                    required readonly />
                            </div>
                            <div class="col-sm">
                                <label for="sn" class="form-label labeling-form">Serial Number</label>
                                <input type="text" class="form-control" placeholder="Your text here" name="sn" id="sn"
                                    value="" required readonly />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="description" class="form-label labeling-form">Deskripsi</label>
                                <input type="text" class="form-control" placeholder="Your text here" name="description"
                                    id="description" value="" required readonly />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="spek" class="form-label labeling-form">Spesifikasi</label>
                                <textarea name="spek" id="spek" cols="30" rows="2" class="form-control"
                                    placeholder="Your text here" required
                                    autofocus> PROSESOR : <br> MEMORI :<br> HARD DRIVE :</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="type_inv" class="form-label labeling-form">Tipe Barang Inventaris</label>
                                <select name="type_inv" id="type_inv" class="form-select" required>
                                    <option value="">Choose</option>
                                    <option value="1">HAK MILIK PERUSAHAAN</option>
                                    <option value="2">SEWAAN</option>
                                </select>
                            </div>
                            <div class="col-sm">
                                <label for="group_inv" class="form-label labeling-form">Grup Inventaris</label>
                                <select name="group_inv" id="group_inv" class="form-select">
                                    <option value="">Choose</option>
                                    <?php foreach($getInvGroup as $invGroup) : ?>
                                    <option value="<?= $invGroup['id'] ?>"><?= $invGroup['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-sm">
                                <label for="allotment_inv" class="form-label labeling-form">Peruntukan
                                    Inventaris</label>
                                <select name="allotment_inv" id="allotment_inv" class="form-select" required>
                                    <option value="">Choose</option>
                                    <option value="1">INFRASTRUKTUR</option>
                                    <option value="2">INVENTARIS USER</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
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
                            <div class="col-sm">
                                <label for="dept" class="form-label labeling-form">Departemen</label>
                                <select name="dept" id="dept" class="form-select">
                                    <option value="">Choose</option>
                                    <?php foreach($getDept as $dept) : ?>
                                    <option value="<?= $dept['id'] ?>"><?= $dept['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="year" class="form-label labeling-form">Tahun Pengadaan</label>
                                <select name="year" id="year" class="form-select years">
                                    <option value="">Choose</option>
                                </select>
                            </div>
                            <div class="col-sm">
                                <label for="useful_inv" class="form-label labeling-form">Masa Manfaat (Tahun)</label>
                                <input type="number" class="form-control" placeholder="Your text here" name="useful_inv"
                                    id="useful_inv" required />
                            </div>
                            <div class="col-sm">
                                <label for="condition_inv" class="form-label labeling-form">Kondisi</label>
                                <select name="condition_inv" id="condition_inv" class="form-select" required>
                                    <option value="">Choose</option>
                                    <option value="1">BAIK</option>
                                    <option value="2">KURANG BAIK</option>
                                    <option value="3">RUSAK</option>
                                    <option value="4">SCRAPT</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="notes" class="form-label labeling-form">Keterangan</label>
                                <textarea name="notes" id="notes" cols="30" rows="2" class="form-control"
                                    placeholder="Your text here" required>
								</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="mutasiBarangMasukKeBarang"
                            tabindex="-1">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Image -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="#" alt="Image Preview"
                        style="max-width: 100%; max-height: 300px; margin: auto; display: block;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Image Preview -->
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="dist/temp/js/scripts.js"></script>
    <script src="dist/js/main.js"></script>
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

            $('#modalUpdateMutasiBarang').modal('show');
        });
    });

    // fungsi penomoran inventaris langsung
    $(document).ready(function() {
        // Dapatkan tanggal saat ini
        var currentDate = new Date();

        // Dapatkan tahun dari tanggal saat ini
        var year = currentDate.getFullYear();

        // Dapatkan bulan dari tanggal saat ini (tambah 1 karena bulan dimulai dari 0)
        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');

        // Bangun nomor invoice tanpa urutan terlebih dahulu
        var invWithoutOrder = 'IT/REG/' + year + '/' + month + '/';

        // Lakukan AJAX request ke server untuk memeriksa urutan terakhir di database
        $.ajax({
            url: 'automatic-add-no-inv.php',
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

    // <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    tinymce.init({
        selector: '#spek, #spekM',
        height: 200,
        plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [{
                value: 'First.Name',
                title: 'First Name'
            },
            {
                value: 'Email',
                title: 'Email'
            },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
            "See docs to implement AI Assistant")),
    });

    // Mendapatkan semua elemen dengan class "years"
    var yearSelects = document.querySelectorAll(".years");

    // Loop melalui setiap elemen dengan class "years"
    yearSelects.forEach(function(yearSelect) {
        // Mendapatkan tahun saat ini
        var currentYear = new Date().getFullYear();

        // Loop untuk menambahkan opsi tahun dari tahun sekarang ke belakang 10 tahun
        for (var i = currentYear; i >= currentYear - 10; i--) {
            var option = document.createElement("option");
            option.value = i;
            option.text = i;

            // Menambahkan opsi tahun ke elemen select
            yearSelect.appendChild(option);
        }
    });

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

    function showImageModal(imageName) {
        var modalImage = document.getElementById('modalImage');
        modalImage.src = 'dist/img/' + imageName;
        $('#imageModal').modal('show');
    }

    function compressAndPreviewImage() {
        var input = document.getElementById('imageM');
        var imageInfo = document.getElementById('imageInfo');
        var imagePreview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = new Image();
                img.src = e.target.result;

                img.onload = function() {
                    var canvas = document.createElement('canvas');
                    var ctx = canvas.getContext('2d');

                    // Set the dimensions to compress the image
                    var maxWidth = 300; // Adjust as needed
                    var maxHeight = 200; // Adjust as needed

                    var width = img.width;
                    var height = img.height;

                    // Calculate new dimensions to maintain aspect ratio
                    if (width > height) {
                        if (width > maxWidth) {
                            height *= maxWidth / width;
                            width = maxWidth;
                        }
                    } else {
                        if (height > maxHeight) {
                            width *= maxHeight / height;
                            height = maxHeight;
                        }
                    }

                    canvas.width = width;
                    canvas.height = height;

                    // Draw image on canvas with new dimensions
                    ctx.drawImage(img, 0, 0, width, height);

                    // Convert canvas content to base64 encoded string
                    var compressedDataUrl = canvas.toDataURL('image/jpeg', 0.7); // Adjust quality as needed

                    // Display compressed image preview
                    imagePreview.src = compressedDataUrl;
                    imagePreview.style.display = 'block';

                    // Display image info
                    var imageSize = input.files[0].size / 1024; // Convert to KB
                    imageInfo.innerHTML = 'Image Size: ' + imageSize.toFixed(2) + ' KB';

                    // Enable submit button
                    document.getElementById('tambahBarangMasuk').disabled = false;
                };
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>

</body>

</html>