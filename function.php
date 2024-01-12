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

    mysqli_query($conn, "INSERT INTO good_incoming_details (id_incoming, description, sn, pwr, po, type, notes, created_at, created_by) VALUES($idRR, '$desc', '$sn', '$pwr', '$po', $type, '$notes', '$dateTime', $userCreated)");

    if(mysqli_affected_rows($conn)){
        header("Location: tambah-laporan-barang-masuk.php");
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