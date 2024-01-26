<?php
    require "koneksi.php";

	//periksa apakah ada cookie user_log
	if(!isset($_COOKIE["_beta_log"])){
		header("Location: login.php");
	}

    $nameUser = $_COOKIE["_name_log"];
    $idUser = $_COOKIE["_beta_log"];

    $urutDaftar = 1;
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
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Serah Terima Inventaris</li>
                    </ol>

                    <div class="row mb-3">
                        <div class="col-sm">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">+
                                Tambah Berita Acara</button>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-4">Daftar Berita Acara</h5>
                                    <table class="display" name="tableBarang" id="tableBarang">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>No.BA</th>
                                                <th>Status</th>
                                                <th>Diserahkan Oleh</th>
                                                <th>Diterima Oleh</th>
                                                <th>Keterangan</th>
                                                <th>Date</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>GA/2022/08/005</td>
                                                <td>
                                                    <span class="text-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor"
                                                            class="bi bi-arrow-down-left-circle-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-5.904-2.803a.5.5 0 1 1 .707.707L6.707 10h2.768a.5.5 0 0 1 0 1H5.5a.5.5 0 0 1-.5-.5V6.525a.5.5 0 0 1 1 0v2.768l4.096-4.096z" />
                                                        </svg>
                                                    </span>
                                                </td>
                                                <td>KEVIN ALNIAGARA (FA)</td>
                                                <td>M N MAHMUDI (HR & GA)</td>
                                                <td>DIPINJAM KE SITE SGT</td>
                                                <td class="fs-6">10.40 PM 11-11-2022</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-white" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                            </svg>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item"
                                                                    href="ba-serah-terima-details.php">Details</a></li>
                                                            <li><a class="dropdown-item" href="#">See Pdf</a></li>
                                                            <li><a class="dropdown-item" href="#">Print</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>GA/2022/08/005</td>
                                                <td>
                                                    <span class="text-secondary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-arrow-up-right-circle-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M0 8a8 8 0 1 0 16 0A8 8 0 0 0 0 8zm5.904 2.803a.5.5 0 1 1-.707-.707L9.293 6H6.525a.5.5 0 1 1 0-1H10.5a.5.5 0 0 1 .5.5v3.975a.5.5 0 0 1-1 0V6.707l-4.096 4.096z" />
                                                        </svg>
                                                    </span>
                                                </td>
                                                <td>M N MAHMUDI (HR & GA)</td>
                                                <td>KEVIN ALNIAGARA (FA)</td>
                                                <td>DIPINJAM KE SITE SGT</td>
                                                <td class="fs-6">10.40 PM 11-11-2022</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-white" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                            </svg>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item"
                                                                    href="ba-serah-terima-details.php">Details</a></li>
                                                            <li><a class="dropdown-item" href="#">See Pdf</a></li>
                                                            <li><a class="dropdown-item" href="#">Print</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
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
                    <h1 class="modal-title fs-5" id="modalTambahLabel">Tambah Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body px-4">
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">No Berita Acara</label>
                                <input type="text" class="form-control" placeholder="You Text Here" name="" id=""
                                    autofocus required />
                            </div>
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">Lokasi</label>
                                <select name="" id="" class="form-select" required>
                                    <option value="">Choose</option>
                                    <option value="">Head Office Jakarta</option>
                                    <option value="">Workshop Gunung Putri</option>
                                    <option value="">Branch Office Pekanbaru</option>
                                    <option value="">Branch Office Surabaya</option>
                                    <option value="">Branch Office Balikpapan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">Diserahkan Oleh</label>
                                <select name="" id="" class="form-select" required>
                                    <option value="">Choose</option>
                                    <option value="">M Nurhasan Mahmudi</option>
                                    <option value="">Ali Rakhman</option>
                                </select>
                            </div>
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">Departement</label>
                                <input type="text" name="" id="" class="form-control" placeholder="HR & GA / IT"
                                    readonly />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">Diterima Oleh</label>
                                <select name="" id="" class="form-select" required>
                                    <option value="">Choose</option>
                                    <option value="">M Nurhasan Mahmudi</option>
                                    <option value="">Ali Rakhman</option>
                                    <option value="">Kevin Alniagara</option>
                                </select>
                            </div>
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">Departement</label>
                                <input type="text" name="" id="" class="form-control" placeholder="Finance Accounting"
                                    readonly />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="" class="form-label labeling-form">Keterangan</label>
                                <textarea name="" id="" cols="30" rows="2" class="form-control"
                                    placeholder="Your text here" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" tabindex="-1">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="dist/temp/js/scripts.js"></script>
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
    </script>
</body>

</html>