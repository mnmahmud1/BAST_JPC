<?php
    require "koneksi.php";

	//periksa apakah ada cookie user_log
	if(!isset($_COOKIE["_beta_log"])){
		header("Location: login.php");
	}

    $nameUser = $_COOKIE["_name_log"];
    $idUser = $_COOKIE["_beta_log"];

	$number = $_GET["inv"];
	$queryGetDaftarBarang = mysqli_query($conn, "SELECT goods.number, goods.description, goods.specification, goods.sn, inv_condition.name AS kondisi, goods.year, goods.useful_period, goods.notes, branch.name AS branch, goods.img, goods.id_inv_type, goods.id_inv_group, inv_group.name AS name_group, goods.id_inv_allotment, goods.id_inv_branch, goods.id_inv_source, goods.id_inv_dept, dept.name AS name_dept, goods.id_inv_condition FROM goods INNER JOIN inv_condition ON goods.id_inv_condition = inv_condition.id INNER JOIN branch ON goods.id_inv_branch = branch.id INNER JOIN inv_group ON goods.id_inv_group = inv_group.id INNER JOIN dept ON goods.id_inv_dept = dept.id WHERE goods.number = '$number'");
    $getDaftarBarangInv = mysqli_fetch_assoc($queryGetDaftarBarang);
	if($number == '' OR mysqli_num_rows($queryGetDaftarBarang) == 0){
		header("Location: barang.php");
	}
    $getGoodImg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT img FROM goods WHERE NUMBER = '$number'"));

	$getBranch = mysqli_query($conn, "SELECT id, name FROM branch");
	$getSource = mysqli_query($conn, "SELECT id, name FROM source");
	$getDept = mysqli_query($conn, "SELECT id, name FROM dept");


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
    <script src="https://cdn.tiny.cloud/1/qmbej4hb799ztlyxlce0xqdyf3xmgb1ddaike9wg3cf1vx6b/tinymce/6/tinymce.min.js"
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
                        <div class="collapse show" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="barang-masuk.php">Daftar Barang Masuk</a>
                                <a class="nav-link active" href="barang.php">Daftar Barang</a>
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
                <div class="container-fluid px-4">
                    <h3 class="mt-4">Details Barang</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="barang.php">Barang</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Details</li>
                        </ol>
                    </nav>

                    <div class="row mb-3">
                        <div class="col-sm">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-4">Deskripsi Barang</h5>
                                    <form action="function.php" method="post" enctype="multipart/form-data">
                                        <div class="modal-body px-4">
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <label for="inv" class="form-label labeling-form">No
                                                        Inventaris</label>
                                                    <input type="text" class="form-control" placeholder="You Text Here"
                                                        name="inv" id="inv" required readonly
                                                        value="<?= $getDaftarBarangInv['number'] ?>" />
                                                </div>
                                                <div class="col-sm">
                                                    <label for="sn" class="form-label labeling-form">Serial
                                                        Number</label>
                                                    <input type="text" class="form-control" placeholder="Your text here"
                                                        name="sn" id="sn" required readonly
                                                        value="<?= $getDaftarBarangInv['sn'] ?>" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <label for="description"
                                                        class="form-label labeling-form">Deskripsi</label>
                                                    <input type="text" class="form-control" placeholder="Your text here"
                                                        name="description" id="description" required readonly
                                                        value="<?= $getDaftarBarangInv['description'] ?>" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <label for="spek"
                                                        class="form-label labeling-form">Spesifikasi</label>
                                                    <textarea name="spek" id="spek" cols="30" rows="2"
                                                        class="form-control" placeholder="Your text here"
                                                        required><?= $getDaftarBarangInv['specification'] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <label for="type_inv" class="form-label labeling-form">Tipe
                                                        Inventaris</label>
                                                    <select name="type_inv" id="type_inv" class="form-select" required>
                                                        <?php if($getDaftarBarangInv['id_inv_type'] == "1") : ?>
                                                        <option value="<?= $getDaftarBarangInv['id_inv_type'] ?>"
                                                            selected>HAK MILIK PERUSAHAAN - DEFAULT</option>
                                                        <?php else : ?>
                                                        <option value="<?= $getDaftarBarangInv['id_inv_type'] ?>"
                                                            selected>SEWAAN - DEFAULT</option>
                                                        <?php endif ?>
                                                        <option value="1">HAK MILIK PERUSAHAAN</option>
                                                        <option value="2">SEWAAN</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm">
                                                    <label for="group_inv" class="form-label labeling-form">Grup
                                                        Inventaris</label>
                                                    <select name="group_inv" id="group_inv" class="form-select">
                                                        <option value="<?= $getDaftarBarangInv['id_inv_group'] ?>"
                                                            selected><?= $getDaftarBarangInv['name_group'] ?> - DEFAULT
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-sm">
                                                    <label for="allotment_inv"
                                                        class="form-label labeling-form">Peruntukan
                                                        Inventaris</label>
                                                    <select name="allotment_inv" id="allotment_inv" class="form-select"
                                                        required>
                                                        <?php if($getDaftarBarangInv['id_inv_allotment'] == "1") : ?>
                                                        <option value="<?= $getDaftarBarangInv['id_inv_allotment'] ?>"
                                                            selected>INFRASTRUKTUR - DEFAULT</option>
                                                        <?php else : ?>
                                                        <option value="<?= $getDaftarBarangInv['id_inv_allotment'] ?>"
                                                            selected>INVENTARIS USER - DEFAULT</option>
                                                        <?php endif ?>
                                                        <option value="1">INFRASTRUKTUR</option>
                                                        <option value="2">INVENTARIS USER</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <label for="branch" class="form-label labeling-form">Lokasi</label>
                                                    <select name="branch" id="branch" class="form-select" required>
                                                        <option value="<?= $getDaftarBarangInv['id_inv_branch'] ?>"
                                                            selected><?= $getDaftarBarangInv['branch'] ?> - DEFAULT
                                                        </option>
                                                        <?php foreach($getBranch as $branch) : ?>
                                                        <option value="<?= $branch['id'] ?>"><?= $branch['name'] ?>
                                                        </option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm">
                                                    <label for="source" class="form-label labeling-form">Asal
                                                        Usul</label>
                                                    <select name="source" id="source" class="form-select"
                                                        onchange="updateTextarea()" required>
                                                        <?php if($getDaftarBarangInv['id_inv_source'] == 1) : ?>
                                                        <option value="<?= $getDaftarBarangInv['id_inv_source'] ?>">
                                                            PWR - DEFAULT</option>
                                                        <?php elseif($getDaftarBarangInv['id_inv_source'] == 2) : ?>
                                                        <option value="<?= $getDaftarBarangInv['id_inv_source'] ?>">
                                                            HIBAH - DEFAULT</option>
                                                        <?php elseif($getDaftarBarangInv['id_inv_source'] == 3) : ?>
                                                        <option value="<?= $getDaftarBarangInv['id_inv_source'] ?>">
                                                            LAIN-LAIN - DEFAULT</option>
                                                        <?php endif ?>
                                                        <option value="1">PWR</option>
                                                        <option value="2">HIBAH</option>
                                                        <option value="3">LAIN-LAIN</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm">
                                                    <label for="dept"
                                                        class="form-label labeling-form">Departemen</label>
                                                    <select name="dept" id="dept" class="form-select">
                                                        <option value="<?= $getDaftarBarangInv['id_inv_dept'] ?>"
                                                            selected>
                                                            <?= $getDaftarBarangInv['name_dept'] ?> - DEFAULT</option>
                                                        <?php foreach($getDept as $dept) : ?>
                                                        <option value="<?= $dept['id'] ?>"><?= $dept['name'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <label for="year" class="form-label labeling-form">Tahun
                                                        Pengadaan</label>
                                                    <select name="year" id="year" class="form-select years">
                                                        <option value="<?= $getDaftarBarangInv['year'] ?>" selected>
                                                            <?= $getDaftarBarangInv['year'] ?> - DEFAULT
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-sm">
                                                    <label for="useful_inv" class="form-label labeling-form">Masa
                                                        Manfaat (Tahun)</label>
                                                    <input type="number" class="form-control"
                                                        placeholder="Your text here" name="useful_inv" id="useful_inv"
                                                        required value="<?= $getDaftarBarangInv['useful_period'] ?>"
                                                        maxlength="2" oninput="enforceMaxLength(this)" />
                                                </div>
                                                <div class=" col-sm">
                                                    <label for="condition_inv"
                                                        class="form-label labeling-form">Kondisi</label>
                                                    <select name="condition_inv" id="condition_inv" class="form-select"
                                                        required>
                                                        <option value="<?= $getDaftarBarangInv['id_inv_condition'] ?>"
                                                            selected><?= $getDaftarBarangInv['kondisi'] ?> - DEFAULT
                                                        </option>
                                                        <option value="1">BAIK</option>
                                                        <option value="2">KURANG BAIK</option>
                                                        <option value="3">RUSAK</option>
                                                        <option value="4">SCRAPT</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <label for="notes"
                                                        class="form-label labeling-form">Keterangan</label>
                                                    <textarea name="notes" id="notes" cols="30" rows="2"
                                                        class="form-control" placeholder="Your text here"
                                                        required><?= $getDaftarBarangInv['notes'] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-white"
                                                    onclick="return window.location.href = 'barang.php'"
                                                    tabindex="-1">Back</button>
                                                <button type="submit" class="btn btn-primary"
                                                    name="updateDetailBarang">Update</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 mb-3">
                        <div class="col">
                            <label for="bastSigned" class="form-label labeling-form">UPLOAD IMAGE</label>
                            <?php if(is_null($getGoodImg['img'])) : ?>
                            <?php else : ?>
                            <button class="btn btn-sm" onclick="showImageModal('<?= $getDaftarBarangInv['img'] ?>')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                </svg>
                            </button>
                            <?php endif ?>
                            <form action="function.php" method="post" enctype="multipart/form-data">
                                <input type="text" name="inv_number" value="<?= $number ?>" hidden>
                                <div class="row">
                                    <div class="col-sm-11">
                                        <input type="file" name="imgGood" id="imgGood" class="form-control" required />
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="submit" name="uploadImgGood"
                                            class="btn btn-sm btn-primary">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-4">History BAST - Nama Barang</h5>
                                    <table class="display" name="tableBarang" id="tableBarang">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NO BAST</th>
                                                <th>Deskripsi Inventaris</th>
                                                <th>Kondisi</th>
                                                <th>Diserahkan Oleh</th>
                                                <th>Diterima Oleh</th>
                                                <th>Keterangan</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>GA/2022/08/005</td>
                                                <td>MHN-2022-001</td>
                                                <td>BAIK</td>
                                                <td>M N MAHMUDI (HR & GA)</td>
                                                <td>KEVIN ALNIAGARA (FA)</td>
                                                <td>DIPINJAM KE SITE SGT</td>
                                                <td>
                                                    <button class="btn btn-sm btn-white"
                                                        onclick="window.location.href = '#'">
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
                                            <tr>
                                                <td>2</td>
                                                <td>GA/2022/08/005</td>
                                                <td>MHN-2022-001</td>
                                                <td>BAIK</td>
                                                <td>M N MAHMUDI (HR & GA)</td>
                                                <td>KEVIN ALNIAGARA (FA)</td>
                                                <td>DIPINJAM KE SITE SGT</td>
                                                <td>
                                                    <button class="btn btn-sm btn-white"
                                                        onclick="window.location.href = '#'">
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
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4 justify-content-end">
                        <div class="col-sm-3 text-end">
                            <button name="deleteButton" id="deleteButton" class="btn btn-outline-danger fw-bold"
                                data-bs-toggle="modal" data-bs-target="#modalDelete"
                                data-sn="<?= $getDaftarBarangInv['sn'] ?>"
                                data-inv="<?= $getDaftarBarangInv['number'] ?>">Delete Barang Inventaris</button>
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

    <!-- Modal Delete -->
    <div class="modal fade" id="modalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="function.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDeleteLabel">Are you absolutely sure?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Please type <span class="fw-bold" id="nameGood"><span id="goodInvDelete"></span></span>
                            to confirm.</p>
                        <input type="text" name="typeGood" id="typeGood" class="form-control border-danger"
                            placeholder="Please type bold text above" autofocus autocomplete="off" required />
                        <input type="text" name="snDelete" id="snDelete" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal" tabindex="1">Close</button>
                        <button type="submit" name="deleteGood" id="deleteGood" class="btn btn-danger">Confirm to
                            Delete</button>
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

    // <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    tinymce.init({
        selector: '#spek',
        height: 200,
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
        var selectElement = document.getElementById("source");
        var textareaElement = document.getElementById("notes");

        // Mendapatkan nilai yang dipilih
        var selectedValue = selectElement.value;

        // Periksa nilai yang dipilih
        if (selectedValue === "1") {
            // Jika PWR dipilih, tambahkan teks ke textarea
            textareaElement.value += "REFF PWR ; REFF PO ;";
        } else {
            // Jika pilihan selain PWR dipilih, tidak menghapus teks yang telah dimasukkan manual
            // Hanya menambahkan teks berdasarkan pilihan
            textareaElement.value += "REFF " + selectElement.options[selectElement.selectedIndex].text + "; ";
        }
    }

    // Delete Function
    $(document).ready(function() {
        $('#deleteGood').prop('disabled', true);

        $('#nameGood, #typeGood').keyup(function() {
            if ($('#nameGood').text() == '' && $('#typeGood').val() == '') {
                $('#deleteGood').prop('disabled', true);
            } else if ($('#nameGood').text() == $('#typeGood').val()) {
                $('#deleteGood').prop('disabled', false);
            } else {
                $('#deleteGood').prop('disabled', true);
            }
        });
    });

    // Fix 1 modal for all list
    $(document).on('click', '#deleteButton', function(e) {
        let sn = $(this).data('sn')
        let inv = $(this).data('inv')

        $('#snDelete').val(sn) // hapus berdasarkan SN = hanya masuk dump category
        $('#goodInvDelete').text(inv)
    });

    function showImageModal(imageName) {
        var modalImage = document.getElementById('modalImage');
        modalImage.src = 'dist/img/' + imageName;
        $('#imageModal').modal('show');
    }

    function enforceMaxLength(el) {
        if (el.value.length > el.maxLength) {
            el.value = el.value.slice(0, el.maxLength);
        }
    }
    </script>
</body>

</html>