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
    $desc = trim(htmlspecialchars($_POST['desc']));
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
    $inv = trim(htmlspecialchars($_POST['inv']));
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

    $getImage = mysqli_fetch_assoc(mysqli_query($conn, "SELECT img FROM good_incoming_details WHERE sn = '$sn' "));
    $img = $getImage["img"];
    
    
    mysqli_query($conn, "INSERT INTO goods (number, sn, description, specification, id_inv_type, id_inv_group, id_inv_allotment, id_inv_branch, id_inv_source, id_inv_dept, year, useful_period, id_inv_condition, notes, img, created_at, created_by) VALUES('$inv', '$sn', '$description', '$spek', $type_inv, $group_inv, $allotment_inv, $branch, $source, $dept, '$year', $useful_inv, $condition_inv, '$notes', '$img', '$dateTime', $userCreated)");

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
    // $sn = trim(htmlspecialchars($_POST['sn']));
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

    // $getImage = mysqli_fetch_assoc(mysqli_query($conn, "SELECT img FROM good_incoming_details WHERE sn = '$sn' "));
    // $img = $getImage["img"];

    mysqli_query($conn, "UPDATE goods SET description = '$description', specification = '$spek', id_inv_type = $type_inv, id_inv_group = $group_inv, id_inv_allotment = $allotment_inv, id_inv_branch = $branch, id_inv_source = $source, id_inv_dept = $dept, year = $year, useful_period = $useful_inv, id_inv_condition = $condition_inv, notes = '$notes' WHERE number = '$inv'");

    if(mysqli_affected_rows($conn)){
        // Jika ada perubahan pada update
        header("Location: barang-details.php?inv=". $inv);
    } else {
        // Jika Tidak ada perubahan pada update
        header("Location: barang-details.php?inv=". $inv);
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
    
    mysqli_query($conn, "INSERT INTO users (initial, name, nik, position, id_dept, id_branch, notes, created_at, created_by) VALUES('$initial', '$name', '$nik', '$job', $dept, $branch, '$notes', '$userCreated', '$dateTime')");

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