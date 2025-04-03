<?php

require "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$dateTime = date('Y-m-d H:i:s');
$userCreated = $_COOKIE["_beta_log"];

if (isset($_GET["logout"])) {
    unset($_COOKIE['_beta_log']); 
    setcookie('_beta_log', '', -1, '/'); 
    unset($_COOKIE['_name_log']); 
    setcookie('_name_log', '', -1, '/'); 

    header("Location: login.php");
}

if(isset($_GET["addIncomingGood"])){
    $yearNow = date("Y");
    $monthNow = date("m");
    $testGetDate = "IT/RR/" . $yearNow . "/" . $monthNow . "/";

    $getLastNumber = mysqli_query($conn, "SELECT number FROM good_incoming WHERE number LIKE '%$testGetDate%' ORDER BY number DESC LIMIT 1");
    if(mysqli_num_rows($getLastNumber) == 1){
        // ambil data nomor terakhir terkini
        $getLastNum = mysqli_fetch_assoc($getLastNumber);
        $number = $getLastNum["number"];

        // Pecah Nomor Terakhir berdasar "/"
        $explode_number = explode("/", $number);

        // +1 nomor akhir
        $addNumber = end($explode_number) + 1;

        $finalNumber = $testGetDate . $addNumber;

        mysqli_query($conn, "INSERT INTO good_incoming (number, created_at, created_by) VALUES('$finalNumber','$dateTime', '$userCreated')");

        if(mysqli_affected_rows($conn)){
            // Menentukan waktu kedaluwarsa cookie (2 jam dalam detik)
			setcookie("_rr_number_log", "$finalNumber", time() + 2 * 60 * 60, "/");
            header("Location: tambah-laporan-barang-masuk.php");
        }
    } else if(mysqli_num_rows($getLastNumber) == 0){
        $finalNumber = $testGetDate . "1";

        mysqli_query($conn, "INSERT INTO good_incoming (number, created_at, created_by) VALUES('$finalNumber','$dateTime', '$userCreated')");
        
        if(mysqli_affected_rows($conn)){
            // Menentukan waktu kedaluwarsa cookie (2 jam dalam detik)
			setcookie("_rr_number_log", "$finalNumber", time() + 2 * 60 * 60, "/");
            header("Location: tambah-laporan-barang-masuk.php");
        }
    }
}

if(isset($_POST['tambahBarangMasuk'])){
    $desc = ($_POST['desc']);
    $sn = trim(htmlspecialchars($_POST['sn']));
    $pwr = trim(htmlspecialchars($_POST['pwr']));
    $po = trim(htmlspecialchars($_POST['po']));
    $type = trim(htmlspecialchars($_POST['type']));
    $notes = trim(htmlspecialchars($_POST['notes']));

    // ambil rr number dari cookie
    $rrNumber = $_COOKIE["_rr_number_log"];
    $getIdRR = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM good_incoming WHERE number = '$rrNumber'"));
    $idRR = $getIdRR["id"];

    // Pengaturan direktori untuk menyimpan gambar
    $uploadDir = __DIR__ . "/dist/img/";

    // Mendapatkan informasi file gambar
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];

    // Mendapatkan ekstensi file gambar
    $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

    // Generate nama file acak menggunakan md5
    $imageNameHashed = md5(uniqid("", true)) . "." . $imageExt;

    // Mengecek apakah file yang diunggah adalah gambar
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (in_array($imageExt, $allowedExtensions)) {
        // Menyimpan gambar ke direktori
        move_uploaded_file($imageTmpName, $uploadDir . $imageNameHashed);

        // Menyimpan nama file gambar ke database
        mysqli_query($conn, "INSERT INTO good_incoming_details (id_incoming, description, sn, pwr, po, type, notes, img, created_at, created_by) VALUES($idRR, '$desc', '$sn', '$pwr', '$po', $type, '$notes', '$imageNameHashed', '$dateTime', $userCreated)");

        if(mysqli_affected_rows($conn)){
            header("Location: tambah-laporan-barang-masuk.php");
        } else {
            echo "Failed to update database with image information.";
        }
    } else {
        echo "Invalid file format. Allowed formats: jpg, jpeg, png, gif.";
    }
}

if(isset($_GET["hapusDetailBarang"])){
    $id = $_GET['hapusDetailBarang'];
    
    mysqli_query($conn, "DELETE FROM good_incoming_details WHERE id = $id");
    if(mysqli_affected_rows($conn)){
        header("Location: tambah-laporan-barang-masuk.php");
    }
}

if(isset($_POST["updateNotesBarangMasuk"])){
    $notes = trim(htmlspecialchars($_POST['notes']));
    
    // ambil rr number dari cookie
    $rrNumber = $_COOKIE["_rr_number_log"];

    mysqli_query($conn, "UPDATE good_incoming SET notes = '$notes' WHERE number = '$rrNumber'");
    if(mysqli_affected_rows($conn)){
        header("Location: barang-masuk.php");
    } else {
        // Jika tidak ada update notes
        header("Location: barang-masuk.php");
    }
}

if(isset($_GET["viewBarangMasuk"])){
    
    $numberRR = $_GET["viewBarangMasuk"];

    setcookie("_rr_number_log", "$numberRR", time() + 2 * 60 * 60, "/");
    header("Location: tambah-laporan-barang-masuk.php");
}

if(isset($_GET["dumpDaftarBarang"])){
    $id = $_GET["dumpDaftarBarang"];

    // dump list good_incoming
    mysqli_query($conn, "UPDATE good_incoming SET as_dump = 1 WHERE id = $id");
    if(mysqli_affected_rows($conn)){
        // dump list good_incoming_details
        mysqli_query($conn, "UPDATE good_incoming_details SET as_dump = 1 WHERE id_incoming = $id");
        if(mysqli_affected_rows($conn)){
            header("Location: barang-masuk.php");
        }    
    }
}

if(isset($_POST["mutasiBarangMasukKeBarang"])){
    $sn = trim(htmlspecialchars($_POST['sn']));
    $description = trim(htmlspecialchars($_POST['description']));
    $spek = $_POST["spek"];
    $type_inv = trim(htmlspecialchars($_POST['type_inv']));
    $group_inv = trim(htmlspecialchars($_POST['group_inv']));
    $allotment_inv = trim(htmlspecialchars($_POST['allotment_inv']));
    $branch = trim(htmlspecialchars($_POST['branch']));
    $source = trim(htmlspecialchars($_POST['source']));
    $dept = trim(htmlspecialchars($_POST['dept']));
    $year = trim(htmlspecialchars($_POST['year']));
    $useful_inv = trim(htmlspecialchars($_POST['useful_inv']));
    $condition_inv = trim(htmlspecialchars($_POST['condition_inv']));
    $notes = trim(htmlspecialchars($_POST['notes']));

    // Ambil gambar terkait SN
    $getImage = mysqli_fetch_assoc(mysqli_query($conn, "SELECT img FROM good_incoming_details WHERE sn = '$sn' "));
    $img = $getImage["img"];
    
    // Cek nomor urut terakhir berdasarkan group_inv
    $query = "SELECT number FROM goods WHERE number LIKE '6.$year/$group_inv.%/$branch' ORDER BY number DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        // Ambil urutan terakhir dari kolom number, contoh: "6.2024/LT03.01/WS1LT2"
        $lastNumber = $row['number'];
        preg_match('/' . $group_inv . '\.(\d+)\//', $lastNumber, $matches);
        $urut = isset($matches[1]) ? str_pad($matches[1] + 1, 2, '0', STR_PAD_LEFT) : "01";
    } else {
        $urut = "01"; // Jika tidak ada nomor sebelumnya, mulai dari 01
    }
    
    // Buat nomor inventaris baru
    $createInv = "6." . $year . "/" . $group_inv . "." . $urut . "/" . $branch;

    // Masukkan data ke tabel goods
    mysqli_query($conn, "INSERT INTO goods (number, sn, description, specification, id_inv_type, id_inv_group, id_inv_allotment, id_inv_branch, id_inv_source, id_inv_dept, year, useful_period, id_inv_condition, notes, img, created_at, created_by) VALUES('$createInv', '$sn', '$description', '$spek', $type_inv, '$group_inv', $allotment_inv, '$branch', $source, $dept, '$year', $useful_inv, $condition_inv, '$notes', '$img', '$dateTime', $userCreated)");

    if(mysqli_affected_rows($conn)){
        // update good_incoming_details as_inv = 1
        mysqli_query($conn, "UPDATE good_incoming_details SET as_inv = 1 WHERE sn = '$sn'");
        if(mysqli_affected_rows($conn)){
            header("Location: barang.php");
        }    
    }
}


if(isset($_POST["tambahBarangInvManual"])){
    $inv = trim(htmlspecialchars($_POST['invM']));
    $sn = trim(htmlspecialchars($_POST['snM']));
    $description = trim(htmlspecialchars($_POST['descriptionM']));
    $spek = $_POST["spekM"];
    $type_inv = trim(htmlspecialchars($_POST['type_invM']));
    $group_inv = trim(htmlspecialchars($_POST['group_invM']));
    $allotment_inv = trim(htmlspecialchars($_POST['allotment_invM']));
    $branch = trim(htmlspecialchars($_POST['branchM']));
    $source = trim(htmlspecialchars($_POST['sourceM']));
    $dept = trim(htmlspecialchars($_POST['deptM']));
    $year = trim(htmlspecialchars($_POST['yearM']));
    $useful_inv = trim(htmlspecialchars($_POST['useful_invM']));
    $condition_inv = trim(htmlspecialchars($_POST['condition_invM']));
    $notes = trim(htmlspecialchars($_POST['notesM']));

    // Pengaturan direktori untuk menyimpan gambar
    $uploadDir = __DIR__ . "/dist/img/";

    // Mendapatkan informasi file gambar
    $imageName = $_FILES['imageM']['name'];
    $imageTmpName = $_FILES['imageM']['tmp_name'];

    // Mendapatkan ekstensi file gambar
    $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

    // Generate nama file acak menggunakan md5
    $imageNameHashed = md5(uniqid("", true)) . "." . $imageExt;
    
    // Mengecek apakah file yang diunggah adalah gambar
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (in_array($imageExt, $allowedExtensions)) {
        // Menyimpan gambar ke direktori
        move_uploaded_file($imageTmpName, $uploadDir . $imageNameHashed);

        // Menyimpan nama file gambar ke database
        mysqli_query($conn, "INSERT INTO goods (number, sn, description, specification, id_inv_type, id_inv_group, id_inv_allotment, id_inv_branch, id_inv_source, id_inv_dept, year, useful_period, id_inv_condition, notes, img, created_at, created_by) VALUES('$inv', '$sn', '$description', '$spek', $type_inv, $group_inv, $allotment_inv, $branch, $source, $dept, '$year', $useful_inv, $condition_inv, '$notes', '$imageNameHashed', '$dateTime', $userCreated)");

        if(mysqli_affected_rows($conn)){
            header("Location: barang.php");
        } else {
            echo "Failed to update database with image information.";
        }
    } else {
        echo "Invalid file format. Allowed formats: jpg, jpeg, png, gif.";
    }
    
}

if(isset($_POST["updateDetailBarang"])){
    $inv = trim(htmlspecialchars($_POST['inv']));
    $description = trim(htmlspecialchars($_POST['description']));
    $spek = $_POST["spek"];
    $type_inv = trim(htmlspecialchars($_POST['type_inv']));
    $group_inv = trim(htmlspecialchars($_POST['group_inv']));
    $allotment_inv = trim(htmlspecialchars($_POST['allotment_inv']));
    $branch = trim(htmlspecialchars($_POST['branch'])); // nilai baru dari $branch
    $source = trim(htmlspecialchars($_POST['source']));
    $dept = trim(htmlspecialchars($_POST['dept']));
    $year = trim(htmlspecialchars($_POST['year']));
    $useful_inv = trim(htmlspecialchars($_POST['useful_inv']));
    $condition_inv = trim(htmlspecialchars($_POST['condition_inv']));
    $notes = trim(htmlspecialchars($_POST['notes']));

    // Ekstrak nilai branch lama dari number (mengambil bagian terakhir setelah '/')
    preg_match('/\/([^\/]+)$/', $inv, $matches);
    $oldBranch = $matches[1] ?? ''; // nilai lama dari branch dalam number

    // Periksa apakah $branch baru berbeda dari nilai lama
    if ($oldBranch !== $branch) {
        // Ganti bagian terakhir dari number dengan nilai baru $branch
        $newNumber = preg_replace('/' . preg_quote($oldBranch, '/') . '$/', $branch, $inv);
    } else {
        $newNumber = $inv; // Jika tidak ada perubahan, gunakan nilai awal dari $inv
    }

    // Lakukan update pada tabel goods, termasuk kolom number yang diperbarui
    $updateQuery = "UPDATE goods SET description = '$description', specification = '$spek', id_inv_type = $type_inv, id_inv_group = '$group_inv', id_inv_allotment = $allotment_inv, id_inv_branch = '$branch', id_inv_source = $source, id_inv_dept = $dept, year = $year, useful_period = $useful_inv, id_inv_condition = $condition_inv, notes = '$notes', number = '$newNumber' WHERE number = '$inv'";

    mysqli_query($conn, $updateQuery);

    // Pengalihan halaman setelah update
    if (mysqli_affected_rows($conn)) {
        header("Location: barang-details.php?inv=" . $newNumber);
    } else {
        header("Location: barang-details.php?inv=" . $newNumber);
    }
}


if(isset($_POST["tambahUser"])){
    $name = trim(htmlspecialchars($_POST['name']));
    $initial = trim(htmlspecialchars($_POST['initial']));
    $nik = trim(htmlspecialchars($_POST['nik']));
    $dept = trim(htmlspecialchars($_POST['dept']));
    $branch = trim(htmlspecialchars($_POST['branch']));
    $job = trim(htmlspecialchars($_POST['job']));
    $notes = trim(htmlspecialchars($_POST['notes']));
    
    mysqli_query($conn, "INSERT INTO users (initial, name, nik, position, id_dept, id_branch, notes, created_at, created_by) VALUES('$initial', '$name', '$nik', '$job', $dept, $branch, '$notes', '$dateTime', '$userCreated')");

    if(mysqli_affected_rows($conn)){
        // Jika ada perubahan pada update
        header("Location: user.php");
    } else {
        // Jika Tidak ada perubahan pada update
        header("Location: user.php");
    }
}

if(isset($_POST["updateUser"])){
    $name = trim(htmlspecialchars($_POST['name']));
    $initial = trim(htmlspecialchars($_POST['initial']));
    $nik = trim(htmlspecialchars($_POST['nik']));
    $dept = trim(htmlspecialchars($_POST['dept']));
    $branch = trim(htmlspecialchars($_POST['branch']));
    $job = trim(htmlspecialchars($_POST['job']));
    $notes = trim(htmlspecialchars($_POST['notes']));
    
    mysqli_query($conn, "UPDATE users SET name = '$name', nik = '$nik', position = '$job', id_dept = $dept, id_branch = $branch, notes = '$notes' WHERE initial = '$initial'");

    if(mysqli_affected_rows($conn)){
        // Jika ada perubahan pada update
        header("Location: user-details.php?Initial=" . $initial);
    } else {
        // Jika Tidak ada perubahan pada update
        header("Location: user-details.php?Initial=" . $initial);
    }
}

if(isset($_POST["addBastGiven"])){
    $bast = trim(htmlspecialchars($_POST['bast']));
    $branch = trim(htmlspecialchars($_POST['branch']));
    $submitted = trim(htmlspecialchars($_POST['submitted']));
    $accepted = trim(htmlspecialchars($_POST['accepted']));
    $notes = trim(htmlspecialchars($_POST['notes']));
    
    
    mysqli_query($conn, "INSERT INTO bast_report (number, id_user_submitted, id_user_accepted, notes, created_at, created_by) VALUES('$bast', $submitted, $accepted, '$notes', '$dateTime', '$userCreated')"); 

    if(mysqli_affected_rows($conn)){
        // Jika ada perubahan pada update
        header("Location: berita-acara-serah-terima.php");
    } else {
        // Jika Tidak ada perubahan pada update
        header("Location: berita-acara-serah-terima.php");
    }
}

if(isset($_POST["mutasiBarangMasukKeLisensi"])){
    $inv = trim(htmlspecialchars($_POST['inv']));
    $sn = trim(htmlspecialchars($_POST['sn']));
    $description = trim(htmlspecialchars($_POST['description']));
    $type_lisence = trim(htmlspecialchars($_POST['type_lisence']));
    $seats = trim(htmlspecialchars($_POST['seats']));
    $date_start = trim(htmlspecialchars($_POST['date_start']));
    $date_end = trim(htmlspecialchars($_POST['date_end']));
    $dept = trim(htmlspecialchars($_POST['dept']));
    $branch = trim(htmlspecialchars($_POST['branch']));
    $source = trim(htmlspecialchars($_POST['source']));
    $notes = trim(htmlspecialchars($_POST['notes']));
    
    mysqli_query($conn, "INSERT INTO lisences (number, sn, description, id_lic_type, seats, date_start, date_end, id_lic_dept, id_lic_branch, id_lic_source, notes, created_at, created_by) VALUES('$inv', '$sn', '$description', $type_lisence, $seats, '$date_start', '$date_end', $dept, $branch, $source, '$notes', '$dateTime', '$userCreated')");

    if(mysqli_affected_rows($conn)){
        // Jika ada perubahan pada update
        mysqli_query($conn, "UPDATE good_incoming_details SET as_inv = 1 WHERE sn = '$sn'");
        
        if(mysqli_affected_rows($conn)){
            header("Location: lisensi.php");
        } else {
            // Jika Tidak ada perubahan pada update
            header("Location: lisensi.php");
        }
    }
}

if(isset($_POST["tambahLisensiManual"])){
    $inv = trim(htmlspecialchars($_POST['invM']));
    $sn = trim(htmlspecialchars($_POST['snM']));
    $description = trim(htmlspecialchars($_POST['descriptionM']));
    $type_lisence = trim(htmlspecialchars($_POST['type_lisenceM']));
    $seats = trim(htmlspecialchars($_POST['seatsM']));
    $date_start = trim(htmlspecialchars($_POST['date_startM']));
    $date_end = trim(htmlspecialchars($_POST['date_endM']));
    $dept = trim(htmlspecialchars($_POST['deptM']));
    $branch = trim(htmlspecialchars($_POST['branchM']));
    $source = trim(htmlspecialchars($_POST['sourceM']));
    $notes = trim(htmlspecialchars($_POST['notesM']));
    
    mysqli_query($conn, "INSERT INTO lisences (number, sn, description, id_lic_type, seats, date_start, date_end, id_lic_dept, id_lic_branch, id_lic_source, notes, created_at, created_by) VALUES('$inv', '$sn', '$description', $type_lisence, $seats, '$date_start', '$date_end', $dept, $branch, $source, '$notes', '$dateTime', '$userCreated')");

    if(mysqli_affected_rows($conn)){
        // Jika ada perubahan pada update
        mysqli_query($conn, "UPDATE good_incoming_details SET as_inv = 1 WHERE sn = '$sn'");
        
        if(mysqli_affected_rows($conn)){
            header("Location: lisensi.php");
        } else {
            // Jika Tidak ada perubahan pada update
            header("Location: lisensi.php");
        }
    }
}

if(isset($_POST["updateDetailLisensi"])){
    $inv = trim(htmlspecialchars($_POST['inv']));
    // $sn = trim(htmlspecialchars($_POST['sn']));
    $description = trim(htmlspecialchars($_POST['description']));
    $type_lic = trim(htmlspecialchars($_POST['type_lic']));
    $seats = trim(htmlspecialchars($_POST['seats']));
    $date_start = trim(htmlspecialchars($_POST['date_start']));
    $date_end = trim(htmlspecialchars($_POST['date_end']));
    $branch = trim(htmlspecialchars($_POST['branch']));
    $source = trim(htmlspecialchars($_POST['source']));
    $dept = trim(htmlspecialchars($_POST['dept']));
    $notes = trim(htmlspecialchars($_POST['notes']));

    if(isset($date_end)){
        mysqli_query($conn, "UPDATE lisences SET description = '$description', id_lic_type = $type_lic, seats = $seats, date_start = '$date_start', date_end = '$date_end', id_lic_branch = $branch, id_lic_source = $source, id_lic_dept = $dept, notes = '$notes' WHERE number = '$inv'");
    } else {
        mysqli_query($conn, "UPDATE lisences SET description = '$description', id_lic_type = $type_lic, seats = $seats, date_start = '$date_start', id_lic_branch = $branch, id_lic_source = $source, id_lic_dept = $dept, notes = '$notes' WHERE number = '$inv'");
    }

    if(mysqli_affected_rows($conn)){
        // Jika ada perubahan pada update
        header("Location: lisensi-details.php?inv=". $inv);
    } else {
        // Jika Tidak ada perubahan pada update
        header("Location: lisensi-details.php?inv=". $inv);
    }
}

if(isset($_POST["deleteGood"])){
    $snDelete = trim(htmlspecialchars($_POST['snDelete']));
    
    mysqli_query($conn, "UPDATE goods SET as_dump = 1 WHERE sn = '$snDelete'");

    if(mysqli_affected_rows($conn)){
        // Jika ada perubahan pada update
        header("Location: barang-details.php");
    } else {
        // Jika Tidak ada perubahan pada update
        header("Location: barang-details.php");
    }
}

if(isset($_POST["updateDescBAST"])){
    $description = trim(htmlspecialchars($_POST['description']));
    $bast = trim(htmlspecialchars($_POST['bast']));
    
    mysqli_query($conn, "UPDATE bast_report SET notes = '$description' WHERE number = '$bast'");

    
    if(mysqli_affected_rows($conn)){
        // tambahkan row di bast_usage_history
        mysqli_query($conn, "INSERT INTO bast_usage_history (bast_number, tittle, description, created_at, created_by) VALUES ('$bast', 'Update Description', '$description', '$dateTime', $userCreated)");
        
        // Jika ada perubahan pada update
        header("Location: ba-serah-terima-details.php?bast=$bast");
    } else {
        // Jika Tidak ada perubahan pada update
        header("Location: ba-serah-terima-details.php?bast=$bast");
    }
}


if(isset($_GET["addGoodtoBAST"])){
    $id = $_GET['addGoodtoBAST'];
    $bast = $_GET['bast'];
    $goodDesc = $_GET['goodDesc'];
    $goodNumber = $_GET['goodNumber'];
    
    // menambahkan row di tabel bast_report_detail
    mysqli_query($conn, "INSERT INTO bast_report_details (bast_number, id_good, id_inv_type, created_at, created_by) VALUES ('$bast', $id, 1, '$dateTime', $userCreated)");

    // ubah status di tabel goods berdasar $id menjadi as_bast = 1
    mysqli_query($conn, "UPDATE goods SET as_bast = 1 WHERE id = $id");

    // tambahkan row di bast_usage_history
    mysqli_query($conn, "INSERT INTO bast_usage_history (bast_number, tittle, description, created_at, created_by) VALUES ('$bast', 'Add Inventory', 'Adding $goodNumber - $goodDesc', '$dateTime', $userCreated)");

    if(mysqli_affected_rows($conn)){
        // Jika ada perubahan pada update
        header("Location: ba-serah-terima-details.php?bast=$bast");
    } else {
        // Jika Tidak ada perubahan pada update
        header("Location: ba-serah-terima-details.php?bast=$bast");
    }
}

if (isset($_POST["commitHistory"])) {
    $tittle = trim(htmlspecialchars($_POST['tittle']));
    $description = trim(htmlspecialchars($_POST['description']));
    $bast = trim(htmlspecialchars($_POST['bast']));
    $photo = $_FILES['attach']['tmp_name'];
    $photoName = $_FILES['attach']['name'];
    
    // Fungsi untuk menghasilkan nama unik dengan 40 karakter
    function generateUniqueFileName($length = 40) {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }

    if (!empty($photoName) && is_uploaded_file($photo)) {
        // Dapatkan ekstensi file
        $fileExtension = pathinfo($photoName, PATHINFO_EXTENSION);
        
        // Buat nama file baru yang unik
        $uniquePhotoName = generateUniqueFileName() . '.' . $fileExtension;
        $photoTarget = 'dist/img/history-img/' . $uniquePhotoName;
        
        // Pindahkan file yang diunggah ke target yang baru
        if (move_uploaded_file($photo, $photoTarget)) {
            mysqli_query($conn, "INSERT INTO bast_usage_history (bast_number, tittle, description, attach, created_at, created_by) VALUES ('$bast', '$tittle', '$description <button class=\"btn btn-sm btn-success\" onclick=\"window.open(\'dist/img/history-img/$uniquePhotoName\', \'_blank\').focus()\">View</button>', '$uniquePhotoName', '$dateTime', $userCreated)");
        } else {
            // Handle error saat memindahkan file
            mysqli_query($conn, "INSERT INTO bast_usage_history (bast_number, tittle, description, attach, created_at, created_by) VALUES ('$bast', '$tittle', '$description', NULL, '$dateTime', $userCreated)");
        }
    } else {
        mysqli_query($conn, "INSERT INTO bast_usage_history (bast_number, tittle, description, attach, created_at, created_by) VALUES ('$bast', '$tittle', '$description', NULL, '$dateTime', $userCreated)");
    }

    // Periksa apakah ada baris yang terpengaruh oleh query
    if (mysqli_affected_rows($conn)) {
        // Jika ada perubahan pada update
        header("Location: ba-serah-terima-details.php?bast=$bast");
    } else {
        // Jika tidak ada perubahan pada update
        header("Location: ba-serah-terima-details.php?bast=$bast");
    }
}


if(isset($_POST["UploadAttachInvBAST"])){
    $bastUrl = trim(htmlspecialchars($_POST['bastUrl']));
    $goodSelected = trim(htmlspecialchars($_COOKIE["goodSelected-list"]));

    $photo = $_FILES['importFile']['tmp_name'];
    $photoName = $_FILES['importFile']['name'];
    
    // Fungsi untuk menghasilkan nama unik dengan 50 karakter
    function generateUniqueFileName($length = 40) {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }

    // Dapatkan ekstensi file
    $fileExtension = pathinfo($photoName, PATHINFO_EXTENSION);
    
    // Buat nama file baru yang unik
    $uniquePhotoName = generateUniqueFileName() . '.' . $fileExtension;
    $photoTarget = 'dist/attach/' . $uniquePhotoName;
    
    // Pindahkan file yang diunggah ke target yang baru
    move_uploaded_file($photo, $photoTarget);

    // Update database dengan nama file yang baru
    mysqli_query($conn, "UPDATE bast_report_details SET attach = '$uniquePhotoName' WHERE bast_number = '$bastUrl' AND id_good = $goodSelected");

    // tambahkan row di bast_usage_history
    $getInvGood = mysqli_fetch_assoc(mysqli_query($conn, "SELECT number FROM goods WHERE id = $goodSelected"));
    $getInv = $getInvGood["number"];
    mysqli_query($conn, "INSERT INTO bast_usage_history (bast_number, tittle, description, created_at, created_by) VALUES ('$bastUrl', 'Add Attachment', 'Adding Attachment for $getInv <button onclick=\"window.open(\'dist/attach/$uniquePhotoName\', \'_blank\').focus()\" class=\"btn btn-sm btn-success\">View</button>', '$dateTime', $userCreated)");

    // Periksa apakah ada baris yang terpengaruh oleh query
    if(mysqli_affected_rows($conn)){
        // Jika ada perubahan pada update
        header("Location: ba-serah-terima-details.php?bast=$bastUrl");
    } else {
        // Jika tidak ada perubahan pada update
        header("Location: ba-serah-terima-details.php?bast=$bastUrl");
    }
}

if(isset($_GET["deleteInvBAST"])){
    $goodForDelete = trim(htmlspecialchars($_GET['deleteInvBAST']));
    $bast = trim(htmlspecialchars($_GET['bast']));
    $goodNumber = trim(htmlspecialchars($_GET['number']));
    $goodDesc = trim(htmlspecialchars($_GET['desc']));
    
    mysqli_query($conn, "DELETE FROM bast_report_details WHERE bast_number='$bast' AND id_good = $goodForDelete");
    
    // ubah status di tabel goods berdasar $id menjadi as_bast = 0
    mysqli_query($conn, "UPDATE goods SET as_bast = 0 WHERE id = $goodForDelete");

    // tambahkan row di bast_usage_history
    mysqli_query($conn, "INSERT INTO bast_usage_history (bast_number, tittle, description, created_at, created_by) VALUES ('$bast', 'Delete Inventory', 'Deleted $goodNumber - $goodDesc', '$dateTime', $userCreated)");

    if(mysqli_affected_rows($conn)){
        // Jika ada perubahan pada update
        header("Location: ba-serah-terima-details.php?bast=$bast");
    } else {
        // Jika Tidak ada perubahan pada update
        header("Location: ba-serah-terima-details.php?bast=$bast");
    }
    
}

if(isset($_POST['tambahGroup'])){
    $group = trim(htmlspecialchars($_POST['group']));
    $code = trim(htmlspecialchars($_POST['code']));
    $description = $_POST['description'];
    
    mysqli_query($conn, "INSERT INTO inv_group (code, name, description, created_at, created_by) VALUES ('$code', '$group', '$description', '$dateTime', $userCreated)");
    
    if(mysqli_affected_rows($conn)){
        // Jika ada perubahan pada update
        header("Location: tambah-laporan-barang-masuk.php");
    } else {
        // Jika Tidak ada perubahan pada update
        header("Location: tambah-laporan-barang-masuk.php");
    }
}

if(isset($_GET["addLicencetoBAST"])){
    $id = $_GET['addLicencetoBAST'];
    $bast = $_GET['bast'];
    $lisenceDesc = $_GET['lisenceDesc'];
    $lisenceNumber = $_GET['lisenceNumber'];
    
    // menambahkan row di tabel bast_report_detail
    mysqli_query($conn, "INSERT INTO bast_report_details (bast_number, id_good, id_inv_type, created_at, created_by) VALUES ('$bast', $id, 2, '$dateTime', $userCreated)");

    // ubah status di tabel lisences berdasar $id menjadi as_bast = as_bast + 1
    mysqli_query($conn, "UPDATE lisences SET as_bast = as_bast + 1 WHERE id = $id");

    // tambahkan row di bast_usage_history
    mysqli_query($conn, "INSERT INTO bast_usage_history (bast_number, tittle, description, created_at, created_by) VALUES ('$bast', 'Add Lisence', 'Adding $lisenceNumber - $lisenceDesc', '$dateTime', $userCreated)");

    if(mysqli_affected_rows($conn)){
        // Jika ada perubahan pada update
        header("Location: ba-serah-terima-details.php?bast=$bast");
    } else {
        // Jika Tidak ada perubahan pada update
        header("Location: ba-serah-terima-details.php?bast=$bast");
    }
}

if(isset($_GET["deleteLicBAST"])){
    $id = trim(htmlspecialchars($_GET['deleteLicBAST']));
    $bast = trim(htmlspecialchars($_GET['bast']));
    $licNumber = trim(htmlspecialchars($_GET['number']));
    $licDesc = trim(htmlspecialchars($_GET['desc']));
    
    mysqli_query($conn, "DELETE FROM bast_report_details WHERE bast_number='$bast' AND id = $id");
    
    // ubah status di tabel lisences berdasar $id menjadi as_bast = as_bast - 1
    mysqli_query($conn, "UPDATE lisences SET as_bast = as_bast - 1 WHERE number = '$licNumber'");

    // tambahkan row di bast_usage_history
    mysqli_query($conn, "INSERT INTO bast_usage_history (bast_number, tittle, description, created_at, created_by) VALUES ('$bast', 'Delete Lisence', 'Deleted $licNumber - $licDesc', '$dateTime', $userCreated)");

    if(mysqli_affected_rows($conn)){
        // Jika ada perubahan pada update
        header("Location: ba-serah-terima-details.php?bast=$bast");
    } else {
        // Jika Tidak ada perubahan pada update
        header("Location: ba-serah-terima-details.php?bast=$bast");
    }
    
}

if(isset($_POST["uploadSigned"])){
    $bastUrl = trim(htmlspecialchars($_POST['bastUrl']));
    $goodSelected = trim(htmlspecialchars($_COOKIE["goodSelected-list"]));

    $photo = $_FILES['bastSigned']['tmp_name'];
    $photoName = $_FILES['bastSigned']['name'];
    
    // Fungsi untuk menghasilkan nama unik dengan 40 karakter
    function generateUniqueFileName($length = 40) {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }

    // Dapatkan ekstensi file
    $fileExtension = pathinfo($photoName, PATHINFO_EXTENSION);
    
    // Buat nama file baru yang unik
    $uniquePhotoName = generateUniqueFileName() . '.' . $fileExtension;
    $photoTarget = 'dist/attach/' . $uniquePhotoName;
    
    // Pindahkan file yang diunggah ke target yang baru
    move_uploaded_file($photo, $photoTarget);

    // Update database dengan nama file yang baru
    mysqli_query($conn, "UPDATE bast_report SET attach = '$uniquePhotoName' WHERE number = '$bastUrl'");

    // tambahkan row di bast_usage_history
    // $getInvGood = mysqli_fetch_assoc(mysqli_query($conn, "SELECT number FROM goods WHERE id = $goodSelected"));
    // $getInv = $getInvGood["number"];
    mysqli_query($conn, "INSERT INTO bast_usage_history (bast_number, tittle, description, created_at, created_by) VALUES ('$bastUrl', 'Add BAST Signed', 'Adding BAST Signed for $bastUrl <button onclick=\"window.open(\'dist/attach/$uniquePhotoName\', \'_blank\').focus()\" class=\"btn btn-sm btn-success\">View</button>', '$dateTime', $userCreated)");

    // Periksa apakah ada baris yang terpengaruh oleh query
    if(mysqli_affected_rows($conn)){
        // Jika ada perubahan pada update
        header("Location: ba-serah-terima-details.php?bast=$bastUrl");
    } else {
        // Jika tidak ada perubahan pada update
        header("Location: ba-serah-terima-details.php?bast=$bastUrl");
    }
}

if(isset($_POST["uploadImgGood"])){
    $invNumber = trim(htmlspecialchars($_POST['inv_number']));
    // $goodSelected = trim(htmlspecialchars($_COOKIE["goodSelected-list"]));

    $photo = $_FILES['imgGood']['tmp_name'];
    $photoName = $_FILES['imgGood']['name'];
    
    // Fungsi untuk menghasilkan nama unik dengan 50 karakter
    function generateUniqueFileName($length = 40) {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }

    // Dapatkan ekstensi file
    $fileExtension = pathinfo($photoName, PATHINFO_EXTENSION);
    
    // Buat nama file baru yang unik
    $uniquePhotoName = generateUniqueFileName() . '.' . $fileExtension;
    $photoTarget = 'dist/img/' . $uniquePhotoName;
    
    // Pindahkan file yang diunggah ke target yang baru
    move_uploaded_file($photo, $photoTarget);

    // Update database dengan nama file yang baru
    mysqli_query($conn, "UPDATE goods SET img = '$uniquePhotoName' WHERE number = '$invNumber'");

    // // tambahkan row di bast_usage_history
    // // $getInvGood = mysqli_fetch_assoc(mysqli_query($conn, "SELECT number FROM goods WHERE id = $goodSelected"));
    // // $getInv = $getInvGood["number"];
    // mysqli_query($conn, "INSERT INTO bast_usage_history (bast_number, tittle, description, created_at, created_by) VALUES ('$invNumber', 'Add BAST Signed', 'Adding BAST Signed for $invNumber <button onclick=\"window.open(\'dist/attach/$uniquePhotoName\', \'_blank\').focus()\" class=\"btn btn-sm btn-success\">View</button>', '$dateTime', $userCreated)");

    // Periksa apakah ada baris yang terpengaruh oleh query
    if(mysqli_affected_rows($conn)){
        // Jika ada perubahan pada update
        header("Location: barang-details.php?inv=$invNumber");
    } else {
        // Jika tidak ada perubahan pada update
        header("Location: barang-details.php?inv=$invNumber");
    }
}

if(isset($_GET["copyRowDataBarangMasuk"])){
    $row = trim(htmlspecialchars($_GET['copyRowDataBarangMasuk']));
    
    mysqli_query($conn, "INSERT INTO good_incoming_details (id_incoming, description, sn, pwr, po, type, notes, img, created_at, as_inv, as_dump, created_by) SELECT id_incoming, description, sn, pwr, po, type, notes, img, created_at, as_inv, as_dump, created_by FROM good_incoming_details WHERE id = $row");

    if(mysqli_affected_rows($conn)){
        // Jika ada perubahan pada update
        header("Location: tambah-laporan-barang-masuk.php");
    } else {
        // Jika Tidak ada perubahan pada update
        header("Location: tambah-laporan-barang-masuk.php");
    }
}