<?php
    require "koneksi.php";

	//periksa apakah ada cookie user_log
	if(!isset($_COOKIE["_beta_log"])){
		header("Location: login.php");
	}

    $urutBarang = 1;
    $urutGroup = 1;

    $nameUser = $_COOKIE["_name_log"];
    $rrNumber = $_COOKIE["_rr_number_log"];

    // ambil data created_at untuk Memformat kembali timestamp sesuai dengan format yang diinginkan
    $getDetailsRR = mysqli_query($conn, "SELECT id, notes, created_at FROM good_incoming WHERE number = '$rrNumber'");
    $getDetailRR = mysqli_fetch_assoc($getDetailsRR); 
    
    // ambil data incoming detail berdasar id good_incoming
    $idIncoming = $getDetailRR["id"];
    $getDetailGoodIncoming = mysqli_query($conn, "SELECT id, description, sn, pwr, po, type, notes, img, as_inv FROM good_incoming_details WHERE id_incoming = $idIncoming");

    // ambil data select tipe invenaris
    $getInvType = mysqli_query($conn, "SELECT id, name FROM inv_type");

    // Ambil data inv_group
    $getInvGroup = mysqli_query($conn, "SELECT code, name, description FROM inv_group ORDER BY code ASC");
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

    <!-- jQuery Typeahead CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.0/jquery.typeahead.min.css"
        rel="stylesheet" />

    <!-- Jquery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Datatables Jquery -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    <style>
    .typeahead__container {
        position: relative;
    }

    .typeahead__query {
        z-index: 1060;
        /* Z-index lebih tinggi dari Bootstrap modal */
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
                        <div class="collapse show" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link active" href="barang-masuk.php">Daftar Barang Masuk</a>
                                <a class="nav-link" href="barang.php">Daftar Barang</a>
                                <a class="nav-link" href="lisensi.php">Daftar Lisensi</a>
                                <a class="nav-link" href="perbaikan.html">Perbaikan Barang <span
                                        class="badge text-bg-info">WIP</span></a>
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
                                                        <th>Img</th>
                                                        <th>Act</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($getDetailGoodIncoming as $getDetail) : ?>
                                                    <tr>
                                                        <?php
                                                            $desc = $getDetail["description"];
                                                            $validateDescGroup = mysqli_query($conn, "SELECT id FROM inv_group WHERE description = '$desc'");
                                                            $thisSN = $getDetail["sn"];
                                                            ?>
                                                        <td><?= $urutBarang ?></td>
                                                        <td>
                                                            <?php
                                                            if($getDetail["type"] == 1  AND $getDetail["as_inv"] == 1) : 
                                                                $getNumberIfGoods = mysqli_fetch_assoc(mysqli_query($conn, "SELECT goods.number FROM goods INNER JOIN good_incoming_details ON goods.sn = good_incoming_details.sn WHERE good_incoming_details.sn = '$thisSN'"));
                                                            ?>
                                                            <?= $getDetail["description"] ?> <span
                                                                class="badge rounded-pill bg-light"><a
                                                                    href="barang-details.php?inv=<?= $getNumberIfGoods['number'] ?>"
                                                                    class="text-decoration-none text-black">INV</a></span>
                                                            <?php
                                                            elseif($getDetail["type"] == 2 AND $getDetail["as_inv"] == 1) :
                                                                $getNumberIfLisences = mysqli_fetch_assoc(mysqli_query($conn, "SELECT lisences.number FROM lisences INNER JOIN good_incoming_details ON lisences.sn = good_incoming_details.sn WHERE good_incoming_details.sn = '$thisSN'"));
                                                            ?>
                                                            <?= $getDetail["description"] ?> <span
                                                                class="badge rounded-pill bg-light"><a
                                                                    href="lisensi-details.php?inv=<?= $getNumberIfLisences['number'] ?>"
                                                                    class="text-decoration-none text-black">INV</a>
                                                                <?php else : ?>
                                                                <?= $getDetail["description"] ?>
                                                                <?php endif ?>
                                                                <br>
                                                                <?php  if(mysqli_num_rows($validateDescGroup) < 1 AND $getDetail["type"] != 2 AND $getDetail["type"] != 3) : ?>
                                                                <span class="badge rounded-pill bg-success">
                                                                    <a href="#" class="text-decoration-none text-white"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modalTambahGroup"
                                                                        data-description="<?= htmlspecialchars($getDetail["description"], ENT_QUOTES, 'UTF-8') ?>">Daftarkan
                                                                        Sekarang!</a>
                                                                </span>
                                                                <?php endif ?>
                                                        </td>
                                                        <td><?= $getDetail["sn"] ?></td>
                                                        <td><?= $getDetail["pwr"] ?></td>
                                                        <td><?= $getDetail["po"] ?></td>
                                                        <td>
                                                            <?php if($getDetail["type"] == 1) : ?>
                                                            <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-title="Goods">
                                                                <i class="fa-solid fa-screwdriver-wrench"></i>
                                                            </span>
                                                            <?php elseif($getDetail["type"] == 2) : ?>
                                                            <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-title="Lisences">
                                                                <i class="fa-regular fa-newspaper"></i>
                                                            </span>
                                                            <?php elseif($getDetail["type"] == 3) : ?>
                                                            <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-title="Consumables">
                                                                <i class="fa-solid fa-layer-group"></i>
                                                            </span>
                                                            <?php endif ?>
                                                        </td>
                                                        <td><?= $getDetail["notes"] ?></td>
                                                        <td>
                                                            <button class="btn btn-sm"
                                                                onclick="showImageModal('<?= $getDetail['img'] ?>')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                                    <path
                                                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                                                </svg>
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <?php if($getDetail["type"] == 3) : ?>
                                                            <button class="btn btn-sm"
                                                                onclick="window.location.href = 'function.php?copyRowDataBarangMasuk=<?= $getDetail['id'] ?>'">
                                                                <!-- Icon Copy -->
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-copy"
                                                                    viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd"
                                                                        d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z" />
                                                                </svg>
                                                            </button>
                                                            <?php elseif(($getDetail["type"] == 1 AND mysqli_num_rows($validateDescGroup) > 0) OR $getDetail["type"] == 2) :  ?>
                                                            <button class="btn btn-sm" id="copyRow">
                                                                <!-- Icon Copy -->
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-copy"
                                                                    viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd"
                                                                        d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z" />
                                                                </svg>
                                                            </button>
                                                            <?php endif ?>
                                                            <?php if($getDetail["as_inv"] != 1) : ?>
                                                            <button class="btn btn-sm"
                                                                onclick="hapusDetailBarang(' <?= $getDetail['id'] ?> ')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-trash3"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                </svg>
                                                            </button>
                                                            <?php endif ?>

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
                <form action="function.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body px-4">
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">Deskripsi</label>
                                <div class="typeahead__container">
                                    <div class="typeahead__field">
                                        <div class="typeahead__query">
                                            <input type="text" id="desc" class="form-control" name="desc"
                                                placeholder="Your text here" autocomplete="off" autofocus required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">Serial Number</label>
                                <input type="text" class="form-control" placeholder="Your text here" name="sn" id="sn"
                                    onchange="validateSN()" maxlength="100" required />
                                <span id="snError"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">No. PWR</label>
                                <input type="text" class="form-control" placeholder="Your text here" name="pwr" id="pwr"
                                    maxlength="20" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">No. PO</label>
                                <input type="text" class="form-control" placeholder="Your text here" name="po" id="po"
                                    maxlength="20" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">Tipe Barang Masuk</label>
                                <select name="type" id="type" class="form-select" required
                                    onchange="toggleSNReadOnly()">
                                    <option value="">Choose</option>
                                    <?php foreach($getInvType as $getInv) :  ?>
                                    <option value="<?= $getInv['id'] ?>"><?= $getInv['name'] ?></option>
                                    <?php endforeach  ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">Notes</label>
                                <input type="text" class="form-control" placeholder="Your text here" name="notes"
                                    id="note" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="image" class="form-label labeling-form">Upload Image</label>
                                <input type="file" class="form-control" name="image" id="image" accept="image/*"
                                    onchange="compressAndPreviewImage()" required />
                                <p id="imageInfo"></p>
                                <img id="imagePreview" src="#" alt="Image Preview"
                                    style="max-width: 100%; max-height: 200px; margin-top: 10px; display: none;">
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

    <!-- Modal Tambah Data Group -->
    <div class="modal fade" id="modalTambahGroup" tabindex="-1" aria-labelledby="modalTambahGroupLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahGroupLabel">Daftarkan Inventaris Group</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="function.php" method="post">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="display" id="tableGroupInv">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Inv</th>
                                                    <th>Jenis Inv</th>
                                                    <th>Nama Inv</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($getInvGroup as $getInv) : ?>
                                                <tr>
                                                    <td><?= $urutGroup ?></td>
                                                    <td><?= $getInv['code'] ?></td>
                                                    <td><?= $getInv['name'] ?></td>
                                                    <td><?= $getInv['description'] ?></td>
                                                </tr>
                                                <?php $urutGroup++; endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="mb-3">Tambahkan Group</h5>
                                        <div class="row mb-3">
                                            <div class="col-sm">
                                                <label for="group" class="form-label labeling-form">Group
                                                    Inventaris</label>
                                                <div class="typeahead__container">
                                                    <div class="typeahead__field">
                                                        <div class="typeahead__query">
                                                            <input type="text" name="group" id="group"
                                                                class="form-control" placeholder="E.g LAPTOP, PC, ..."
                                                                maxlength="50" autofocus required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm">
                                                <label for="code" class="form-label labeling-form">Code</label>
                                                <input type="text" name="code" id="code" class="form-control"
                                                    placeholder="E.g LT01, PC01, ..." maxlength="4" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm">
                                                <label for="description"
                                                    class="form-label labeling-form">Description</label>
                                                <input type="text" name="description" id="description"
                                                    class="form-control" placeholder="E.g LAPTOP ASUS ..." readonly
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" tabindex="-1" name="tambahGroup"
                            id="tambahGroup">Tambah</button>
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

    <!-- jQuery Typeahead JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.0/jquery.typeahead.min.js"></script>

    <script>
    $(document).ready(function() {
        $("#tableBarang").DataTable();
        $("#tableGroupInv").DataTable();
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
        $("input[type=text], textarea").on("input", function() {
            // Simpan posisi kursor
            var caretPos = this.selectionStart;

            // Ubah nilai menjadi huruf kapital
            $(this).val($(this).val().toUpperCase());

            // Kembalikan posisi kursor
            this.setSelectionRange(caretPos, caretPos);
        });
    });

    function compressAndPreviewImage() {
        var input = document.getElementById('image');
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

    function showImageModal(imageName) {
        var modalImage = document.getElementById('modalImage');
        modalImage.src = 'dist/img/' + imageName;
        $('#imageModal').modal('show');
    }

    $(document).ready(function() {
        // Mengambil data dari server menggunakan AJAX Description Group
        $.ajax({
            url: 'dist/php-js/autocomplete-desc.php',
            dataType: 'json',
            success: function(data) {
                $('#desc').typeahead({
                    source: data,
                    callback: {
                        onInit: function($el) {
                            console.log(
                                `Typeahead initiated on: ${$el.prop('tagName')}#${$el.attr('id')}`
                            );
                        },
                        // Handler saat item dipilih
                        onClickAfter: function(node, a, item, event) {
                            // Mengubah nilai input desc
                            $('#desc').val(item.display);
                        }
                    }
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching data:', textStatus, errorThrown);
            }
        });
    });

    $(document).ready(function() {
        // Mengambil data dari server menggunakan AJAX Description Group
        $.ajax({
            url: 'dist/php-js/autocomplete-group.php',
            dataType: 'json',
            success: function(data) {
                $('#group').typeahead({
                    source: data,
                    callback: {
                        onInit: function($el) {
                            console.log(
                                `Typeahead initiated on: ${$el.prop('tagName')}#${$el.attr('id')}`
                            );
                        },
                        // Handler saat item dipilih
                        onClickAfter: function(node, a, item, event) {
                            // Mengubah nilai input desc
                            $('#group').val(item.display);
                        }
                    }
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching data:', textStatus, errorThrown);
            }
        });
    });

    $(document).ready(function() {
        $('#modalTambahGroup').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var description = button.data('description'); // Ambil nilai dari atribut data-description
            var modal = $(this);
            modal.find('#description').val(
                description); // Isi input description dengan nilai yang diambil
        });
    });


    function toggleSNReadOnly() {
        const typeSelect = document.getElementById('type');
        const snInput = document.getElementById('sn');

        if (typeSelect.value === '3') {
            snInput.setAttribute('readonly', 'readonly'); // Set readonly
            snInput.removeAttribute('required'); // Remove required
        } else {
            snInput.removeAttribute('readonly'); // Remove readonly
            snInput.setAttribute('required', 'required'); // Set required
        }
    }

    // Fungsi untuk copy Row jika type barang 1 & 2, untuk mempermudah input
    // Ambil semua tombol "Edit" di tabel
    const editButtons = document.querySelectorAll('#copyRow');

    // Event listener untuk setiap tombol "Edit"
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Ambil row yang berisi tombol "Edit" yang diklik
            const row = button.closest('tr');

            // Ambil data dari setiap cell di row
            const desc = row.cells[1].textContent.trim();
            const pwr = row.cells[3].textContent.trim();
            const po = row.cells[4].textContent.trim();
            const notes = row.cells[6].textContent.trim();

            // Masukkan data ke dalam modal form
            document.getElementById('desc').value = desc;
            document.getElementById('pwr').value = pwr;
            document.getElementById('po').value = po;
            document.getElementById('note').value = notes;

            // Tampilkan modal
            $('#modalTambahBarang').modal('show');
        });
    }); // END Fungsi untuk copy Row jika type barang 1 & 2, untuk mempermudah input

    // enable tooltip 
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>