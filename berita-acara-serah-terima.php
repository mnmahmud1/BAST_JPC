<?php
    require "koneksi.php";

	//periksa apakah ada cookie user_log
	if(!isset($_COOKIE["_beta_log"])){
		header("Location: login.php");
	}

    $nameUser = $_COOKIE["_name_log"];
    $idUser = $_COOKIE["_beta_log"];

    $urutDaftar = 1;

	$getBranch = mysqli_query($conn, "SELECT id, name FROM branch");
	$getUsersAdmin = mysqli_query($conn, "SELECT users.id, users.name, dept.name AS dept_name FROM users INNER JOIN dept ON users.id_dept = dept.id WHERE as_admin = 1 AND as_dump = 0;");
	$getUsersAll = mysqli_query($conn, "SELECT users.id, users.name, dept.name AS dept_name FROM users INNER JOIN dept ON users.id_dept = dept.id WHERE as_dump = 0;");

	$getBast = mysqli_query($conn, "SELECT bast_report.number, bast_report.status, users_submitted.name AS submitted_name, dept_submitted.name AS submitted_dept, users_accepted.name AS accepted_name, dept_accepted.name AS accepted_dept, bast_report.notes, bast_report.created_at FROM bast_report INNER JOIN users AS users_submitted ON bast_report.id_user_submitted = users_submitted.id INNER JOIN dept AS dept_submitted ON users_submitted.id_dept = dept_submitted.id LEFT JOIN users AS users_accepted ON bast_report.id_user_accepted = users_accepted.id LEFT JOIN dept AS dept_accepted ON users_accepted.id_dept = dept_accepted.id WHERE bast_report.as_dump = 0");
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
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">+
                                    Tambah Berita Acara</button>
                                <button class="btn btn-outline-primary">Pengembalian</button>
                            </div>
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
                                            <?php foreach($getBast as $bast) : ?>
                                            <tr>
                                                <td><?= $urutDaftar ?></td>
                                                <td><?= $bast['number'] ?></td>
                                                <td>
                                                    <?php if($bast['status'] == 0) : ?>
                                                    <span class="text-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor"
                                                            class="bi bi-arrow-down-left-circle-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-5.904-2.803a.5.5 0 1 1 .707.707L6.707 10h2.768a.5.5 0 0 1 0 1H5.5a.5.5 0 0 1-.5-.5V6.525a.5.5 0 0 1 1 0v2.768l4.096-4.096z" />
                                                        </svg>
                                                    </span>
                                                    <?php elseif($bast['status'] == 1) : ?>
                                                    <span class="text-secondary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-arrow-up-right-circle-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M0 8a8 8 0 1 0 16 0A8 8 0 0 0 0 8zm5.904 2.803a.5.5 0 1 1-.707-.707L9.293 6H6.525a.5.5 0 1 1 0-1H10.5a.5.5 0 0 1 .5.5v3.975a.5.5 0 0 1-1 0V6.707l-4.096 4.096z" />
                                                        </svg>
                                                    </span>
                                                    <?php endif ?>
                                                </td>
                                                <td><?= $bast['submitted_name'] ?> (<?= $bast['submitted_dept'] ?>)</td>
                                                <td><?= $bast['accepted_name'] ?> (<?= $bast['accepted_dept'] ?>)</td>
                                                <td><?= $bast['notes'] ?></td>
                                                <td class="fs-6"><?= $bast['created_at'] ?></td>
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
                                            <?php $urutDaftar++; endforeach ?>

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
                    <h1 class="modal-title fs-5" id="modalTambahLabel">Tambah - Berita Acara Serah Terima Inventaris
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="function.php" method="post">
                    <div class="modal-body px-4">
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="bast" class="form-label labeling-form">No Berita Acara</label>
                                <input type="text" class="form-control" placeholder="You Text Here" name="bast"
                                    id="bast" readonly required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="submitted" class="form-label labeling-form">Diserahkan Oleh (IT)</label>
                                <select name="submitted" id="submitted" class="form-select" autofocus required>
                                    <option value="">Choose</option>
                                    <?php foreach($getUsersAdmin as $admin) : ?>
                                    <option value="<?= $admin['id'] ?>" data-dept="<?= $admin['dept_name'] ?>">
                                        <?= $admin['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-sm">
                                <label for="dept-submitted" class="form-label labeling-form">Departement
                                    Penyerah</label>
                                <input type="text" name="dept-submitted" id="dept-submitted" class="form-control"
                                    value="Choose" readonly />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="accepted" class="form-label labeling-form">Diterima Oleh</label>
                                <select name="accepted" id="accepted" class="form-select" required>
                                    <option value="">Choose</option>
                                    <?php foreach($getUsersAll as $user) : ?>
                                    <option value="<?= $user['id'] ?>" data-dept="<?= $user['dept_name'] ?>">
                                        <?= $user['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-sm">
                                <label for="dept-accepted" class="form-label labeling-form">Departement Penerima</label>
                                <input type="text" name="dept-accepted" id="dept-accepted" class="form-control"
                                    value="Choose" readonly />
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
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" tabindex="-1" name="addBastGiven"
                            id="addBastGiven">Tambah</button>
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
    });

    $(document).ready(function() {
        $(".preloader").fadeOut("slow");
    });

    // Every time a modal is shown, if it has an autofocus element, focus on it.
    $(".modal").on("shown.bs.modal", function() {
        $(this).find("[autofocus]").focus();
    });

    // fungsi penomoran BAST langsung
    $(document).ready(function() {
        // Dapatkan tanggal saat ini
        var currentDate = new Date();

        // Dapatkan tahun dari tanggal saat ini
        var year = currentDate.getFullYear();

        // Dapatkan bulan dari tanggal saat ini (tambah 1 karena bulan dimulai dari 0)
        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');

        // Bangun nomor invoice tanpa urutan terlebih dahulu
        var bastWithoutOrder = 'IT/BAST/' + year + '/' + month + '/';

        // Lakukan AJAX request ke server untuk memeriksa urutan terakhir di database
        $.ajax({
            url: 'automatic-add-no-bast.php',
            method: 'POST',
            data: {
                bastWithoutOrder: bastWithoutOrder
            },
            success: function(response) {
                // Tanggapan dari server berisi urutan terakhir dari database
                var lastOrder = parseInt(response);

                // Tambahkan 1 ke urutan terakhir
                var newOrder = (lastOrder).toString().padStart(2, '0');

                // Bangun nomor invoice lengkap
                var invoiceNumber = bastWithoutOrder + newOrder;

                // Set nilai nomor invoice ke input dengan id #bast
                $('#bast').val(invoiceNumber);
            },
            error: function() {
                // Penanganan kesalahan jika terjadi
                console.error('Error checking database for order number.');
            }
        });
    });


    document.addEventListener("DOMContentLoaded", function() {
        // Ambil elemen select dan input
        var selectSubmited = document.getElementById("submitted");
        var inputDept = document.getElementById("dept-submitted");

        // Tambahkan event listener pada perubahan nilai select
        selectSubmited.addEventListener("change", function() {
            // Ambil nilai dan data-dept dari opsi terpilih
            var selectedOption = selectSubmited.options[selectSubmited.selectedIndex];
            var selectedDept = selectedOption.getAttribute("data-dept");

            // Set nilai input dengan data-dept terpilih
            inputDept.value = selectedDept;
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        // Ambil elemen select dan input
        var selectSubmited = document.getElementById("accepted");
        var inputDept = document.getElementById("dept-accepted");

        // Tambahkan event listener pada perubahan nilai select
        selectSubmited.addEventListener("change", function() {
            // Ambil nilai dan data-dept dari opsi terpilih
            var selectedOption = selectSubmited.options[selectSubmited.selectedIndex];
            var selectedDept = selectedOption.getAttribute("data-dept");

            // Set nilai input dengan data-dept terpilih
            inputDept.value = selectedDept;
        });
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
    </script>
</body>

</html>