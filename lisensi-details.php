<?php
    require "koneksi.php";

	//periksa apakah ada cookie user_log
	if(!isset($_COOKIE["_beta_log"])){
		header("Location: login.php");
	}

    $nameUser = $_COOKIE["_name_log"];
    $idUser = $_COOKIE["_beta_log"];

    $number = $_GET["inv"];
	$queryGetDaftarLisensi = mysqli_query($conn, "SELECT lisences.number, lisences.sn, lisences.description, lisences.id_lic_type, lisences.seats, lisences.date_start, lisences.date_end, lisences.id_lic_branch, lisences.id_lic_dept, lisences.id_lic_source, lisences.notes, branch.name AS branch, dept.name AS dept, source.name AS source FROM lisences INNER JOIN branch ON lisences.id_lic_branch = branch.id INNER JOIN dept ON lisences.id_lic_dept = dept.id INNER JOIN source ON lisences.id_lic_source = source.id WHERE lisences.number = '$number'");
    $getDaftarLisensiInv = mysqli_fetch_assoc($queryGetDaftarLisensi);
	if($number == '' OR mysqli_num_rows($queryGetDaftarLisensi) == 0){
		header("Location: lisensi.php");
	}

    $getBranch = mysqli_query($conn, "SELECT id, name FROM branch");
	$getSource = mysqli_query($conn, "SELECT id, name FROM source");
	$getDept = mysqli_query($conn, "SELECT id, name FROM dept");

    $urutDaftar = 1;

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
                    <h3 class="mt-4">Details - <?= $getDaftarLisensiInv["description"] ?></h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="lisensi.php">Lisensi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Details</li>
                        </ol>
                    </nav>

                    <div class="row mb-3">
                        <div class="col-sm">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-4">Deskripsi Lisensi</h5>
                                    <form action="function.php" method="post">
                                        <div class="modal-body px-4">
                                            <div class="row mb-3">
                                                <div class="col-sm-4">
                                                    <label for="inv" class="form-label labeling-form">No
                                                        Lisensi</label>
                                                    <input type="text" class="form-control" placeholder="You Text Here"
                                                        name="inv" id="inv"
                                                        value="<?= $getDaftarLisensiInv["number"] ?>" readonly />
                                                </div>
                                                <div class="col-sm-8">
                                                    <label for="sn" class="form-label labeling-form">Serial/Subscribtion
                                                        ID</label>
                                                    <input type="text" class="form-control" placeholder="Your text here"
                                                        name="sn" id="sn" value="<?= $getDaftarLisensiInv["sn"] ?>"
                                                        readonly />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-8">
                                                    <label for="description" class="form-label labeling-form">Deskripsi
                                                        Lisensi</label>
                                                    <input type="text" class="form-control" placeholder="Your text here"
                                                        name="description" id="description"
                                                        value="<?= $getDaftarLisensiInv["description"] ?>" required />
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="type_lic" class="form-label labeling-form">Type
                                                        Lisence</label>
                                                    <select name="type_lic" id="type_lic"
                                                        class="form-select type_lisence" required>
                                                        <?php if($getDaftarLisensiInv['id_lic_type'] == 1) : ?>
                                                        <option value="<?= $getDaftarLisensiInv['id_lic_type'] ?>">
                                                            PERPETUAL LISENCE - DEFAULT</option>
                                                        <?php elseif($getDaftarLisensiInv['id_lic_type'] == 2) : ?>
                                                        <option value="<?= $getDaftarLisensiInv['id_lic_type'] ?>">
                                                            SUBSCRIBTION LISENCE - DEFAULT</option>
                                                        <?php endif ?>
                                                        <option value="1">PERPETUAL LISENCE</option>
                                                        <option value="2">SUBSCRIBTION LISENCE</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <label for="seats" class="form-label labeling-form">Seats</label>
                                                    <input type="number" class="form-control"
                                                        placeholder="Your text here" name="seats" id="seats"
                                                        value="<?= $getDaftarLisensiInv["seats"] ?>" required />
                                                </div>
                                                <div class="col-sm">
                                                    <label for="date_start" class="form-label labeling-form">Date
                                                        Start</label>
                                                    <input type="date" class="form-control" name="date_start"
                                                        id="date_start"
                                                        value="<?= date("Y-m-d", strtotime($getDaftarLisensiInv["date_start"])) ?>"
                                                        required />
                                                </div>
                                                <div class="col-sm">
                                                    <label for="date_end" class="form-label labeling-form">Date
                                                        End <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-title="Jika Perpetual Lisence maka form ini dibiarkan kosong">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                                                            </svg>
                                                        </span></label>
                                                    <input type="date" class="form-control date_end" name="date_end"
                                                        id="date_end"
                                                        value="<?= date("Y-m-d", strtotime($getDaftarLisensiInv["date_end"])) ?>" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <label for="dept"
                                                        class="form-label labeling-form">Departemen</label>
                                                    <select name="dept" id="dept" class="form-select">
                                                        <option value="<?= $getDaftarLisensiInv['id_lic_dept'] ?>"
                                                            selected>
                                                            <?= $getDaftarLisensiInv['dept'] ?> - DEFAULT</option>
                                                        <?php foreach($getDept as $dept) : ?>
                                                        <option value="<?= $dept['id'] ?>"><?= $dept['name'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm">
                                                    <label for="branch" class="form-label labeling-form">Lokasi</label>
                                                    <select name="branch" id="branch" class="form-select" required>
                                                        <option value="<?= $getDaftarLisensiInv['id_lic_branch'] ?>"
                                                            selected><?= $getDaftarLisensiInv['branch'] ?> - DEFAULT
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
                                                        <?php if($getDaftarLisensiInv['id_lic_source'] == 1) : ?>
                                                        <option value="<?= $getDaftarLisensiInv['id_lic_source'] ?>">
                                                            PWR - DEFAULT</option>
                                                        <?php elseif($getDaftarLisensiInv['id_lic_source'] == 2) : ?>
                                                        <option value="<?= $getDaftarLisensiInv['id_lic_source'] ?>">
                                                            HIBAH - DEFAULT</option>
                                                        <?php elseif($getDaftarLisensiInv['id_lic_source'] == 3) : ?>
                                                        <option value="<?= $getDaftarLisensiInv['id_lic_source'] ?>">
                                                            LAIN-LAIN - DEFAULT</option>
                                                        <?php endif ?>
                                                        <option value="1">PWR</option>
                                                        <option value="2">HIBAH</option>
                                                        <option value="3">LAIN-LAIN</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <label for="notes"
                                                        class="form-label labeling-form">Keterangan</label>
                                                    <textarea name="notes" id="notes" cols="30" rows="2"
                                                        class="form-control" placeholder="Your text here"
                                                        required><?= $getDaftarLisensiInv["notes"] ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-bs-dismiss="modal"
                                                onclick="window.location.href = 'lisensi.php'"
                                                tabindex="-1">Back</button>
                                            <button type="submit" class="btn btn-primary"
                                                name="updateDetailLisensi">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-4">BAST - User Penggguna Lisensi</h5>
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

    $(document).ready(function() {
        // Cek nilai .type_lisence saat halaman dimuat
        var initialValue = $('.type_lisence').val();

        // Jika nilai awal sudah "1", nonaktifkan input date
        if (initialValue === '1') {
            $('.date_end').prop('disabled', true);
        }

        // Tambahkan event listener pada perubahan nilai select
        $('.type_lisence').on('change', function() {
            // Ambil nilai terpilih
            var selectedValue = $(this).val();

            // Cek apakah "PERPETUAL LISENCE" terpilih
            if (selectedValue === '1') {
                // Nonaktifkan input date
                $('.date_end').prop('disabled', true);
                // Hilangkan atribut required
                $('.date_end').removeAttr('required');
            } else {
                // Aktifkan kembali input date
                $('.date_end').prop('disabled', false);
                // Tambahkan atribut required
                $('.date_end').prop('required', true);
            }
        });
    });



    // enable tooltip 
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>