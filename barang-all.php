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

    $getDaftarBarangInv = mysqli_query($conn, "SELECT goods.number, goods.description, goods.sn, goods.specification, good_incoming_details.harga, inv_condition.name AS kondisi, goods.year, branch.initial AS branch, goods.img, goods.notes, good_incoming_details.updated_at AS DeliveryDate FROM goods INNER JOIN inv_condition ON goods.id_inv_condition = inv_condition.id INNER JOIN branch ON goods.id_inv_branch = branch.initial INNER JOIN good_incoming_details ON goods.sn = good_incoming_details.sn WHERE goods.as_dump = 0 GROUP BY goods.sn ORDER BY goods.id ASC");

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
                    <h3 class="mt-4">Semua Barang</h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">Barang</li>
                        <li class="breadcrumb-item active">Semua Barang</li>
                    </ol>

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
                                                <th>Tahun</th>
                                                <th>SN</th>
                                                <th>Specification</th>
                                                <th>Unit Price</th>
                                                <th>Kondisi</th>
                                                <th>Delivery Date</th>
                                                <th>Img</th>
                                                <th>Notes</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($getDaftarBarangInv as $barangInv) : ?>
                                            <tr>
                                                <td><?= $urutDaftarI ?></td>
                                                <td class="fw-bold"><?= $barangInv["number"] ?></td>
                                                <td><?= $barangInv["description"] ?></td>
                                                <td><?= $barangInv["year"] ?></td>
                                                <td><?= $barangInv["sn"] ?></td>
                                                <td><?= $barangInv["specification"] ?></td>
                                                <td><?= $barangInv["harga"] ?></td>
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
                                                <td><?= $barangInv["DeliveryDate"] ?></td>
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
                                                <td><?= $barangInv["notes"] ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-white"
                                                        onclick="window.location.href = 'barang-details.php?inv=<?= $barangInv['number'] ?>'">
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
        // Inisialisasi DataTable dengan fitur select
        let tableBarang = $("#tableBarang").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print"],
            select: true, // Mengaktifkan fitur seleksi
        });
    });


    $(document).ready(function() {
        $(".preloader").fadeOut("slow");
    });

    // Every time a modal is shown, if it has an autofocus element, focus on it.
    $(".modal").on("shown.bs.modal", function() {
        $(this).find("[autofocus]").focus();
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

    // buat format currency untuk harga
    $(document).ready(function() {
        $('#harga_display').on('input', function() {
            let raw = $(this).val().replace(/[^\d]/g, ''); // hanya angka
            if (raw) {
                let formatted = parseInt(raw, 10).toLocaleString('id-ID');
                $(this).val('Rp ' + formatted);
            } else {
                $(this).val('');
            }
            $('#harga').val(raw); // simpan nilai murni ke hidden input
        });

        $('#harga_display').on('focus', function() {
            // hapus format saat user fokus
            let raw = $(this).val().replace(/[^\d]/g, '');
            $(this).val(raw);
        });

        $('#harga_display').on('blur', function() {
            // tampilkan kembali format Rupiah
            let raw = $(this).val().replace(/[^\d]/g, '');
            if (raw) {
                let formatted = parseInt(raw, 10).toLocaleString('id-ID');
                $(this).val('Rp ' + formatted);
            }
            $('#harga').val(raw); // pastikan nilai murni tersimpan
        });
    });
    </script>

</body>

</html>